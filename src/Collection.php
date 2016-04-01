<?php

namespace PHPLegends\Collections;

use ArrayAccess;
use PHPLegends\Collections\Contracts\Collectible;
use PHPLegends\Collections\Contracts\Accessible;
use PHPLegends\Collections\Contracts\Arrayable;


/**
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
**/

class Collection extends ListCollection implements ArrayAccess, Accessible
{
    /**
    * @param array $items
    * @return $this
    */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
    * @param Collection $collection
    * @return $this
    */
    public function addAll(Collectible $collection)
    {
        $this->merge($collection->all());

        return $this;
    }

    /**
    * Returns all values in an array with "reseted" keys
    * @return array
    */
    public function values()
    {
        return array_values($this->all());
    }

    /**
    * Force the all values of collection as list
    * @return Collection
    */
    public function toList()
    {
        return static::create($this->values());
    }

    /**
    * @param string|int $key
    * @param mixed $value
    * @return mixed
    */
    public function offsetSet($key, $value)
    {
        if ($key === null) {

            return $this->add($value);

        } else {

            $this->set($key, $value);
        }
    }

    /**
    * @param string|int $key
    * @return mixed
    */

    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
    * @param string|int $key
    * @return boolean
    */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
    * @param string|int $key
    * @return void
    */
    public function offsetUnset($key)
    {
        $this->delete($key);
    }

    /**
    * @param string|int $key
    * @param null|mixed $default
    * @return mixed
    */
    public function get($key)
    {
        if (! $this->has($key))
        {
            throw new \UnexpectedValueException("The index '{$key}' doesn't exists");
        }

        return $this->items[$key];
    }

    /**
    * @return boolean
    */
    public function has($key)
    {
        return isset($this->items[$key]);
    }

    /**
    * Unset item from collection via index and return value
    * @param int|string $key
    * @return mixed
    */
    public function delete($key)
    {
        if (! $this->has($key)) return null;

        $value = $this->items[$key];

        unset($this->items[$key]);

        return $value;
    }

    /**
    * Retrieves all keys of collection 
    * @return array
    */
    public function keys()
    {
        return array_keys($this->items);
    }

    /**
    * @param int|string $key
    * @param mixed $value
    * @return $this
    */
    public function set($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
    * @param array $items
    * @param boolean $recursive
    * @return $this
    */
    public function replace(array $items, $recursive = false)
    {

        $func = ($recursive) ? 'array_replace_recursive': 'array_replace';

        $this->setItems(
            $func($this->all(), $items)
        );

        return $this;
    }

    /**
    * @param array $items
    * @param boolean $recursive
    * @return $this
    */
    public function merge(array $items, $recursive = false)
    {

        $func = ($recursive) ? 'array_merge_recursive' : 'array_merge';

        $this->setItems(
            $func($this->all(), $items)
        );

        return $this;
    }   

    public function search($key)
    {
        return array_search($key, $this->all(), true);
    }

    public function getOrDefault($key, $default = null)
    {
        return array_replace($this->all(), [$key => $default])[$key];
    }
}