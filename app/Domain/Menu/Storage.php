<?php

namespace App\Domain\Menu;

use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

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
            $date = date('d.m.Y');
        }

        return $this->getMenu(['date' => $date]);
    }

    public function getMenu($filter = [])
    {
        $builder = new MySqlBuilder();

        $filter = [];
        $filter['date'] = '2029-09-20';

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
            $menu->setId($item['id']);
            $menu->setDate($item['date']);
            array_push($menus, $menu);
        }

        return $menus;
    }
}