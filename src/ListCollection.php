<?php

namespace PHPLegends\Collections;

use Countable;
use JsonSerializable;
use IteratorAggregate;
use PHPLegends\Collections\Contracts\Arrayable;
use PHPLegends\Collections\Contracts\Modifiable;
use PHPLegends\Collections\Contracts\Validatable;
use PHPLegends\Collections\Contracts\Collectible;

/**
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 *
 * Collection to work with list (array without named keys)
 * 
 * */
class ListCollection implements 
    Arrayable,
    Collectible,
    Countable,
    JsonSerializable,
    Modifiable,
    Validatable,
    IteratorAggregate
{
    /**
    * @var
    */
	protected $items = [];

    /**
    * @{inheritdoc}
    */
	public function __construct(array $items = [])
	{
		$items && $this->setItems($items);
	}

    /**
    * @{inheritdoc}
    */
	public function add($item)
	{
		$this->items[] = $item;

		return $this;
	}

    /**
    * @{inheritdoc}
    */
    public function all()
    {
        return $this->items;
    }

    /**
    * @{inheritdoc}
    */
    public function setItems(array $items)
    {
        array_map([$this, 'add'], $items);

        return $this;
    }

    /**
    * @{inheritdoc}
    */
    public function addAll(Collectible $collection)
    {
        array_map([$this, 'add'], $collection->all());

        return $this;
    }

    /**
    * @{inheritdoc}
    */
    public function removeAll(Collectible $collection)
    {
        array_map([$this, 'remove'], $collection->all());

        return $this;
    }

    /**
    * @{inheritdoc}
    */
    public function remove($value)
    {
        $key = array_search($value, $this->items, true);

        if ($key === false) return null;

        unset($this->items[$key]);

        return $key;
    }

    /**
    * @{inheritdoc}
    */
    public function contains($value)
    {
        return array_search($value, $this->items, true) !== false;
    }

    /**
    * Shift
    * @return mixed
    */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
    * Unshift
    * @param mixed $item
    * @return $this
    */
    public function unshift($item) 
    {

        array_unshift($this->items, $item);

        return $this;
    }

    /**
    * @param callable|null $callback
    * @return mixed
    */
    public function first(callable $callback = null)
    {
        if (null === $callback) {

            return reset($this->items);
        }

        foreach ($this->all() as $key => $value) {

            if ($callback($value, $key, $this)) return $value;
        }
    }

    /**
    * @param callable|null $callback
    * @return Collection
    */
    public function filter(callable $callback)
    {
        return static::create(
            array_filter($this->all(), $callback)
        );
    }

    /**
    * @param callable $callback
    */

    public function reject(callable $callback)
    {
        return $this->filter(function ($value) use($callback)
        {
            return ! $callback($value);
        });
    }

    /**
    * @return Collection
    */
    public function reverse($preserveKeys = true)
    {
        return static::create(
            array_reverse($this->items, $preserveKeys)
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
    * @return Collection
    */
     public function shuffle()
     {
        $items = $this->all();

        shuffle($items);

        return static::create($items);
    }

    /**
    * @return mixed
    */
    public function randomItem()
    {
        return $this->items[array_rand($this->all())];
    }

    public function only(array $keys)
    {
        $items = array_intersect_key($this->all(), array_flip($keys));

        return static::create($items);
    }

    public function except(array $keys)
    {
        $items = array_diff_key($this->all(), array_flip($keys));

        return static::create($items);
    }

    /**
    * @return array
    */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
    * @{inheritdoc}
    **/    
    public function intersect(Collectible $collection)
    {
        $items = array_intersect($this->all(), $collection->all());

        return static::create($items);
    }

    /**
    * @{inheritdoc}
    **/
    public function diff(Collectible $collection)
    {
        $items = array_diff($this->all(), $collection->all());

        return static::create($items);
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

    public static function create(array $items = [])
    {
    	return new static($items);
    }

    public function slice($offset, $length = null, $preserveKeys = true)
    {
        return new static(array_slice(
            $this->all(), $offset, $length, $preserveKeys
        ));
    }

    /**
    * @param callable|null $callback
    * @return Collection
    */
    public function sort(callable $callback = null)
    {   
        $items = $this->all();

        $callback ? uasort($items, $callback) : asort($items, SORT_REGULAR);

        return static::create($items);
    }

    public function chunk($size, $preserveKeys = true)
    {
        $chunks = static::create();

        foreach(array_chunk($this->all(), $size, $preserveKeys) as $chunk)
        {
            $chunks->add(static::create($chunk));
        }

        return $chunks;
    }

    /**
    * @param callable|null $callback
    * @return array
    */
    public function map(callable $callback = null)
    {
        $items = array_map(
            $callback,
            $this->all()
        );

        return static::create(array_combine($keys, $items));
    }
    
    /**
    * @{inheritdoc}
    */
    public function sortBy(callable $callback, $ascending = true) 
    {
        $results = $this->map($callback)->all();

        $ascending ? 
        asort($results, SORT_REGULAR) : arsort($results, SORT_REGULAR);
        
        foreach (array_keys($results) as $key) {

            $results[$key] = $this->items[$key];
        }
        
        return static::create($results);
    }

    public function sortByDesc(callable $callback)
    {
        return $this->sortBy($callback, false);
    }   

    /**
    * @{inheritdoc}
    */
    public function unique()
    {
        return static::create(array_unique($this->all(), SORT_REGULAR));
    }


    /**
    * Countable implementation
    * @return int
    */
    public function count()
    {
        return count($this->items);
    }

    public function toArray()
    {
        return array_map(function ($value) {

            if ($value instanceof Arrayable)
            {
                return $value->toArray();
            } 

            return $value;

        }, $this->all());
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
    
    /**
    * Is empty?
    * @return boolean
    */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
    * @return $this
    */
    public function clear()
    {
        $this->items = [];

        return $this;
    }

    /**
    * Removes last item from items
    * @return mixed
    */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
    * @return \ArrayIterator
    */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @return array
     * */
    public function keys()
    {
        return array_keys($this->all());
    }



}