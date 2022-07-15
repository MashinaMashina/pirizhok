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
        $info = (new \App\Domain\Info\Storage)->getInfo();
        $company = (new \App\Domain\Company\Storage($db))->getByCode($_GET['company'] ?? '');

        $view = new View();
        if (!$menu) {
            $view->render('menu/empty', [
                'message' => 'Нет меню на текущую дату',
                'info' => $info,
            ]);
        } elseif (!$company or $menu->can_order == 0) {
            $view->render('menu/simple', [
                'menu' => $menu,
                'info' => $info,
                'company' => $company,
            ]);
        } else {
            $view->render('menu/order', [
                'info' => $info,
                'company' => $company,
                'menu' => $menu,
            ]);
        }
    }
}