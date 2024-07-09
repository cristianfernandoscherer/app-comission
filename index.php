<?php

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require './vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require './app/Application/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require './app/Application/dependencies.php';

// Register middleware
require './app/Application/middleware.php';

// Register routes
require './app/Application/routes.php';

// Run!
$app->run();
