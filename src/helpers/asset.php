<?php

/**
 * Asset helper - reads dist/asset-manifest.json and returns hashed filenames
 * Usage: echo BASE_PATH . '/dist/' . asset('output.css');
 */

if (!function_exists('asset')) {
  function asset(string $name): string
  {
    static $manifest = null;

    if ($manifest === null) {
      $manifestPath =
        dirname(__DIR__, 2) .
        DIRECTORY_SEPARATOR .
        'dist' .
        DIRECTORY_SEPARATOR .
        'asset-manifest.json';
      if (file_exists($manifestPath)) {
        $json = file_get_contents($manifestPath);
        $data = json_decode($json, true);
        if (is_array($data)) {
          $manifest = $data;
        } else {
          $manifest = [];
        }
      } else {
        $manifest = [];
      }
    }

    return $manifest[$name] ?? $name;
  }
}

if (!function_exists('asset_url')) {
  function asset_url(string $name): string
  {
    if (defined('BASE_PATH')) {
      return rtrim(BASE_PATH, '/') . '/dist/' . asset($name);
    }
    return '/dist/' . asset($name);
  }
}
