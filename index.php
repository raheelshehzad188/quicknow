<?php
// Source - https://stackoverflow.com/a/21429652
// Posted by Fancy John, modified by community. See post 'Timeline' for change history
// Retrieved 2026-03-09, License - CC BY-SA 4.0

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
die('OKK');

// Suppress vendor deprecations on PHP 8.4+ (must be first)
if (PHP_VERSION_ID >= 80400) {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
} else {
    error_reporting(E_ALL);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));