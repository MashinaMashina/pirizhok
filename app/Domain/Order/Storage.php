<?php

namespace App\Domain\Order;

use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

class Storage
{
    protected $conn;
    public $error = '';

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function save($order)
    {
        if (empty($order->positions)) {
            $this->error = 'не возможно создать заказ без товарных позиций';
            return false;
        }

        $values = [
            'company_id' => $order->company_id ?? 0,
            'user_name' => $order->user_name ?? '',
            'positions' => json_encode($order->positions),
            'comment' => $order->comment ?? '',
            'ip' => $order->ip ?? $_SERVER['REMOTE_ADDR'],
            'updated_at' => time(),
        ];

        $builder = new MySqlBuilder();

        if (empty($order->id)) {
            $values['created_at'] = $values['updated_at'];
            $query = $builder->insert();
        } else {
            $query = $builder->update();
        }

        $query = $query
            ->setTable('orders')
            ->setValues($values);

        $stmt = $this->conn->prepare($builder->write($query));
        if (!$stmt->execute($builder->getValues())) {
            $this->error = $stmt->errorInfo();
            return false;
        }

        return true;
    }
}