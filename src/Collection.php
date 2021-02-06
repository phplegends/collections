<?php

namespace PHPLegends\Collections;

use Countable;
use JsonSerializable;
use IteratorAggregate;
/**
 * Collection class
 * 
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
class Collection implements Countable, IteratorAggregate, JsonSerializable 
{

    /**
     * Items of collection
     *
     * @var array
     */
    protected $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Push item to collection
     *
     * @param mixed $item
     * @return void
     */
    public function add($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get all itens from collection
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Removes an item and retrieve value
     *
     * @param mixed $value
     * @return mixed
     */
    public function remove($value)
    {
        $key = $this->search($value);

        if ($key === false) return null;

        unset($this->items[$key]);

        return $key;
    }

    /**
     * Checks if collection contains a value
     *
     * @param mixed $value
     * @return void
     */
    public function contains($value): bool
    {
        return $this->search($value) !== false;
    }

    public function shift()
    {
        return array_shift($this->items);
    }

    public function unshift(...$item) 
    {
        array_unshift($this->items, ...$item);

        return $this;
    }

    /**
    * Retrieve a first item of collection. If callback passed, returns first element based on callback
    * 
    * @param callable|null $callback
    * @return mixed
    */
    public function first(callable $callback = null)
    {
        foreach ($this->all() as $key => $value) {

            if (null === $callback || $callback($value, $key, $this)) return $value;
        }
    }


    /**
     * Retrieve a last item of collection. If callback passed, returns last element based on callback
     * 
     * @param callable|null $callback
     * @return mixed
    */
    public function last(callable $callback = null)
    {
        foreach (array_reverse($this->values()) as $key => $value) {

            if (null === $callback || $callback($value, $key, $this)) {
                return $value;
            }
        }
    }


    public function filter(callable $callback)
    {
        $result = array_filter($this->all(), $callback, ARRAY_FILTER_USE_BOTH);

        return new static($result);
    }

    /**
     * Create new collection with current reversed items
     *
     * @param boolean $preserveKeys
     * @return void
     */
    public function reverse(bool $preserveKeys = true)
    {
        return new static(
            array_reverse($this->items, $preserveKeys)
        );
    }

    /**
     * @param array $key
     * @return self
    */
    public function only(array $keys)
    {   
        $items = [];

        foreach ($keys as $key) {
            $items[$key] = $this->get($key);
        }

        return new static($items);
    }

    /**
     * 
     * @param array $key
     * @return self
    */
    public function except(array $keys)
    {
        $items = $this->all();

        foreach ($keys as $key) {
            unset($items[$key]);
        }

        return new static($items);
    }

    /**
     * 
     * @return array
    */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
    
    public function sortBy(callable $callback, bool $ascending = true) 
    {
        $results = $this->map($callback)->all();

        $ascending ? 
        asort($results, SORT_REGULAR) : arsort($results, SORT_REGULAR);
        
        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }
        
        return new static($results);
    }

    /**
     * Sort elements in reverse order according to callback
     * 
     * @param callable $callback
     * @return self
    */
    public function sortByDesc(callable $callback)
    {
        return $this->sortBy($callback, false);
    }

    /**
     * Gets a new sorted collection
     *
     * @param callable $callback
     * @return self
     */
    public function sort(callable $callback = null): self
    {   
        $items = $this->all();

        $callback ? uasort($items, $callback) : asort($items, SORT_REGULAR);

        return new static($items);
    }

    public function chunk($size, $preserveKeys = true): self
    {
        $chunks = new static();

        foreach(array_chunk($this->all(), $size, $preserveKeys) as $chunk) {
            $chunks->add(new static($chunk));
        }

        return $chunks;
    }

    public function map(callable $callback = null): self
    {
        $items = array_map(
            $callback,
            $this->all(),
            $keys = $this->keys()
        );

        return new static(array_combine($keys, $items));
    }
   

    public function unique(): self
    {
        return new static(array_unique($this->all(), SORT_REGULAR));
    }

    /**
     * Countable implementation
     * 
     * @return int
    */
    public function count()
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return array_map(function ($value) {

            if ($value instanceof self) {
                return $value->toArray();
            } 

            return $value;

        }, $this->all());
    }       


    /**
     * Tests whether all elements in the collection pass the test implemented by the provided callable.
     *
     * @param callable $callback
     * @return boolean
     */
    public function every(callable $callback): bool
    {
        return ! in_array(
            false,
            array_map($callback, $this->all(), $this->keys()), 
            true
        );
    }
    
    public function some(callable $callback): bool
    {
        return in_array(
            true,
            array_map($callback, $this->all(), $this->keys()),
            true
        );
    }
        
    /**
     * Checks if collection is empty
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Removes and gets the last item from collection
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * Gets the keys from collection
     *
     * @return array
     */
    public function keys() : array
    {
        return array_keys($this->all());
    }

    /**
     * Search a item by key
     *
     * @param mixed $key
     * @return mixed
     */
    public function search($key)
    {
        return array_search($key, $this->all(), true);
    }

    /**
     * Group the collection using callback as criteria
     *
     * @param callable $callback
     * @param boolean $preserveKeys
     * @return self
     */
    public function groupBy(callable $callback, bool $preserveKeys = false): self
    {
        $groups = [];

        foreach ($this->all() as $key => $value) {

            $groupKey = $callback($value, $key);

            if (! isset($groups[$groupKey]))
            {
                $groups[$groupKey] = new static;
            }

            $groups[$groupKey][$preserveKeys ? $key : null] = $value;
        }

        return new static($groups);
    }

    /**
     * Get the array values from collection
     *
     * @return array
     */
    public function values(): array
    {
        return array_values($this->all());
    }

    public function offsetSet($key, $value)
    {
        if ($key === null) {

            return $this->add($value);
        }

        $this->set($key, $value);
    }

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
     * Get an item by key
     *
     * @param string|int $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->items[$key] ?? null;
    }

    /**
     * Get an item from collection and, if doesnt have, returns default value
     * 
     * @param int|string $key
     * @param mixed|null $default
     * @return mixed
     * */
    public function getOrDefault($key, $default = null)
    {
        return $this->get($key) ?? $default;
    }

    /**
     * Check if value exists
     *
     * @param string|int $key
     * @return boolean
     */
    public function has($key) : bool
    {
        return array_key_exists($key, $this->items);
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
     * 
     * @param int|string $key
     * @param mixed $value
     * @return $this
    */
    public function set($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    public function replace(array $items): self
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function merge(array $items, bool $recursive = false): self
    {
        $func = ($recursive) ? 'array_merge_recursive' : 'array_merge';

        $this->items = $func($this->all(), $items);

        return $this;
    }   


    /**
     * Sort the items by key
     * 
     * @param bool $ascending
     * @return self
    */
    public function sortByKeys(bool $ascending = true): self
    {
        $items = $this->all();

        $ascending ? ksort($items) : krsort($items);

        return new static($items);
    }
}