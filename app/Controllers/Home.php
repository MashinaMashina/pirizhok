<?php
namespace App\Controllers;

use App\Database\Database;
use App\Domain\Menu\Storage;
use App\Views\View;

class Home {
    public static function home()
    {
        $db = Database::get();
        $menu = (new Storage($db))->getMenuByDate();

        $view = new View();
        $view->render('menu', [
            'menu' => $menu,
        ]);
    }
}