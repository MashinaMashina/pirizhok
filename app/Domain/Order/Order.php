<?php

namespace App\Domain\Order;

use App\Domain\Model;

class Order extends Model
{
    public function getSum()
    {
        if (empty($this->positions)) {
            return 0;
        }

        $sum = 0;
        foreach ($this->positions as $position) {
            $sum += $position->price * $position->count;
        }

        return $sum;
    }
}