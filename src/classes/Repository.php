<?php

/**
 * Repository Pattern for Database Access
 * Provides abstraction layer for database operations
 */
class Repository
{
  protected $dbcon;

  public function __construct($dbcon)
  {
    $this->dbcon = $dbcon;
  }

  /**
   * Execute a prepared statement query
   * @param string $sql SQL query with placeholders
   * @param string $types Parameter types (e.g., 'sii' for string, int, int)
   * @param array $params Parameters to bind
   * @return mysqli_result|false Query result or false on failure
   */
  public function executeQuery($sql, $types = '', $params = [])
  {
    $stmt = $this->dbcon->prepare($sql);

    if (!$stmt) {
      if (ENVIRONMENT === 'development') {
        error_log("Repository: Prepare failed - " . mysqli_error($this->dbcon));
      }
      return false;
    }

    if (!empty($params) && !empty($types)) {
      $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
      if (ENVIRONMENT === 'development') {
        error_log("Repository: Execute failed - " . $stmt->error);
      }
      $stmt->close();
      return false;
    }

    $result = $stmt->get_result();
    // Note: Don't close $stmt here - caller may need to use it
    return $result;
  }

  /**
   * Get count of rows matching conditions
   * @param string $table Table name
   * @param string $whereClause WHERE clause (without WHERE keyword)
   * @param string $types Parameter types
   * @param array $params Parameters to bind
   * @return int Count of rows
   */
  public function getCount($table, $whereClause = '', $types = '', $params = [])
  {
    $sql = "SELECT COUNT(*) as total_rows FROM $table";

    if (!empty($whereClause)) {
      $sql .= " WHERE $whereClause";
    }

    if (!empty($params) && !empty($types)) {
      $result = $this->executeQuery($sql, $types, $params);
    } else {
      $result = mysqli_query($this->dbcon, $sql);
    }

    if (!$result) {
      if (ENVIRONMENT === 'development') {
        error_log("Repository: Count query failed - " . mysqli_error($this->dbcon));
      }
      return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return $row ? (int)$row['total_rows'] : 0;
  }

  /**
   * Escape string for use in SQL (for FULLTEXT search where prepared statements don't work)
   * @param string $string String to escape
   * @return string Escaped string
   */
  public function escapeString($string)
  {
    return mysqli_real_escape_string($this->dbcon, $string);
  }
}
