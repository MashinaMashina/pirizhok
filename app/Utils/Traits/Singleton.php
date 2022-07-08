<?php

namespace App\Utils\Traits;

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) self::$instance = new static();

        return self::$instance;
    }

}