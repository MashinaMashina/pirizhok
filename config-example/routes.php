<?php
$routes['/'] = '\App\Controllers\Home::home';
$routes['/order/create/'] = '\App\Controllers\Order::create';

$routes['/admin/'] = '\App\Controllers\Admin\Home::home';
$routes['/admin/info/'] = '\App\Controllers\Admin\Info::home';

$routes['/admin/company/'] = '\App\Controllers\Admin\Company::home';
$routes['/admin/company/edit/'] = '\App\Controllers\Admin\Company::edit';
$routes['/admin/company/edit/:num/'] = '\App\Controllers\Admin\Company::edit';

$routes['/admin/menu/'] = '\App\Controllers\Admin\Menu::home';
$routes['/admin/menu/edit/'] = '\App\Controllers\Admin\Menu::edit';
$routes['/admin/menu/edit/:num/'] = '\App\Controllers\Admin\Menu::edit';

$routes['/admin/order/'] = '\App\Controllers\Admin\Order::home';
$routes['/admin/order/edit/:num/'] = '\App\Controllers\Admin\Order::edit';

$routes['/orders/'] = '\App\Controllers\Order::view';