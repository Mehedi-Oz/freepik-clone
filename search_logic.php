<?php
// Shared search and filter logic for both API and initial page load
// Security: Uses prepared statements and input validation

// Include configuration
if (!defined('ENVIRONMENT')) {
  include_once 'config.php';
}

// Include Repository and Service classes
require_once 'classes/Repository.php';
require_once 'classes/ImageRepository.php';
require_once 'classes/ImageService.php';

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

// Legacy code below - keeping for reference but now using service pattern above
// ============================================
// OLD FILTER BUILDING CODE (DEPRECATED - Using Service now)
// ============================================
/*

// Prepare search term for full-text search (sanitized)
$pl = str_replace('-', ' ', $q); // SEO-friendly URLs: photo-editing → photo editing
// Remove potentially dangerous characters for FULLTEXT search
$pl = preg_replace('/[^\w\s-]/u', '', $pl); // Allow only word chars, spaces, hyphens
$pl = mb_substr($pl, 0, 100); // Limit length

// ============================================
// FILTER VALIDATION (Whitelist Approach)
// ============================================

// AI-generated filter with validation
$ai_condition = "";
$ai_condition_params = [];
$ai_condition_types = "";

if (isset($_GET['ai-type'])) {
  $aiType = $_GET['ai-type'];
  // Whitelist validation
  if (in_array($aiType, ALLOWED_AI_TYPES)) {
    if ($aiType == 'only_ai') {
      $ai_condition = " AND UPPER(ai_gen) = 'YES' ";
    } elseif ($aiType == 'exclude_ai') {
      $ai_condition = " AND (UPPER(ai_gen) != 'YES' OR ai_gen IS NULL) ";
    }
    // 'show_all' requires no condition
  }
}

// File type filter with validation
$filetype_condition = "";
$filetype_condition_params = [];
$filetype_condition_types = "";

if (isset($_GET['filetype'])) {
  $filetype = $_GET['filetype'];
  // Whitelist validation
  if (in_array($filetype, ALLOWED_FILE_TYPES)) {
    if ($filetype == '1') {
      $filetype_condition = " AND scategory = 1 ";
    } elseif ($filetype == '2') {
      $filetype_condition = " AND scategory = 2 ";
    }
    // 'all' requires no condition
  }
}

// Number of people in image with validation
$people_condition = "";
$people_condition_params = [];
$people_condition_types = "";

if (isset($_GET['people'])) {
  $people = $_GET['people'];
  // Whitelist validation
  if (in_array($people, ALLOWED_PEOPLE_VALUES)) {
    if ($people == 'all') {
      $people_condition = "";
    } elseif ($people == 'No,0') {
      $people_condition = " AND (human IN ('No', '0', 0) OR human IS NULL OR human = '') ";
    } elseif ($people == '4+') {
      $people_condition = " AND CAST(human AS UNSIGNED) >= 4 ";
    } else {
      // Use prepared statement for numeric people values
      $people_condition = " AND human = ? ";
      $people_condition_params[] = $people;
      $people_condition_types .= "s";
    }
  }
}

// Image orientation with validation
$orientation_condition = "";
$orientation_condition_params = [];
$orientation_condition_types = "";

if (isset($_GET['orientation'])) {
  $orientation = $_GET['orientation'];
  // Whitelist validation
  if (in_array($orientation, ALLOWED_ORIENTATIONS) && $orientation != 'all') {
    $orientation_condition = " AND orientation = ? ";
    $orientation_condition_params[] = $orientation;
    $orientation_condition_types .= "s";
  }
}

// Color filter using regex patterns (whitelist approach)
$color_condition = "";
$color_condition_params = [];
$color_condition_types = "";

if (isset($_GET['color'])) {
  $color = $_GET['color'];
  // Whitelist validation - only allow predefined colors
  if (in_array($color, ALLOWED_COLORS) && $color != 'all') {
    // Hex color patterns for matching dominant image colors
    $color_patterns = [
      'red' => '#(ff|ed|ea|e6|c0|bf|bb|ba|b9|bc|b8|ae|a0|99|98|90|87|80|7f|70|c1|c2|c8|c9|ca|d4|44|55)[0-9a-f]{4}',
      'orange' => '#(ff9|ffc|fba|faa|fcb|fca|d18|d08|ce9|dc9|e59|cc9|c9a|cba|cda|b85|b75|aa7|ac8|af8|9f7|dac)[0-9a-f]{3}',
      'yellow' => '#(fff|aaa|b6a|e1c|e2d|d5b|c8a|c9a|d0b|d1b|d3b)[0-9a-f]{3}',
      'green' => '#(477|607|758|728|748|6b8|556|285|55d|50b|50a|56b|62b|69c|7eb|7db|849|89a|96d|a1e|b5c|b5b|b3b|64c)[0-9a-f]{3}',
      'blue' => '#(2a2|006|4c8|4b8|4e7|356|546|6e6|636|6d9|6f9|6a9|768|718|599|598|588|568|85b|86b|8bb|a2c|a3c|aac|00a|5ba|63a|62a|4a2|4f2|621|631|641|637|7f2|300)[0-9a-f]{3}',
      'purple' => '#(5b4|992|751|761|732|780|ada|797|777|1c0|e30)[0-9a-f]{3}',
      'pink' => '#(f55|ff6|ff1|d2a|db7|ff0|ffc|ffb)[0-9a-f]{3}',
      'gray' => '#([0-9a-f])\\1([0-9a-f])\\2([0-9a-f])\\3',
      'black' => '#[0-3][0-9a-f]{5}',
      'white' => '#f[c-f][0-9a-f]{4}',
      'teal' => '#(4c6|5f9|5fc|51b|3ea|5a9|5a9|498|008|00f|00c|20b|40e|48d|00d)[0-9a-f]{3}',
      'lime' => '#(70f|6df|6cf|6bf|57f|45e|37f|8cf|00f|7ff|7cf|adf|32c|9ac|def)[0-9a-f]{3}',
      'brown' => '#(8b7|886|8a7|8a7|665|5a2|662|663|693|6b3|724|734|7c5|6f4|5d2|5c2|4d3|4e3|472|452|413|3a2|3b2|392|382|331|321|2f0|2d1|996|917|847)[0-9a-f]{3}'
    ];

    if (isset($color_patterns[$color])) {
      $pattern = $color_patterns[$color];
      // Use prepared statement for REGEXP pattern
      $color_condition = " AND colorcode REGEXP ? ";
      $color_condition_params[] = $pattern;
      $color_condition_types .= "s";
    }
  }
}

// License type filter with validation
$license_condition = "";
$license_condition_params = [];
$license_condition_types = "";

if (isset($_GET['license'])) {
  $license = $_GET['license'];
  // Whitelist validation
  if (in_array($license, ALLOWED_LICENSES) && $license != 'all') {
    $license_condition = " AND license = ? ";
    $license_condition_params[] = $license;
    $license_condition_types .= "s";
  }
}

// ============================================
// BUILD QUERY WITH PREPARED STATEMENTS
// ============================================

// Build search query with full-text search
// Note: FULLTEXT search doesn't support prepared statements directly,
// but we've sanitized $pl above to prevent injection
$search_condition = "";
$select_score_col = "";
$order_by = "";

if ($raw_q !== '' && !empty($pl)) {
  // Sanitized search term - safe for interpolation after validation
  $escaped_pl = mysqli_real_escape_string($dbcon, $pl);
  // Boolean mode: strict filtering
  $match_clause_filter = "MATCH(title, keyword, photoname) AGAINST('$escaped_pl' IN BOOLEAN MODE)";
  // Natural language mode: relevance scoring
  $match_clause_score = "MATCH(title, keyword, photoname) AGAINST('$escaped_pl' IN NATURAL LANGUAGE MODE)";

  $search_condition = " AND $match_clause_filter ";
  $select_score_col = ", $match_clause_score as relevance_score";
  $order_by = "ORDER BY relevance_score DESC";
} else {
  // No search query
  $search_condition = "";
  $select_score_col = "";
  $order_by = "ORDER BY id DESC";
}

// Combine all condition parameters
$all_params = array_merge(
  $people_condition_params,
  $orientation_condition_params,
  $color_condition_params,
  $license_condition_params
);
$all_types = $people_condition_types . $orientation_condition_types . $color_condition_types . $license_condition_types;

// Add pagination parameters
$all_params[] = $start;
$all_params[] = $perpage;
$all_types .= "ii";

// Build base WHERE clause
$where_clause = "status = 'ACTIVE'";
$where_clause .= $search_condition;
$where_clause .= $ai_condition;
$where_clause .= $filetype_condition;
$where_clause .= $people_condition;
$where_clause .= $orientation_condition;
$where_clause .= $color_condition;
$where_clause .= $license_condition;

// ============================================
// COUNT QUERY (for pagination)
// ============================================

// Build count query with placeholders
$countSql = "SELECT COUNT(*) AS total_rows FROM shajal_photo_posts WHERE $where_clause";

// Prepare count query parameters (without pagination)
$count_params = array_merge(
  $people_condition_params,
  $orientation_condition_params,
  $color_condition_params,
  $license_condition_params
);
$count_types = $people_condition_types . $orientation_condition_types . $color_condition_types . $license_condition_types;

// Use prepared statement for count query if we have parameters
if (!empty($count_params) && !empty($count_types)) {
  $countStmt = $dbcon->prepare($countSql);
  if ($countStmt) {
    $countStmt->bind_param($count_types, ...$count_params);
    if ($countStmt->execute()) {
      $countResult = $countStmt->get_result();
      $totalRow = $countResult->fetch_assoc();
      $total = $totalRow ? (int)$totalRow['total_rows'] : 0;
    } else {
      $total = 0;
      if (ENVIRONMENT === 'development') {
        error_log("Count query execution failed: " . $countStmt->error);
      }
    }
    $countStmt->close();
  } else {
    // Fallback to regular query if prepare fails
    if (ENVIRONMENT === 'development') {
      error_log("Count query prepare failed: " . mysqli_error($dbcon));
    }
    $countQuery = mysqli_query($dbcon, $countSql);
    $total = $countQuery ? (int)mysqli_fetch_assoc($countQuery)['total_rows'] : 0;
  }
} else {
  // No parameters, use regular query
  $countQuery = mysqli_query($dbcon, $countSql);
  if (!$countQuery) {
    $total = 0;
    if (ENVIRONMENT === 'development') {
      error_log("Count query failed: " . mysqli_error($dbcon));
    }
  } else {
    $totalRow = mysqli_fetch_assoc($countQuery);
    $total = $totalRow ? (int)$totalRow['total_rows'] : 0;
  }
}

// Calculate total pages and validate current page
$totalPages = max(1, ceil($total / $perpage));

// Clamp page to valid range (1 to totalPages)
if ($page > $totalPages) {
  $page = $totalPages;
  $start = ($page - 1) * $perpage;
  // Update pagination params
  $all_params[count($all_params) - 2] = $start;
}

// ============================================
// MAIN QUERY (with prepared statements)
// ============================================

$sql = "SELECT id, title, view_thumb_img $select_score_col
        FROM shajal_photo_posts
        WHERE $where_clause
        $order_by
        LIMIT ?, ?";

// Use prepared statement
$stmt = $dbcon->prepare($sql);

if ($stmt) {
  // Bind all parameters including pagination
  if (!empty($all_params)) {
    $stmt->bind_param($all_types, ...$all_params);
  }

  if ($stmt->execute()) {
    $slis = $stmt->get_result();

    // Log only in development
    if (ENVIRONMENT === 'development') {
      error_log("Query executed successfully. Results: " . ($slis ? $slis->num_rows : 0));
    }
  } else {
    $slis = false;
    if (ENVIRONMENT === 'development') {
      error_log("Query execution failed: " . $stmt->error);
    }
  }
  // Note: Don't close $stmt here - it's used by calling code
} else {
  // Fallback to regular query if prepare fails (shouldn't happen with proper SQL)
  if (ENVIRONMENT === 'development') {
    error_log("Prepare failed: " . mysqli_error($dbcon));
    error_log("SQL: " . $sql);
  }

  // Fallback - but this should be avoided
  $slis = mysqli_query($dbcon, $sql);

  if (!$slis && ENVIRONMENT === 'development') {
    error_log("Fallback query failed: " . mysqli_error($dbcon));
  }
}
*/
