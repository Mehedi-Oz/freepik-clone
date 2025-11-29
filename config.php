<?php
// Application configuration
// Define environment: 'development' or 'production'
define('ENVIRONMENT', getenv('APP_ENV') ?: 'production');

// Error reporting based on environment
if (ENVIRONMENT === 'development') {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
} else {
  error_reporting(E_ALL);
  ini_set('display_errors', 0);
  ini_set('log_errors', 1);
}

// Constants for validation
define('MAX_PAGE_NUMBER', 1000);
define('MIN_PAGE_NUMBER', 1);
define('RESULTS_PER_PAGE', 20);

// Allowed filter values (whitelist approach)
define('ALLOWED_AI_TYPES', ['show_all', 'only_ai', 'exclude_ai']);
define('ALLOWED_FILE_TYPES', ['all', '1', '2']);
define('ALLOWED_ORIENTATIONS', ['all', 'landscape', 'portrait', 'square']);
define('ALLOWED_LICENSES', ['all', 'free', 'premium']);
define('ALLOWED_COLORS', ['all', 'red', 'orange', 'yellow', 'green', 'blue', 'purple', 'pink', 'gray', 'black', 'white', 'teal', 'lime', 'brown']);
define('ALLOWED_PEOPLE_VALUES', ['all', 'No,0', '1', '2', '3', '4+']);
