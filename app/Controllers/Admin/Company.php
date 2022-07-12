<?php

namespace App\Controllers\Admin;

use App\Domain\Info\Storage;
use App\Views\View;

class Company
{
    public static function home()
    {
        if (! \App\Support\Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        $storage = new Storage();
        $message = '';

        if (count($_POST)) {
            $info = new \App\Domain\Info\Info();
            $info->title = $_POST['title'] ?? '';
            $info->description = $_POST['description'] ?? '';

            if ($storage->saveInfo($info)) {
                $message = 'Сохранено';
            } else {
                $message = 'Ошибка сохранения';
            }
        } else {
            $info = $storage->getInfo();
        }

        (new View())->render('admin/company', [
            'csrf' => \App\Support\Security::csrf(),
            'info' => $info,
            'message' => $message,
        ]);
    }
}