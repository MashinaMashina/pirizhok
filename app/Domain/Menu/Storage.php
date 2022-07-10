<?php

namespace App\Domain\Menu;

use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;
use NilPortugues\Sql\QueryBuilder\Syntax\OrderBy;

class Storage
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getMenuById($id)
    {
        return $this->getMenu(['id' => $id]);
    }

    public function getMenuByDate($date = 'current')
    {
        if ($date === 'current') {
            $date = date('Y-m-d');
        }

        $builder = new MySqlBuilder();

        $menu = $this->getMenu(['date' => $date]);

//        $id = $menu[0]->id;
//
//        $query = $builder->select()
//            ->setTable('position')
//            ->orderBy('group_name', OrderBy::ASC)
//            ->where()
//            ->equals("menu_id", $id)
//                ->end();
//
//        $stmt = $this->conn->prepare($builder->writeFormatted($query));
//        $stmt->execute($builder->getValues());
//        $result = $stmt->fetchAll();

        return $menu[0] ?? false;
    }

    public function getMenu($filter = [])
    {
        $builder = new MySqlBuilder();

        $query = $builder->select()
            ->setTable('menu');

        foreach ($filter as $item => $value) {
            $query->where()
                ->equals($item, $value)
                ->end();
        }

        $sql = $builder->writeFormatted($query);
        $val = $builder->getValues();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($val);
        $result = $stmt->fetchAll();

        $menus = [];
        foreach ($result as $item) {
            $menu = new Menu();
            $menu->date = $item['date'];
            $menu->id = $item['id'];
            $menus[$item['id']] = $menu;
            $menu->positions = [];
        }

        $query = $builder->select()
            ->setTable('position');
        $query->where()
            ->in('menu_id', array_keys($menus))
            ->end();

        $stmt = $this->conn->prepare($builder->writeFormatted($query));
        $stmt->execute($builder->getValues());
        $result = $stmt->fetchAll();

        foreach ($result as $value) {
            $position = new Position();
            foreach ($value as $key => $val) {
                $position->{$key} = $val;
            }

            $menus[$value['menu_id']]->positions =
                array_merge($menus[$value['menu_id']]->positions, [$position]);
        }


        return array_values($menus);
    }
}