<?php

namespace App\Views;

class HtmlFormatter
{
    public function buildTagProperty($props = [])
    {
        $res = '';
        foreach ($props as $key => $value) {
            $res .= ' '. $key . '="' . $this->escape($value) . '"';
        }
        return $res;
    }

    public function escape($value)
    {
        return htmlspecialchars($value);
    }
}