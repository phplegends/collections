<?php

namespace PHPLegends\Collections;

use PHPLegends\Collections\Contracts\ArrayableInterface;

/**
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
**/
class Collection implements 
    ArrayableInterface,
    \ArrayAccess,
    \Countable,
    \IteratorAggregate,
    \JsonSerializable
{   

    /**
    * @var array
    */
    protected $items = [];

    public function __construct(array $items = [])
    {
       $items && $this->setItems($items);
    }

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
    * Easy way to create the object statically without conflict with inheritances
    * @uses func_get_args()
    */
    public static function create()
    {
        $reflect = new \ReflectionClass(get_called_class());

        return $reflect->newInstanceArgs(func_get_args());
    }

    /**
    * @param mixed $item
    */
    public function add($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
    * @param Collection $collection
    * @return $this
    */
    public function addAll(Collection $collection)
    {
        $this->merge($collection->all());

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
            $func($this->items, $items)
        );

        return $this;
    }

    /**
    * @return Collection
    */
    public function reverse()
    {
        return $this->getInstance()->setItems(
            array_reverse($this->items, true)
        );
    }

    /**
    * @param callable|null $callback
    * @return mixed
    */
    public function last(callable $callback = null)
    {
        if (null === $callback)
        {
            return end($this->items);
        }

        foreach ($this->reverse()->all() as $key => $value)
        {
            if ($callback($value, $key, $this)) return $value;
        }
    }

    /**
    * @param callable|null $callback
    * @return mixed
    */
    public function first(callable $callback = null)
    {
        if (null === $callback)
        {
            return reset($this->items);
        }

        foreach($this->all() as $key => $value)
        {
            if ($callback($value, $key, $this)) return $value;
        }
    }

    /**
    * @param callable|null $callback
    * @return Collection
    */
    public function filter(callable $callback)
    {
        return $this->getInstance()->setItems(
            array_filter($this->all(), $callback)
        );
    }

    /**
    * @param callable|null $callback
    * @return array
    */
    public function map(callable $callback = null)
    {
        $items = array_map(
            $callback,
            $this->all(),
            $keys = $this->keys()
        );

        return $this->getInstance()->setItems(
            array_combine($keys, $items)
        );
    }

    /**
    * @return int
    */
    public function count()
    {
        return count($this->items);
    }

    /**
    * @{inheritdoc}
    */
    public function toArray()
    {
        $callback = function ($value) {

            if ($value instanceof ArrayableInterface) {

                return $value->toArray();
            }

            return $value;

        };

        return array_map($callback, $this->all());
    }

    /**
    * @param callable|null $callback
    * @return Collection
    */
    public function sort(callable $callback = null)
    {   
        $items = $this->all();

        $callback ? uasort($items, $callback) : asort($items, SORT_REGULAR);

        return $this->getInstance()->setItems(
            $items
        );
    }

    /**
    * @param callable|null $callback
    * @param boolean $ascending
    * @return Collection
    */
    public function sortBy(callable $callback, $ascending = true)
    {
        $results = $this->map($callback)->all();

        $ascending ? 
            asort($results, SORT_REGULAR) : arsort($results, SORT_REGULAR);
       
        foreach (array_keys($results) as $key) {

            $results[$key] = $this->items[$key];
        }
        
        return $this->getInstance()->setItems($results);
    }

    public function sortByDesc(callable $callback)
    {
        return $this->sortBy($callback, false);
    }

    /**
    * Remove last item of collection
    * @return mixed
    */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
    * Add an item in first position of collection
    * @param mixed $item
    */
    public function unshift($item)
    {
        array_unshift($this->items, $item);

        return $this;
    }

    /**
    * @return mixed
    */

    public function shift()
    {
        return array_shift($this->items);
    }

    /**
    * @param mixed $value
    * @return boolean
    */
    public function contains($value)
    {
        return in_array($value, $this->all(), true);
    }

    /**
    * @param mixed $value
    * @return int|string
    */
    public function search($value)
    {
        return array_search($value, $this->items, true);
    }

    /**
    * Is empty?
    * @return boolean
    */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
    * @return array
    */
    public function all()
    {
        return $this->items;
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
        return $this->getInstance()->setItems($this->values());
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
        $this->removeKey($key);
    }

    /**
    * 
    * @return \ArrayIterator
    */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
    * @param string|int $key
    * @param null|mixed $default
    * @return mixed
    */
    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->items[$key] : $default;
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
    public function removeKey($key)
    {

        if (! $this->has($key)) return null;

        $value = $this->items[$key];

        unset($this->items[$key]);

        return $value;
    }

    /**
    * Unset item from collection via value and return index
    * @param mixed $value
    * @return int|string
    */
    public function remove($value)
    {
        $key = $this->search($value);

        if ($key === false) return null;

        $this->removeKey($key);

        return $key;
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
    * @return array
    */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
    * @param \PHPLegends\Collections\Collection $collection
    * @param boolean $associative 
    */
    public function intersect(self $collection, $associative = false)
    {
        $func = ($associative) ? 'array_intersect_assoc' : 'array_intersect';

        $items = $func($this->all(), $collection->all());

        return $this->getInstance()->setItems($items);
    }


    /**
    * @param \PHPLegends\Collections\Collection $collection
    * @param boolean $assoc 
    **/
    public function diff(self $collection, $assoc = false)
    {
        $func = ($assoc) ? 'array_diff_assoc' : 'array_diff';

        $items = $func($this->all(), $collection->all());

        return $this->getInstance()->setItems($items);
    }

    /**
    * @param callable $callback
    * @param mixed|null $initial
    * @return mixed
    */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->all(), $callback, $initial);
    }

    /**
    * @param int $size
    * @return Collection
    */
    public function chunk($size, $preserveKeys = true)
    {
        $chunks = $this->getInstance();

        foreach(array_chunk($this->all(), $size, $preserveKeys) as $chunk)
        {
            $chunks->add(
                $this->getInstance()->setItems($chunk)
            );
        }

        return $chunks;
    }

    /**
    * @return $this
    */
    public function clear()
    {
        return $this->setItems([]);
    }

    /**
    * Create a new empty collection (used in immutable returns)
    */
    protected function getInstance()
    {
        return new static();
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
            $func($this->items, $items)
        );

        return $this;
    }

    /**
    * @return Collection
    */
    public function shuffle()
    {
        $items = $this->all();

        shuffle($items);

        return $this->getInstance()->setItems($items);
    }

    public function random($amount)
    {
        $keys = (array) array_rand($this->all(), $amount);

        return $this->only($keys);
    }

    /**
    * @return mixed
    */
    public function randomItem()
    {
        $key = array_rand($this->all());

        return $this->get($key, null);
    }

    public function only(array $keys)
    {
        $items = array_intersect_key($this->all(), array_flip($keys));

        return $this->getInstance()->setItems($items);
    }

    public function except(array $keys)
    {
        $items = array_diff_key($this->all(), array_flip($keys));

        return $this->getInstance()->setItems($items);
    }

    /**
    * Check if all elements return true in test of callback
    * @param callable $callback - The callback must return the boolean type
    * @return boolean
    */
    public function every(callable $callback)
    {
        return ! in_array(
            false,
            array_map($callback, $this->all(), $this->keys()), 
            true
        );
    }

    /**
    * Some value returns true.
    * @param callable $callback - The callback must return the boolean type
    * @return boolean
    */
    public function some(callable $callback)
    {
        return in_array(
            true,
            array_map($callback, $this->all(), $this->keys()),
            true
        );
    }

}