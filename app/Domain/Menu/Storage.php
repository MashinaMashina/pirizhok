<?php

namespace App\Domain\Menu;

use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;
use NilPortugues\Sql\QueryBuilder\Syntax\OrderBy;

class Storage
{
    protected $conn;
    public $error = '';

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
            foreach ($item as $key => $val) {
                $menu->{$key} = $val;
            }
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

    public function save($menu)
    {
        if (empty($menu->positions)) {
            $this->error = 'не возможно создать меню без товарных позиций';
            return false;
        }

        $this->conn->beginTransaction();
        if (!$this->saveMenu($menu)) {
            $this->conn->rollback();
            return false;
        }
        if (!$this->savePositions($menu->positions ?? [], $menu->id)) {
            $this->conn->rollback();
            return false;
        }
        $this->conn->commit();

        return true;
    }

    protected function saveMenu($menu)
    {
        $values = [
            'date' => $menu->date ?? '',
            'updated_at' => time(),
        ];

        $builder = new MySqlBuilder();

        if (empty($menu->id)) {
            $values['created_at'] = $values['updated_at'];
            $query = $builder->insert();
        } else {
            $query = $builder->update();
        }

        $query = $query
            ->setTable('menu')
            ->setValues($values);

        $stmt = $this->conn->prepare($builder->write($query));
        if (!$stmt->execute($builder->getValues())) {
            $this->error = $stmt->errorInfo();
            return false;
        }

        $menuId = $menu->id;
        if (empty($menuId)) {
            $menuId = $this->conn->lastInsertId();
        }

        $menu->id = $menuId;
        return $menuId > 0;
    }

    protected function savePositions($positions, $menuId)
    {
        $builder = new MySqlBuilder();
        $query = $builder->delete()
            ->setTable('position');
        $query->where()
            ->equals('menu_id', $menuId);

        $stmt = $this->conn->prepare($builder->write($query));

        if (!$stmt->execute($builder->getValues())) {
            $this->error = $stmt->errorInfo();
            return false;
        }

        if (!count($positions)) {
            return true;
        }

        $query = $builder->insert()
            ->setTable('position');

        foreach ($positions as $position) {
            $values = ['menu_id' => $menuId] + $position->getAll();

            $query->setValues($values);
            $stmt = $this->conn->prepare($builder->write($query));

            if (!$stmt->execute($builder->getValues())) {
                $this->error = $stmt->errorInfo();
                return false;
            }
        }

        return true;
    }
}