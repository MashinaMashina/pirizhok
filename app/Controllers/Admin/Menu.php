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
            http_response_code(401);
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
            http_response_code(401);
            echo 'not authorized';
            return;
        }

        $message = '';
        $storage = new Storage(Database::get());
        if (!empty($params[1])) {
            $menu = $storage->getMenuById($params[1]);

            if (! $menu) {
                echo 'menu not found';
                return;
            }
        } else {
            $menu = new \App\Domain\Menu\Menu();
        }

        if (count($_POST)) {
            $oldDate = $menu->date;
            if(!empty($_POST['date'])){
                $menu->date = $_POST['date'];
            }
            $menu->can_order = empty($_POST['can_order']) ? 0 : 1;
            $positions = [];
            $groups = $_POST['groups'] ?? [];
            foreach ($groups as $group) {
                if(trim($group['name']) == ""){
                    $group['name'] = "Без группы";
                }
                foreach ($group['positions'] as $position) {
                    if(trim($position['name']) == ""){
                        continue;
                    }
                    $pos = new Position();
                    $pos->group_name = $group['name'] ?? '';
                    $pos->name = $position['name'] ?? '';
                    $pos->price = $position['price'] ?? '';
                    $pos->weight = $position['weight'] ?? '';
                    $positions[] = $pos;
                }
            }

            $menu->positions = $positions;

            if (empty($_POST['groups'])) {
                $message = 'Нельзя сохранить пустое меню';
            } elseif (empty($oldDate) and empty($_POST['date'])) {
                $message = 'Укажите дату для меню';
            } elseif (empty($oldDate) and $storage->getMenuByDate($_POST['date']) ?? '') {
                $message = 'Меню с такой датой уже существует';
            } else {
                if($storage->save($menu)) {
                    $message = 'Сохранено';

                    if (empty($params[1])) {
                        header('Location: ' . BASE_DIR . 'admin/menu/edit/' . $menu->id, true, 302);
                        return;
                    }
                } else {
                    $message = 'Ошибка' . $storage->error;
                }
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