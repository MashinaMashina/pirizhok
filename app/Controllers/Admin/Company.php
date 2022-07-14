<?php

namespace App\Controllers\Admin;

use App\Domain\Company\Storage;
use App\Views\View;
use App\Database\Database;
use App\Support\Access;

class Company
{
    public static function home()
    {
    if (! Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        $storage = new Storage(Database::get());
        
        $companies = $storage->get();

        (new View())->render('admin/company/list', [
            'csrf' => \App\Support\Security::csrf(),
            'companies' => $companies,
        ]);
    }

    public static function edit($params)
    {
        if (! \App\Support\Access::getInstance()->isAuthorized()) {
            echo 'not authorized';
            return;
        }

        $message = '';
        $storage = new Storage(Database::get());

        $company = false;
        if(!empty($params[1])){
            $id = (int) $params[1];
            $company = $storage->getById($id);

            if(!$company) {
                echo 'company not found';
                return;
            }
        } else {
            $company = new \App\Domain\Company\Company();
        }

        

        if (count($_POST)) {
            $company->name = $_POST['company'] ?? '';
            if (empty($_POST['company'])){
                $message = 'Нельзя сохранить пустую компанию';
            } else {
                $code = md5($_POST['company']);
                $findCompany = $storage->getByCode($code);

                if ($findCompany and $findCompany->id !== $company->id) {
                    $message = 'Такая компания уже существует';
                } else {
                    $message = "Сохранено успешно";
                    
                    $company->code = $code;
                    $storage->save($company);
                }
            }
        }
        
        (new View())->render('admin/company/edit', [
            'message' => $message,
            'company' => $company,
            'csrf' => \App\Support\Security::csrf(),
        ]);
    }
}