<?php

namespace App\Support;

class Access
{
    use \App\Utils\Traits\Singleton;

    protected $authorized = false;

    protected function __construct()
    {
        include ROOT_DIR . '/config/admin.php';

        $index = 'adminkey';

        $key = $_REQUEST[$index] ?? $_COOKIE[$index] ?? '-';

        if ($key === $accessKey) {
            $this->authorized = true;

            $cookie = $_COOKIE[$index] ?? '-';
            if ($cookie != $key) {
                setcookie($index, $key, time() + 31536000, '/');
            }
        }
    }

    public function isAuthorized()
    {
        return $this->authorized;
    }
}