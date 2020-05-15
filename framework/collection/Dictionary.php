<?php

namespace Framework;

use Countable;
use IteratorAggregate;

class Dictionary implements Countable, IteratorAggregate
{
    private $parameters;

    public function __construct($parameters) {
        $this->parameters = $parameters;
    }

    public function add($parameters) {
        $this->parameters = array_replace($this->parameters, $parameters);
    }

    public function get($key) {
        return $this->tryGet($key, null);
    }

    public function tryGet($key, $default) {
        if($this->has($key)) {
            return $this->parameters[$key];
        }

        return $default;
    }

    public function set($key, $value) {
        $this->parameters[$key] = $value;
    }

    public function remove($key) {
        unset($this->parameters[$key]);
    }

    public function has($key) {
        return array_key_exists($key, $this->parameters);
    }

    public function count() {
        return count($this->parameters);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }
}


