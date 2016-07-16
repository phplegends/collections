<?php

namespace PHPLegends\Collections;

use ArrayAccess;
use PHPLegends\Collections\Contracts\Arrayable;
use PHPLegends\Collections\Contracts\Accessible;
use PHPLegends\Collections\Contracts\Collectible;

/**
* The Collection class
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
**/

class Collection extends ListCollection implements ArrayAccess
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
    * @param string|int $key
    * @param mixed $value
    * @return mixed
    */
    public function offsetSet($key, $value)
    {
        if ($key === null) {

            return $this->add($value);
        }

        $this->set($key, $value);
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
    * @throws \UnexpectedValueException
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
     *
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


    /**
     * Get an item from collection and, if doesnt have, returns default value
     * @param int|string $key
     * @param mixed|null $default
     * @return mixed
     * */
    public function getOrDefault($key, $default = null)
    {
        return array_replace([$key => $default], $this->all())[$key];
    }

    /**
    * @param $ascending
    * @return Collective
    */
    public function sortByKeys($ascending = true)
    {
        $items = $this->all();

        $ascending ? ksort($items) : krsort($items);

        return new static($items);
    }


    /**
     * @{inheritdoc}
     * */
    public function groupBy(callable $callback, $preserveKeys = true)
    {
        return parent::groupBy($callback, $preserveKeys);
    }
}