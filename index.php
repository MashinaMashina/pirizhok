<?php

define('ROOT_DIR', __DIR__);
define('BASE_DIR', '/');

require 'vendor/autoload.php';

$router = new \App\Support\Router();
$router->load(ROOT_DIR . '/config/routes.php');
$router->run();
