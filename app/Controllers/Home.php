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

        $companyStorage = new \App\Domain\Company\Storage(Database::get());

        $company = $companyStorage->getByCode($_GET['company'] ?? '');

        $view = new View();
        if (!$menu) {
            $view->render('menu/empty', [
                'message' => 'Нет меню на текущую дату',
            ]);
        } elseif (!$company or $menu->can_order == 0) {
            $view->render('menu/simple', [
                'menu' => $menu,
            ]);
        } else {
            $view->render('menu/order', [
                'company' => $company,
                'menu' => $menu,
            ]);
        }
    }
}