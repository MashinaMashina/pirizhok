<?php

namespace App\Controllers\Admin;

use App\Database\Database;
use App\Domain\Menu\Storage;
use App\Support\Access;
use App\Views\View;

class Menu
{
    public static function home()
    {
        if (! Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        $menus = (new Storage(Database::get()))->getMenu();

        (new View())->render('admin/menu/list', [
            'menus' => $menus,
        ]);
    }

    public static function edit($params)
    {
        if (! Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        $message = '';
        $menu = (new Storage(Database::get()))->getMenuById($params[1]);

        if (! $menu) {
            echo 'menu not found';
            return;
        }

        if (count($_POST)) {
            //$menu
        }

        (new View())->render('admin/menu/edit', [
            'menu' => $menu,
            'csrf' => \App\Support\Security::csrf(),
            'message' => $message,
        ]);
    }
}