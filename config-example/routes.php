<?php
$routes['/'] = '\App\Controllers\Home::home';
$routes['/admin/'] = '\App\Controllers\Admin\Home::home';
$routes['/admin/info/'] = '\App\Controllers\Admin\Info::home';
$routes['/admin/menu/'] = '\App\Controllers\Admin\Menu::home';
$routes['/admin/menu/edit/'] = '\App\Controllers\Admin\Menu::edit';
$routes['/admin/menu/edit/:num/'] = '\App\Controllers\Admin\Menu::edit';