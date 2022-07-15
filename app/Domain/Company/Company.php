<?php

namespace App\Domain\Company;

use App\Domain\Model;

class Company extends Model
{
     public function getOrdersSum()
     {
         if (empty($this->orders)) {
             return 0;
         }

         $sum = 0;
         foreach ($this->orders as $order) {
             $sum += $order->sum;
         }

         return $sum;
     }
}