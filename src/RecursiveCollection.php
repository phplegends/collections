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
        foreach ($items as &$value)
        {
            is_array($value) && $value = new static($value);
        }

        parent::setItems($items);

        return $this;
    }

    /**
     * Detects if the index passed is a recursive in collection
     * @param int|string
     * */
    public function isRecursive($key)
    {
        return $this->get($key) instanceof self;
    }

    /**
     * Overwrites the parent method to make a recursive iterator
     * @return \RecursiveArrayIterator
     * */
    public function getIterator()
    {
        return new RecursiveArrayIterator(parent::getIterator());
    }
}