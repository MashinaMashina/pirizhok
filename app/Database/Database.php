<?php

namespace App\Database;

use \PDO;

class Database
{
    public static function new()
    {
        $host = 'localhost';
        $dbname = '';
        $username = '';
        $password = '';
        $charset = 'utf8';
        $collate = 'utf8_unicode_ci';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
        ];

        require ROOT_DIR . '/config/database.php';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $options);
    }

    public static function get() {
        static $db;

        if (! isset($db)) {
            $db = self::new();
        }

        return $db;
    }
}