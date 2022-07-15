<?php

namespace App\Domain\Order;

use App\Database\Database;
use App\Domain\Menu\Position;
use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

class Storage
{
    protected $conn;
    public $error = '';

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getActive()
    {
        $sql = 'SELECT
            orders.id,
            orders.menu_id,
            m.date,
            min(confirm) as confirm,
            max(orders.updated_at) as updated_at
        FROM orders
        LEFT JOIN menu m on orders.menu_id = m.id 
        GROUP BY `menu_id`
        ORDER BY m.date DESC';

        return $this->orderByStmt($this->conn->query($sql));
    }

    public function getByCompanyId($id)
    {
        $builder = new MySqlBuilder();

        $today = date('Y-m-d');

        $sql = $builder->select()->setTable('orders');
        $sql->where()->equals('company_id', $id);
        $sql->join('menu', 'menu_id', 'id')
            ->where()
            ->greaterThanOrEqual('date', $today);

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(Database::values($builder));

        return $this->orderByStmt($stmt);
    }

    public function getByMenuId($menuId)
    {
        $builder = new MySqlBuilder();

        $query = $builder->select()
            ->setTable('orders');
        $query->where()
            ->equals('menu_id', $menuId);

        $query->leftJoin('companies', 'company_id', 'id', ['company_name' => 'name']);
        $query->orderBy('company_id');

        $sql = $builder->write($query);

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(Database::values($builder));

        return $this->orderByStmt($stmt);
    }

    public function save($order)
    {
        if (empty($order->positions)) {
            $this->error = 'не возможно создать заказ без товарных позиций';
            return false;
        }

        $values = $order->getAll();
        $values['updated_at'] = time();

        if (isset($order->positions)) {
            $positions = [];
            foreach ($order->positions as $position) {
                $positions[] = $position->getAll();
            }

            $values['positions'] = json_encode($positions);
        }

        $builder = new MySqlBuilder();

        if (empty($order->id)) {
            $values['created_at'] = $values['updated_at'];
            $query = $builder->insert();
        } else {
            $query = $builder->update();
            $query->where()->equals('id', $order->id);
        }

        $query = $query
            ->setTable('orders')
            ->setValues($values);

        $stmt = $this->conn->prepare($builder->write($query));
        if (!$stmt->execute(Database::values($builder))) {
            $this->error = $stmt->errorInfo();
            return false;
        }

        return true;
    }

    protected function orderByStmt($stmt)
    {
        $result = [];
        while ($row = $stmt->fetch()) {
            $order = new Order();

            if (!empty($row['positions'])) {
                $positions = json_decode($row['positions'], true);

                $row['positions'] = [];
                foreach ($positions as $position) {
                    $pos = new Position();
                    foreach ($position as $k => $v) {
                        $pos->{$k} = $v;
                    }
                    $row['positions'][] = $pos;
                }
            }

            foreach ($row as $k => $v) {
                $order->{$k} = $v;
            }

            $result[] = $order;
        }

        return $result;
    }
}