<?php

namespace PHPLegends\Collections;

class MixedCollection extends Collection
{
    public function set($key, $value)
    {
        $this->registryPair($key, $value);
    }

    public function add($value)
    {
        $key = $this->getNextAppendKey();

        return $this->registryPair($key, $value);
    }

    protected function registryPair($key, $value)
    {
        return $this->add(new Pair($key, $value));
    }

    protected function getNextAppendKey()
    {
        end($this->items);

        return 1 + key($this->items);
    }
}