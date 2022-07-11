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
        $menus = $this->getMenu(['id' => $id]);

        return $menus[0] ?? false;
    }

    public function getMenuByDate($date = 'current')
    {
        if ($date === 'current') {
            $date = date('Y-m-d');
        }

        $menu = $this->getMenu(['date' => $date]);

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
            $menu->positions = [];

            $menus[$item['id']] = $menu;
        }

        if (! count($menus)) {
            return [];
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