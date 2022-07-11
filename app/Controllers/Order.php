<?php

namespace App\Controllers;

class Order
{
    public static function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            die('invalid request method');
        }

        if (rand(0, 1) == 1) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Не удалось сохранить заказ']);
        }
    }

    public static function view()
    {

    }
}