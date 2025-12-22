<?php
// Application Configuration

// Application Settings
define('APP_NAME', 'PPDB SMA Negeri Kota Padang');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development'); // development | production

// Base URL (auto-detect or set manually)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('BASE_URL', $protocol . '://' . $host . '/zonasi/public/');
define('ROOT_PATH', dirname(__DIR__) . '/');

// Timezone
date_default_timezone_set('Asia/Jakarta');

// Debug Mode
define('DEBUG_MODE', APP_ENV === 'development');

// Error Reporting
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
