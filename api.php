<?php
// AJAX endpoint for filtered image results
ob_start();

// Include configuration
if (!defined('ENVIRONMENT')) {
  include_once 'config.php';
}

// JSON response with 5-minute cache
header('Content-Type: application/json');
header('Cache-Control: public, max-age=300');

// Convert PHP errors to exceptions for proper error handling
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
  include 'db.php';

  if (!$dbcon) {
    // Don't expose database connection details
    if (ENVIRONMENT === 'production') {
      echo json_encode(['error' => 'Service temporarily unavailable. Please try again later.', 'html' => '', 'total' => 0]);
    } else {
      echo json_encode(['error' => 'Database connection failed', 'html' => '', 'total' => 0]);
    }
    exit;
  }

  // Execute shared search logic
  include 'search_logic.php';

  if (!$slis) {
    // Don't expose SQL errors in production
    if (ENVIRONMENT === 'production') {
      echo json_encode(['error' => 'Unable to retrieve results. Please try again.', 'html' => '', 'total' => 0]);
    } else {
      echo json_encode(['error' => 'Query failed: ' . mysqli_error($dbcon), 'html' => '', 'total' => 0]);
    }
    exit;
  }

  // Build HTML response with XSS protection
  $html = '';

  // Handle both mysqli_result and array/ArrayIterator (from cache)
  $hasResults = false;
  if ($slis instanceof mysqli_result) {
    $hasResults = mysqli_num_rows($slis) > 0;
  } elseif ($slis instanceof ArrayIterator || is_array($slis)) {
    $hasResults = count($slis) > 0;
  }

  if ($hasResults) {
    // Generate image cards HTML with proper escaping
    if ($slis instanceof ArrayIterator || is_array($slis)) {
      // Reset iterator if needed
      if ($slis instanceof ArrayIterator) {
        $slis->rewind();
      }
      foreach ($slis as $list) {
        // Validate and sanitize ID
        $imageId = filter_var($list['id'], FILTER_VALIDATE_INT);
        if ($imageId === false) {
          $imageId = 0; // Invalid ID, use 0 as fallback
        }

        // Escape all user-generated content
        $thumbImg = htmlspecialchars($list['view_thumb_img'], ENT_QUOTES, 'UTF-8');
        $title = htmlspecialchars($list['title'], ENT_QUOTES, 'UTF-8');

        $html .= '<div class="image-card relative group mb-4" data-image="' . $imageId . '">
                      <img src="https://cdn.pixahunt.com/' . $thumbImg . '"
                           class="rounded-lg w-full"
                           alt="' . $title . '"
                           loading="lazy">
                    </div>';
      }
    } elseif ($slis instanceof mysqli_result) {
      // mysqli_result
      while ($list = mysqli_fetch_assoc($slis)) {
        // Validate and sanitize ID
        $imageId = filter_var($list['id'], FILTER_VALIDATE_INT);
        if ($imageId === false) {
          $imageId = 0;
        }

        // Escape all user-generated content
        $thumbImg = htmlspecialchars($list['view_thumb_img'], ENT_QUOTES, 'UTF-8');
        $title = htmlspecialchars($list['title'], ENT_QUOTES, 'UTF-8');

        $html .= '<div class="image-card relative group mb-4" data-image="' . $imageId . '">
                      <img src="https://cdn.pixahunt.com/' . $thumbImg . '"
                           class="rounded-lg w-full"
                           alt="' . $title . '"
                           loading="lazy">
                    </div>';
      }
    }
  } else {
    $html = '<div class="w-full text-center text-white py-20 text-base col-span-full">No results found. Try adjusting your filters or search terms.</div>';
  }

  // Return JSON with HTML, total count, and pagination info
  echo json_encode([
    'html' => $html,
    'total' => isset($total) ? (int)$total : 0,
    'page' => isset($page) ? (int)$page : 1,
    'totalPages' => isset($totalPages) ? (int)$totalPages : 1,
    'perpage' => isset($perpage) ? (int)$perpage : 20
  ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} catch (Exception $e) {
  // Secure error handling - don't expose sensitive information
  if (ENVIRONMENT === 'production') {
    // Log error securely (not exposed to user)
    error_log("API Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());

    // Generic error message for users
    echo json_encode([
      'error' => 'An error occurred while processing your request. Please try again later.',
      'html' => '',
      'total' => 0
    ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
  } else {
    // Development mode - show detailed errors
    echo json_encode([
      'error' => $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine(),
      'html' => '',
      'total' => 0
    ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
  }
}
