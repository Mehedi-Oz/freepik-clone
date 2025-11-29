<?php

/**
 * Simple Cache Implementation
 * Supports APCu (preferred) or file-based caching as fallback
 *
 * Note: APCu functions are checked with function_exists() before use.
 * Linter warnings about undefined APCu functions are false positives.
 */
class Cache
{
  private static $enabled = null;
  private static $cacheDir = null;

  /**
   * Check if caching is available
   * @return bool
   */
  private static function isEnabled()
  {
    if (self::$enabled === null) {
      // Try APCu first (faster, in-memory)
      // APCu functions are available when extension is installed
      $apcuEnabled = function_exists('apcu_enabled');
      $apcuFetch = function_exists('apcu_fetch');

      if ($apcuEnabled && $apcuFetch) {
        /** @var callable $apcuEnabledFunc */
        $apcuEnabledFunc = 'apcu_enabled';
        if ($apcuEnabledFunc()) {
          self::$enabled = 'apcu';
        } else {
          // APCu exists but is disabled, fallback to file-based cache
          self::$cacheDir = __DIR__ . '/../cache';
          if (!is_dir(self::$cacheDir)) {
            @mkdir(self::$cacheDir, 0755, true);
          }
          self::$enabled = is_writable(self::$cacheDir) ? 'file' : false;
        }
      } else {
        // Fallback to file-based cache
        self::$cacheDir = __DIR__ . '/../cache';
        if (!is_dir(self::$cacheDir)) {
          @mkdir(self::$cacheDir, 0755, true);
        }
        self::$enabled = is_writable(self::$cacheDir) ? 'file' : false;
      }
    }
    return self::$enabled !== false;
  }

  /**
   * Get cached value
   * @param string $key Cache key
   * @return mixed|false Cached value or false if not found/expired
   */
  public static function get($key)
  {
    if (!self::isEnabled()) {
      return false;
    }

    if (self::$enabled === 'apcu' && function_exists('apcu_fetch')) {
      /** @var callable $apcuFetchFunc */
      $apcuFetchFunc = 'apcu_fetch';
      $cached = $apcuFetchFunc($key);
      return $cached !== false ? $cached : false;
    } else {
      // File-based cache
      $file = self::$cacheDir . '/' . md5($key) . '.cache';
      if (!file_exists($file)) {
        return false;
      }

      $data = @unserialize(file_get_contents($file));
      if ($data === false || !isset($data['expires']) || !isset($data['value'])) {
        return false;
      }

      // Check if expired
      if ($data['expires'] < time()) {
        @unlink($file);
        return false;
      }

      return $data['value'];
    }
  }

  /**
   * Store value in cache
   * @param string $key Cache key
   * @param mixed $value Value to cache
   * @param int $ttl Time to live in seconds (default: 300 = 5 minutes)
   * @return bool Success
   */
  public static function set($key, $value, $ttl = 300)
  {
    if (!self::isEnabled()) {
      return false;
    }

    if (self::$enabled === 'apcu' && function_exists('apcu_store')) {
      /** @var callable $apcuStoreFunc */
      $apcuStoreFunc = 'apcu_store';
      return $apcuStoreFunc($key, $value, $ttl);
    } else {
      // File-based cache
      $file = self::$cacheDir . '/' . md5($key) . '.cache';
      $data = [
        'value' => $value,
        'expires' => time() + $ttl
      ];
      return @file_put_contents($file, serialize($data)) !== false;
    }
  }

  /**
   * Delete cached value
   * @param string $key Cache key
   * @return bool Success
   */
  public static function delete($key)
  {
    if (!self::isEnabled()) {
      return false;
    }

    if (self::$enabled === 'apcu' && function_exists('apcu_delete')) {
      /** @var callable $apcuDeleteFunc */
      $apcuDeleteFunc = 'apcu_delete';
      return $apcuDeleteFunc($key);
    } else {
      $file = self::$cacheDir . '/' . md5($key) . '.cache';
      return @unlink($file);
    }
  }

  /**
   * Clear all cache
   * @return bool Success
   */
  public static function clear()
  {
    if (!self::isEnabled()) {
      return false;
    }

    if (self::$enabled === 'apcu' && function_exists('apcu_clear_cache')) {
      /** @var callable $apcuClearFunc */
      $apcuClearFunc = 'apcu_clear_cache';
      return $apcuClearFunc();
    } else {
      $files = glob(self::$cacheDir . '/*.cache');
      foreach ($files as $file) {
        @unlink($file);
      }
      return true;
    }
  }

  /**
   * Generate cache key from parameters
   * @param array $params Parameters to include in key
   * @return string Cache key
   */
  public static function generateKey($params)
  {
    // Remove non-cacheable parameters
    $cacheableParams = $params;
    unset($cacheableParams['_cache_bust'], $cacheableParams['nocache']);

    // Sort to ensure consistent keys
    ksort($cacheableParams);
    return 'img_search_' . md5(serialize($cacheableParams));
  }
}
