<?php

namespace App\Domain\Menu;

class Storage
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getMenuById($id)
    {
        return $this->getMenu(['id' => $id]);
    }

    public function getMenuByDate($date = 'current')
    {
        if ($date === 'current') {
            $date = date('d.m.Y');
        }

        return $this->getMenu(['date' => $date]);
    }

    public function getMenu($filter = [])
    {
        return 1;
    }
}