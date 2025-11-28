<?php
// AJAX endpoint for filtered image results
ob_start();

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
    echo json_encode(['error' => 'Database connection failed', 'html' => '', 'total' => 0]);
    exit;
  }

  // Execute shared search logic
  include 'search_logic.php';

  if (!$slis) {
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($dbcon), 'html' => '', 'total' => 0]);
    exit;
  }

  // Build HTML response
  $html = '';

  if (mysqli_num_rows($slis) > 0) {
    // Generate image cards HTML
    while ($list = mysqli_fetch_assoc($slis)) {

      $html .= '<div class="image-card relative group mb-4" data-image="' . $list['id'] . '">
              <img src="https://cdn.pixahunt.com/' . htmlspecialchars($list['view_thumb_img']) . '"
                   class="rounded-lg w-full"
                   alt="' . htmlspecialchars($list['title']) . '"
                   loading="lazy">
            </div>';
    }
  } else {
    $html = '<div class="w-full text-center text-white py-20 text-base" style="column-span: all;">No results found. Try adjusting your filters or search terms.</div>';
  }


  // Return JSON with HTML, total count, and pagination info
  echo json_encode([
    'html' => $html,
    'total' => $total,
    'page' => $page,
    'totalPages' => $totalPages,
    'perpage' => $perpage
  ]);
} catch (Exception $e) {
  echo json_encode([
    'error' => $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine(),
    'html' => '',
    'total' => 0
  ]);
}
