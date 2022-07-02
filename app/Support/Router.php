<?php
namespace App\Support;

class Router {
    protected $routes = [];

    public function add($pattern, $callback)
    {
        $this->routes[$pattern] = $callback;
    }

    public function load($filename)
    {
        require $filename;

        $this->routes = $routes ?? [];
    }

    public function run()
    {
        uksort($this->routes, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        $pos = strpos($_SERVER['REQUEST_URI'], '?');
        $uri = ($pos ? substr($_SERVER['REQUEST_URI'], 0, $pos) : $_SERVER['REQUEST_URI']);
        $uri = trim($uri, '/');
        $uri = "/$uri/";

        foreach ($this->routes as $k => $callback) {
            if (strpos($uri, $k) === 0) {
                $callback();
                return;
            }
        }
    }
}