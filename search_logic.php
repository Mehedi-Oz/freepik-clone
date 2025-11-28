<?php
// Shared search and filter logic for both API and initial page load

$raw_q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Fix: .htaccess rewrites index.html to ?q=index.html
// Treat as empty search to show homepage
if ($raw_q === 'index.html' || $raw_q === 'index.php') {
  $raw_q = '';
}

$q = $raw_q ?: 'wallpaper'; // Default search term
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perpage = 20;

$pl = str_replace('-', ' ', $q); // SEO-friendly URLs: photo-editing → photo editing
$pl = mysqli_real_escape_string($dbcon, $pl);
$start = ($page - 1) * $perpage;

// AI-generated filter
$ai_condition = "";
if (isset($_GET['ai-type'])) {
  $aiType = $_GET['ai-type'];
  if ($aiType == 'only_ai') {
    $ai_condition = " AND UPPER(ai_gen) = 'YES' ";
  } elseif ($aiType == 'exclude_ai') {
    $ai_condition = " AND (UPPER(ai_gen) != 'YES' OR ai_gen IS NULL) ";
  }
}

// File type filter (PNG/JPG)
$filetype_condition = "";
if (isset($_GET['filetype'])) {
  $filetype = $_GET['filetype'];
  if ($filetype == '1') {
    $filetype_condition = " AND scategory = 1 ";
  } elseif ($filetype == '2') {
    $filetype_condition = " AND scategory = 2 ";
  }
}

// Number of people in image
$people_condition = "";
if (isset($_GET['people'])) {
  $people = $_GET['people'];
  if ($people == 'all') {
    $people_condition = "";
  } elseif ($people == 'No,0') {
    $people_condition = " AND (human IN ('No', '0', 0) OR human IS NULL OR human = '') ";
  } elseif ($people == '4+') {
    $people_condition = " AND CAST(human AS UNSIGNED) >= 4 ";
  } else {
    $people_condition = " AND human = '" . mysqli_real_escape_string($dbcon, $people) . "' ";
  }
}

// Image orientation (landscape/portrait/square)
$orientation_condition = "";
if (isset($_GET['orientation'])) {
  $orientation = $_GET['orientation'];
  if ($orientation != 'all' && $orientation != '') {
    $orientation_condition = " AND orientation = '" . mysqli_real_escape_string($dbcon, $orientation) . "' ";
  }
}

// Color filter using regex patterns
$color_condition = "";
if (isset($_GET['color'])) {
  $color = $_GET['color'];
  if ($color != 'all' && $color != '') {
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
      $color_condition = " AND colorcode REGEXP '" . mysqli_real_escape_string($dbcon, $pattern) . "' ";
    }
  }
}

// License type filter
$license_condition = "";
if (isset($_GET['license'])) {
  $license = $_GET['license'];
  if ($license != 'all' && $license != '') {
    $license_condition = " AND license = '" . mysqli_real_escape_string($dbcon, $license) . "' ";
  }
}

// Build search query with full-text search
if ($raw_q !== '') {
  // Boolean mode: strict filtering
  $match_clause_filter = "MATCH(title, keyword, photoname) AGAINST('$pl' IN BOOLEAN MODE)";
  // Natural language mode: relevance scoring
  $match_clause_score = "MATCH(title, keyword, photoname) AGAINST('$pl' IN NATURAL LANGUAGE MODE)";

  $search_condition = " AND $match_clause_filter ";
  $select_score_col = ", $match_clause_score as relevance_score";
  $order_by = "ORDER BY relevance_score DESC";
} else {
  // No search query
  $search_condition = "";
  $select_score_col = "";
  $order_by = "ORDER BY id DESC";
}

// Add pagination logic
if (isset($_GET['page'])) {
  $page = max(1, (int)$_GET['page']); // Ensure page is at least 1
} else {
  $page = 1;
}
$perpage = 20; // Number of results per page
$start = ($page - 1) * $perpage;

// Debugging: Log page parameter and offset calculation
error_log("Page parameter: " . $page);
error_log("Calculated start: " . $start);

// Update total count query for pagination
$countSql = "SELECT COUNT(*) AS total_rows FROM shajal_photo_posts WHERE status = 'ACTIVE' $search_condition $ai_condition $filetype_condition $people_condition $orientation_condition $color_condition $license_condition";
$countQuery = mysqli_query($dbcon, $countSql);

if (!$countQuery) {
  $total = 0;
} else {
  $totalRow = mysqli_fetch_assoc($countQuery);
  $total = $totalRow['total_rows'];
}

// Calculate total pages and validate current page
$totalPages = max(1, ceil($total / $perpage));

// Clamp page to valid range (1 to totalPages)
if ($page > $totalPages) {
  $page = $totalPages;
  $start = ($page - 1) * $perpage;
}

// Fetch image results with applied filters
$sql = "
  SELECT id, title, view_thumb_img $select_score_col
  FROM shajal_photo_posts
  WHERE status = 'ACTIVE' $search_condition $ai_condition $filetype_condition $people_condition $orientation_condition $color_condition $license_condition
  $order_by
  LIMIT $start, $perpage
";

error_log("SQL Query: " . $sql);
$slis = mysqli_query($dbcon, $sql);

if (!$slis) {
  error_log("SQL Error: " . mysqli_error($dbcon));
} else {
  error_log("Results fetched successfully.");
}
