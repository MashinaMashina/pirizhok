<?php

namespace App\Domain;

abstract class Model
{
    protected $properties = [];

    public function __get($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->properties);
    }

    public function __unset($name)
    {
        unset($this->properties[$name]);
    }

    public function getAll()
    {
        return $this->properties;
    }

    public function load($values)
    {
        $this->properties = $values;
    }
}