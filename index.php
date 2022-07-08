<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT_DIR', __DIR__);
define('BASE_DIR', '/');

require 'vendor/autoload.php';

if ($warnings = \App\Support\Security::requestWarning()) {
    die($warnings);
}

$router = new \App\Support\Router();
$router->load(ROOT_DIR . '/config/routes.php');
$router->run();
