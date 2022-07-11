<?php

namespace App\Controllers\Admin;

use App\Database\Database;
use App\Domain\Menu\Position;
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
        $storage = new Storage(Database::get());
        $menu = false;
        if (!empty($params[1])) {
            $menu = $storage->getMenuById($params[1]);

            if (! $menu) {
                echo 'menu not found';
                return;
            }
        } else {
            $menu = new \App\Domain\Menu\Menu();
            $menu->date = date('Y-m-d');
        }

        if (count($_POST)) {
            if (empty($_POST['groups'])) {
                $message = 'Нельзя сохранить пустое меню';
            } else {
                $positions = [];
                foreach ($_POST['groups'] as $group) {
                    foreach ($group['positions'] as $position) {
                        $pos = new Position();
                        $pos->group_name = $group['name'] ?? '';
                        $pos->name = $position['name'] ?? '';
                        $pos->price = $position['price'] ?? '';
                        $pos->weight = $position['weight'] ?? '';

                        $positions[] = $pos;
                    }
                }

                $menu->positions = $positions;
                $storage->save($menu);
            }
        }

        $groups = [];
        if (!empty($menu->positions)) {
            foreach ($menu->positions as $position) {
                $groups[$position->group_name][] = $position;
            }
        }

        (new View())->render('admin/menu/edit', [
            'menu' => $menu,
            'csrf' => \App\Support\Security::csrf(),
            'message' => $message,
            'groups' => $groups,
        ]);
    }
}