<?php
// Shared search and filter logic for both API and initial page load
// Security: Uses prepared statements and input validation

// Include configuration
if (!defined('ENVIRONMENT')) {
  include_once __DIR__ . '/../../config/config.php';
}

// Include Repository and Service classes
require_once __DIR__ . '/../classes/Repository.php';
require_once __DIR__ . '/../classes/ImageRepository.php';
require_once __DIR__ . '/../classes/ImageService.php';

// Check if database connection is available
if (!$dbcon) {
  // Set default values to prevent errors
  $slis = false;
  $total = 0;
  $totalPages = 1;
  $page = 1;
  $perpage = RESULTS_PER_PAGE;

  // Log error
  if (ENVIRONMENT === 'development') {
    error_log("search_logic.php: Database connection not available");
  }

  // Exit early - don't process further
  return;
}

// ============================================
// INPUT VALIDATION AND SANITIZATION
// ============================================

// Search query validation
$raw_q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Fix: .htaccess rewrites index.html to ?q=index.html
if ($raw_q === 'index.html' || $raw_q === 'index.php') {
  $raw_q = '';
}

// Sanitize search query (limit length, remove dangerous characters)
$raw_q = mb_substr($raw_q, 0, 200); // Limit length
$q = $raw_q ?: 'wallpaper'; // Default search term

// Page validation with bounds checking
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(MIN_PAGE_NUMBER, min(MAX_PAGE_NUMBER, $page));
$perpage = RESULTS_PER_PAGE;

// ============================================
// INITIALIZE REPOSITORY AND SERVICE
// ============================================
$imageRepository = new ImageRepository($dbcon);
$imageService = new ImageService($imageRepository);

// Prepare request parameters for service
$requestParams = $_GET;
if (!empty($raw_q)) {
  $requestParams['search'] = $raw_q;
}

// Build filters using service
$filters = $imageService->buildFilters($requestParams);

// Get images using service (with caching)
$result = $imageService->getImages($filters, $page, $perpage, $requestParams);

// Extract results for backward compatibility
// Handle both mysqli_result (from DB) and array (from cache)
$slis = $result['results'];
if (is_array($slis)) {
  // Convert array back to mysqli_result-like object for compatibility
  // Create a simple iterator that mimics mysqli_result behavior
  $slis = new ArrayIterator($slis);
} elseif (!($slis instanceof mysqli_result)) {
  // Fallback: ensure we have something iterable
  $slis = false;
}
$total = $result['total'];
$totalPages = $result['totalPages'];
$page = $result['page'];
$perpage = $result['perPage'];
