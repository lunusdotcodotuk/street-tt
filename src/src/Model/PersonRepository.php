<?php

namespace StreetTT\Model;

use ArrayAccess;
use InvalidArgumentException;
use Iterator;

class PersonRepository implements ArrayAccess, Iterator
{
    private array $persons;

    public function __construct()
    {
        $this->persons = [];
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->persons);
    }

    public function offsetGet($offset): Person
    {
        return $this->persons[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (is_a($value, Person::class)) {
            $this->persons[$offset] = $value;
        } else {
            throw new InvalidArgumentException('The argument supplied was not a valid Person type');
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->persons[$offset]);
    }

    public function current()
    {
        return current($this->persons);
    }

    public function next()
    {
        return next($this->persons);
    }

    public function key()
    {
        return key($this->persons);
    }

    public function valid()
    {
        $key = key($this->persons);
        return ($key !== NULL && $key !== FALSE);
    }

    public function rewind()
    {
        reset($this->persons);
    }
}
