<?php

namespace App\Domain\Menu;

class Menu
{
    protected $positions = [];
    protected $date;

    public function getPositions()
    {
        return $this->positions;
    }

    public function setPositions(array $positions)
    {
        $this->positions = $positions;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}