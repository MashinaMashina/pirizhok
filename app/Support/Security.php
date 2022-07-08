<?php

namespace App\Support;

class Security
{
    public static function requestWarning()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            $csrf = $_POST['csrf'] ?? '';

            if ($csrf !== self::csrf()) {
                return 'invalid csrf';
            }
        }

        return false;
    }

    public static function csrf()
    {
        return md5($_SERVER['REMOTE_ADDR'] . '--==');
    }
}