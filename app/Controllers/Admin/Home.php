<?php

namespace App\Controllers\Admin;

use App\Views\View;

class Home
{
    public static function home()
    {
        if (! \App\Support\Access::getInstance()->isAuthorized()) {
            http_response_code(401);
            echo 'not authorized';
            return;
        }

        (new View())->render('admin/home');
    }
}