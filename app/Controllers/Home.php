<?php

namespace App\Controllers;

use App\Database\Database;
use App\Domain\Menu\Storage;
use App\Views\View;

class Home
{
    public static function home()
    {
        $db = Database::get();
        $menu = (new Storage($db))->getMenuByDate();

        $view = new View();
        if (!$menu) {
            $view->render('menu/empty', [
                'message' => 'Нет меню на текущую дату',
            ]);
        } elseif (false) {
            $view->render('menu/simple', [
                'menu' => $menu,
            ]);
        } else {
            $view->render('menu/order', [
                'menu' => $menu,
            ]);
        }
    }
}