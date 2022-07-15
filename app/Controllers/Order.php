<?php

namespace App\Controllers;

use App\Database\Database;
use App\Domain\Menu\Position;
use App\Domain\Order\Storage;
use App\Views\View;

class Order
{
    public static function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(400);
            die('invalid request method');
        }

        
        $positionsPost = json_decode($_POST['positions'] ?? "[]", true);

        $positions = [];

        foreach($positionsPost as $pos){
            $position = new Position();
            $position->name = $pos['name'];
            $position->price = $pos['price'];
            $position->weight = $pos['measure'];
            $position->group_name = $pos['group_name'];
            $position->count = $pos['count'];
            $positions[] = $position;
        }

        $order = new \App\Domain\Order\Order();
        
        $order->load([
            'user_name' => $_POST['username'],
            'positions' => $positions,
            'company_id' => $_POST['companyId'],
            'menu_id' => $_POST['menu_id']
        ]);

        $storage = new Storage(Database::get());
        $res = $storage->save($order);

        if (!$res) {
            echo json_encode(['success' => false, 'message' => $storage->error]);
        } else {
            echo json_encode(['success' => true]);
        }
    }

    public static function view()
    {
        $storage = new Storage(Database::get());

        $code = $_GET['company'] ?? '-';

        $company = (new \App\Domain\Company\Storage(Database::get()))->getByCode($code);
        $info = (new \App\Domain\Info\Storage)->getInfo();

        if (empty($company)) {
            http_response_code(400);
            echo 'Компания не найдена';
            return;
        }

        $company->orders = $storage->getByCompanyId($company->id);

        (new View())->render('orders', [
            'company' => $company,
            'info' => $info,
            'csrf' => \App\Support\Security::csrf(),
        ]);
    }
}