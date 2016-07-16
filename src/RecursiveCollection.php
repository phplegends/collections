<?php

namespace PHPLegends\Collections;

use RecursiveArrayIterator;

/**
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * 
 * */
class RecursiveCollection extends Collection
{

    /**
     * @{inheritdoc}
     * */
    public function setItems(array $items)
    {   
        foreach ($items as &$value) {

            $value = $this->resolveRecursiveValues($value);
        }

        parent::setItems($items);

        return $this;
    }

    /**
     * Sets a item in RecursiveCollection. If array passed, is converted into RecursiveCollection
     * 
     * @param string|int
     * @param array|mixed 
     * */
    public function set($key, $value)
    {
        return parent::set($key, $this->resolveRecursiveValues($value));
    }

    /**
     * 
     * @{inheritdoc}
     * */
    public function add($value)
    {
        return parent::add($this->resolveRecursiveValues($value));
    }

    /**
     * Detects if the index passed is a recursive in collection
     * 
     * @param int|string
     * */
    public function isRecursive($key)
    {
        return $this->get($key) instanceof self;
    }

    /**
     * Overwrites the parent method to make a recursive iterator
     * 
     * @return \RecursiveArrayIterator
     * */
    public function getIterator()
    {
        return new RecursiveArrayIterator($this->toArray());
    }

    /**
     * Resolve recursive values
     * 
     * @param mixed $value
     * @return RecursiveCollection | mixeds
     * */
    protected function resolveRecursiveValues($value)
    {
        return is_array($value) ? new static($value) : $value;
    }
}