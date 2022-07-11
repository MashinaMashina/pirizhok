<?php

namespace App\Domain\Menu;

class Storage
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getMenuById($id)
    {
        $menus = $this->getMenu(['id' => $id]);

        return $menus[0] ?? false;
    }

    public function getMenuByDate($date = 'current')
    {
        if ($date === 'current') {
            $date = date('d.m.Y');
        }

        $menu = $this->getMenu(['date' => $date]);

        return $menu[0] ?? false;
    }

    public function getMenu($filter = [])
    {
        $menu1 = new Menu();
        $menu1->id = 1;
        $menu1->date = '2022-10-10';

        $menu2 = new Menu();
        $menu2->id = 2;
        $menu2->date = '2022-10-10';

        return [$menu1, $menu2];
    }
}