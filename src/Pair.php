<?php

namespace PHPLegends\Collections;

class Pair implements ArrayableInterface
{
    protected $key;

    protected $value;

    public function __construct($key, $value)
    {
        $this->key = $key;

        $this->value = $value;
    }

    public function key()
    {
        return $this->key;
    }

    public function value()
    {
        return $this->value;
    }

    public function toArray()
    {
        return [
            0       => $this->key(),
            1       => $this->value(),
            'key'   => $this->key(),
            'value' => $this->value()
        ];
    }
}