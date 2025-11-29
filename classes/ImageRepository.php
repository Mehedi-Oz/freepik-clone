<?php

/**
 * Image Repository - Handles all image-related database operations
 */
class ImageRepository extends Repository
{
  protected $tableName = 'shajal_photo_posts';

  /**
   * Search images with filters and pagination
   * @param array $filters Filter conditions
   * @param int $start Offset for pagination
   * @param int $limit Number of results per page
   * @return mysqli_result|false Query result
   */
  public function searchImages($filters, $start, $limit)
  {
    $whereClause = $filters['where'] ?? "status = 'ACTIVE'";
    $selectScore = $filters['select_score'] ?? '';
    $orderBy = $filters['order_by'] ?? 'ORDER BY id DESC';

    $sql = "SELECT id, title, view_thumb_img $selectScore
            FROM {$this->tableName}
            WHERE $whereClause
            $orderBy
            LIMIT ?, ?";

    $types = $filters['types'] ?? 'ii';
    $params = array_merge($filters['params'] ?? [], [$start, $limit]);
    $types .= 'ii'; // Add types for LIMIT parameters

    return $this->executeQuery($sql, $types, $params);
  }

  /**
   * Get total count of images matching filters
   * @param array $filters Filter conditions
   * @return int Total count
   */
  public function getImageCount($filters)
  {
    $whereClause = $filters['where'] ?? "status = 'ACTIVE'";

    $types = $filters['types'] ?? '';
    $params = $filters['params'] ?? [];

    return $this->getCount($this->tableName, $whereClause, $types, $params);
  }
}
