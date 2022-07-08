<?php

namespace App\Controllers\Admin;

use App\Views\View;

class Home
{
    public static function home()
    {
        if (! \App\Support\Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        (new View())->render('admin/home');
    }
}