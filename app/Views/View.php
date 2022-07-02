<?php

namespace App\Views;

class View
{
    public $formatter;

    public function __construct()
    {
        $this->formatter = new HtmlFormatter;
    }

    public function render($filename, $args = [])
    {
        extract($args);
        require ROOT_DIR . "/views/$filename.php";
    }

    public function header($args = [], $file = 'header')
    {
        $defaults = [
            'title' => 'Сайт с меню',
            'styles' => [],
        ];
        $this->render('header', $args + $defaults);
    }

    public function footer($args = [], $file = 'footer')
    {
        $defaults = [
            'scripts' => [],
        ];
        $this->render('footer', $args + $defaults);
    }
}