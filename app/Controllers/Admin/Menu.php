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
        }
        if (count($_POST)) {
            if (empty($_POST['groups'])) {
                $message = 'Нельзя сохранить пустое меню';
            } else {
                $menuDate = false;
                if(!empty($_POST['date'])){
                    $menuDate = $storage->getMenuByDate($_POST['date']);
                }
                if($menuDate){
                    $message = 'Меню с такой датой уже существует';
                } else {
                    if(!empty($_POST['date'])){
                        $menu->date = $_POST['date'];
                    }
                    $menu->can_order = empty($_POST['can_order']) ? 0 : 1;
                    $positions = [];
                    foreach ($_POST['groups'] as $group) {
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
                    if($storage->save($menu)) {
                        $message = 'Сохранено';
                    } else {
                        $message = 'Ошибка' . $storage->error;
                    }
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