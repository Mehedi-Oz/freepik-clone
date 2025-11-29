<?php

/**
 * Image Service - Business logic for image operations
 */
class ImageService
{
  protected $repository;

  public function __construct(ImageRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Build filter conditions from request parameters
   * @param array $requestParams Request parameters ($_GET)
   * @return array Filter conditions array
   */
  public function buildFilters($requestParams)
  {
    $whereClause = "status = 'ACTIVE'";
    $params = [];
    $types = '';
    $selectScore = '';
    $orderBy = 'ORDER BY id DESC';

    // Search query (FULLTEXT)
    if (!empty($requestParams['search'])) {
      $searchTerm = $this->sanitizeSearchTerm($requestParams['search']);
      $escapedSearch = $this->repository->escapeString($searchTerm);

      $matchFilter = "MATCH(title, keyword, photoname) AGAINST('$escapedSearch' IN BOOLEAN MODE)";
      $matchScore = "MATCH(title, keyword, photoname) AGAINST('$escapedSearch' IN NATURAL LANGUAGE MODE)";

      $whereClause .= " AND $matchFilter";
      $selectScore = ", $matchScore as relevance_score";
      $orderBy = "ORDER BY relevance_score DESC";
    }

    // AI filter
    if (isset($requestParams['ai-type']) && in_array($requestParams['ai-type'], ALLOWED_AI_TYPES)) {
      $aiType = $requestParams['ai-type'];
      if ($aiType == 'only_ai') {
        $whereClause .= " AND UPPER(ai_gen) = 'YES'";
      } elseif ($aiType == 'exclude_ai') {
        $whereClause .= " AND (UPPER(ai_gen) != 'YES' OR ai_gen IS NULL)";
      }
    }

    // File type filter
    if (isset($requestParams['filetype']) && in_array($requestParams['filetype'], ALLOWED_FILE_TYPES)) {
      $filetype = $requestParams['filetype'];
      if ($filetype == '1') {
        $whereClause .= " AND scategory = 1";
      } elseif ($filetype == '2') {
        $whereClause .= " AND scategory = 2";
      }
    }

    // People filter
    if (isset($requestParams['people']) && in_array($requestParams['people'], ALLOWED_PEOPLE_VALUES)) {
      $people = $requestParams['people'];
      if ($people == 'No,0') {
        $whereClause .= " AND (human IN ('No', '0', 0) OR human IS NULL OR human = '')";
      } elseif ($people == '4+') {
        $whereClause .= " AND CAST(human AS UNSIGNED) >= 4";
      } elseif ($people != 'all') {
        $whereClause .= " AND human = ?";
        $params[] = $people;
        $types .= 's';
      }
    }

    // Orientation filter
    if (isset($requestParams['orientation']) && in_array($requestParams['orientation'], ALLOWED_ORIENTATIONS) && $requestParams['orientation'] != 'all') {
      $orientation = $requestParams['orientation'];
      $whereClause .= " AND orientation = ?";
      $params[] = $orientation;
      $types .= 's';
    }

    // Color filter
    if (isset($requestParams['color']) && in_array($requestParams['color'], ALLOWED_COLORS) && $requestParams['color'] != 'all') {
      $color = $requestParams['color'];
      $pattern = $this->buildColorPattern($color);
      $whereClause .= " AND colorcode REGEXP ?";
      $params[] = $pattern;
      $types .= 's';
    }

    // License filter
    if (isset($requestParams['license']) && in_array($requestParams['license'], ALLOWED_LICENSES) && $requestParams['license'] != 'all') {
      $license = $requestParams['license'];
      $whereClause .= " AND license = ?";
      $params[] = $license;
      $types .= 's';
    }

    return [
      'where' => $whereClause,
      'params' => $params,
      'types' => $types,
      'select_score' => $selectScore,
      'order_by' => $orderBy
    ];
  }

  /**
   * Sanitize search term for FULLTEXT search
   * @param string $term Search term
   * @return string Sanitized term
   */
  protected function sanitizeSearchTerm($term)
  {
    $term = str_replace('-', ' ', $term);
    $term = preg_replace('/[^\w\s-]/u', '', $term);
    $term = mb_substr($term, 0, 100);
    return $term;
  }

  /**
   * Build color regex pattern
   * @param string $color Color name
   * @return string Regex pattern
   */
  protected function buildColorPattern($color)
  {
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

    return $color_patterns[$color] ?? $color;
  }

  /**
   * Get images with pagination (with caching)
   * @param array $filters Filter conditions
   * @param int $page Page number
   * @param int $perPage Results per page
   * @param array $requestParams Original request parameters for cache key
   * @return array ['results' => mysqli_result, 'total' => int, 'totalPages' => int]
   */
  public function getImages($filters, $page, $perPage, $requestParams = [])
  {
    // Check if caching is requested (skip if nocache parameter is set)
    $useCache = !isset($requestParams['nocache']) && !isset($requestParams['_cache_bust']);
    $cacheKey = null;

    if ($useCache) {
      require_once __DIR__ . '/Cache.php';
      $cacheKey = Cache::generateKey(array_merge($requestParams, [
        'page' => $page,
        'perPage' => $perPage
      ]));

      $cached = Cache::get($cacheKey);
      if ($cached !== false && isset($cached['resultsArray'])) {
        // Convert cached array back to format expected by calling code
        // Note: We can't recreate mysqli_result, so we return the array
        // The calling code needs to handle both mysqli_result and array
        return [
          'results' => $cached['resultsArray'], // Array instead of mysqli_result
          'resultsArray' => $cached['resultsArray'],
          'total' => $cached['total'],
          'page' => $cached['page'],
          'totalPages' => $cached['totalPages'],
          'perPage' => $cached['perPage']
        ];
      }
    }

    $start = ($page - 1) * $perPage;

    // Cache count query separately (counts change less frequently)
    $countCacheKey = null;
    if ($useCache) {
      $countCacheKey = Cache::generateKey(array_merge($requestParams, ['type' => 'count']));
      $total = Cache::get($countCacheKey);
    }

    if ($total === false) {
      $total = $this->repository->getImageCount($filters);
      if ($useCache && $countCacheKey) {
        Cache::set($countCacheKey, $total, 600); // Cache count for 10 minutes
      }
    }

    $totalPages = max(1, ceil($total / $perPage));

    // Clamp page to valid range
    if ($page > $totalPages) {
      $page = $totalPages;
      $start = ($page - 1) * $perPage;
    }

    $results = $this->repository->searchImages($filters, $start, $perPage);

    // Convert mysqli_result to array for caching (mysqli_result cannot be serialized)
    $resultsArray = [];
    if ($results instanceof mysqli_result) {
      while ($row = mysqli_fetch_assoc($results)) {
        $resultsArray[] = $row;
      }
      // Reset result pointer for immediate use
      mysqli_data_seek($results, 0);
    } else {
      $resultsArray = $results;
    }

    $result = [
      'results' => $results, // Return original mysqli_result for immediate use
      'resultsArray' => $resultsArray, // Cached array version
      'total' => $total,
      'page' => $page,
      'totalPages' => $totalPages,
      'perPage' => $perPage
    ];

    // Cache the result (5 minutes for search results) - only cache the array version
    if ($useCache && $cacheKey) {
      $cacheableResult = [
        'resultsArray' => $resultsArray,
        'total' => $total,
        'page' => $page,
        'totalPages' => $totalPages,
        'perPage' => $perPage
      ];
      Cache::set($cacheKey, $cacheableResult, 300);
    }

    return $result;
  }
}
