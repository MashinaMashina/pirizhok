<?php

namespace App\Domain;

abstract class Model
{
    protected $properties = [];

    public function __get($name)
    {
        $method = $this->parseMethod($name, 'get');

        if (method_exists($this, $method))
            return $this->$method($name);

        return $this->properties[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $method = $this->parseMethod($name, 'set');

        if (method_exists($this, $method)) {
            $this->$method($name, $value);
        } else {
            $this->properties[$name] = $value;
        }
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

    protected function parseMethod($key, $prefix)
    {
        return $prefix . preg_replace('#[^a-zA-Z0-9]#', '', $key);
    }

}