<?php

define('ROOT_DIR', __DIR__);
define('BASE_DIR', '/');

require ROOT_DIR . '/config/init.php';
require ROOT_DIR . '/vendor/autoload.php';

if ($warnings = \App\Support\Security::requestWarning()) {
    die($warnings);
}

$router = new \App\Support\Router();
$router->load(ROOT_DIR . '/config/routes.php');
if (! $router->run()) {
    http_response_code(404);
    echo '404 not found';
}
