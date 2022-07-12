<?php

namespace App\Controllers\Admin;

use App\Database\Database;
use App\Domain\Company\Company;
use App\Domain\Menu\Position;
use App\Domain\Order\Storage;
use App\Views\View;

class Order
{
    public static function home()
    {
        $storage = new Storage(Database::get());

        $orders = $storage->getActive();

        (new View())->render('admin/order/list', [
            'orders' => $orders,
        ]);
    }

    public static function edit($params)
    {
        if (empty($params[1])) {
            die('invalid menu id');
        }

        $message = '';

        $storage = new Storage(Database::get());
        $menuStorage = new \App\Domain\Menu\Storage(Database::get());

        if (count($_POST)) {
            $success = true;
            foreach ($_POST['orders'] as $companyId => $orders) {
                foreach ($orders as $orderId => $order) {
                    $positions = [];
                    foreach ($order as $position) {
                        $pos = new Position();
                        $pos->load([
                            'name' => $position['name'] ?? '',
                            'weight' => $position['weight'] ?? '',
                            'price' => $position['price'] ?? 0,
                            'count' => $position['count'] ?? 0,
                        ]);

                        $positions[] = $pos;
                    }

                    $order = new \App\Domain\Order\Order();
                    $order->positions = $positions;
                    $order->id = $orderId;
                    $order->company_id = $companyId;
                    $order->confirm = time();

                    if (!$storage->save($order)) {
                        $message = $storage->error;
                        $success = false;
                        break;
                    }
                }
            }

            if ($success) {
                $message = 'Успешно сохранено';
            }
        }

        $menu = $menuStorage->getMenuInfo($params[1]);
        $orders = $storage->getByMenuId($params[1]);

        $groups = [];
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $id = intval($order->company_id);

                $company = $groups[$id] ?? new Company();
                $company->name = $order->company_name;
                $company->id = $id;
                $company->orders = array_merge_recursive($company->orders ?? [], [$order]);

                $groups[$id] = $company;
            }
        }

        (new View())->render('admin/order/edit', [
            'orders' => $orders,
            'menu' => $menu,
            'csrf' => \App\Support\Security::csrf(),
            'message' => $message,
            'groups' => $groups,
        ]);
    }
}