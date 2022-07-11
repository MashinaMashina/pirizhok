<?php

namespace App\Controllers;

use App\Database\Database;
use App\Domain\Menu\Position;
use App\Domain\Order\Storage;

class Order
{
    public static function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            die('invalid request method');
        }

        $position = new Position();
        $position->name = 'Картофельное пюре';
        $position->price = 75;
        $position->weight = '150 гр.';
        $position->group_name = 'Второе';
        $position->menu_id = 1;

        $order = new \App\Domain\Order\Order();
        $order->load([
            'user_name' => 'Вован',
            'positions' => [$position->getAll()],
            'comment' => 'пюрешку без соли!',
        ]);

        $storage = new Storage(Database::get());
        $res = $storage->save($order);

        if (!$res) {
            echo json_encode(['success' => false, 'message' => $storage->error]);
        } elseif (rand(0, 1) == 1) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Не удалось сохранить заказ']);
        }
    }

    public static function view()
    {

    }
}