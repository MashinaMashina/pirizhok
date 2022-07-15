<?php

namespace App\Domain\Info;

use App\Domain\Model;

class Info extends Model
{
    public function getDescriptionHtml()
    {
        $description = htmlentities($this->description);

        return str_replace("\n", '<br>', $description);
    }
}