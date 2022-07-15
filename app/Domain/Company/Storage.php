<?php

namespace App\Domain\Company;

use App\Database\Database;
use NilPortugues\Sql\QueryBuilder\Builder\MySqlBuilder;

class Storage
{
    protected $conn;
    public $error = '';

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get()
    {
        $builder = new MySqlBuilder();

        $query = $builder->select()->setTable('companies');
        
        $sql = $builder->write($query);

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(Database::values($builder));

        $result = $stmt->fetchAll();

        $companies = [];
        foreach($result as $item) {
            $company = new Company();
            foreach($item as $key => $val) {
                $company->{$key} = $val;
            }
            $companies[$item['id']] = $company;
        }
        return array_values($companies);
    }

    public function getByCode ($code)
    {
        $builder = new MySqlBuilder();
        $query = $builder->select()
            ->setTable('companies');
        $query->where()
            ->equals('code', $code);

        $sql = $builder->write($query);

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(Database::values($builder));

        $result = $stmt->fetch();

        $company = new Company();
        if(empty($result)){
            return false;
        }
        foreach($result as $key => $val){
            $company->{$key} = $val;
        }
        return $company;
    }

    public function getById($id)
    {
        $builder = new MySqlBuilder();
        $query = $builder->select()
            ->setTable('companies');
        $query->where()
            ->equals('id', $id);

        $sql = $builder->write($query);

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(Database::values($builder));

        $result = $stmt->fetch();
        
        $company = new Company();
        if(empty($result)){
            return false;
        }
        foreach($result as $key => $val){
            $company->{$key} = $val;
        }
        return $company;
    }

    public function save($company)
    {
        $builder = new MySqlBuilder();

        if (empty($company->id)) {
            $query = $builder->insert();
        } else {
            $query = $builder->update();
            $query->where()->equals('id', $company->id);
        }

        $query = $query
            ->setTable('companies')
            ->setValues($company->getAll());
        
            $stmt = $this->conn->prepare($builder->write($query));
            if (!$stmt->execute(Database::values($builder))) {
                $this->error = $stmt->errorInfo();
                return false;
            }

            $companyId = $company->id;
            if (empty($companyId)) {
                $companyId = $this->conn->lastInsertId();
            }
            $company->id = $companyId;

            return true;
    }
}

