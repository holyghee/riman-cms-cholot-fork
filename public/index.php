<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Configure PHP for large file uploads (videos)
// Note: upload_max_filesize and post_max_size cannot be changed with ini_set()
// These must be set via command line flags or php.ini
@ini_set('max_execution_time', '300');
@ini_set('max_input_time', '300'); 
@ini_set('memory_limit', '256M');

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
