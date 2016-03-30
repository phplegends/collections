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
		$this->replace($items);
	}

	public static function create(array $items = [])
	{
		return new static($items);
	}

	/**
	* @param mixed $item
	*/
	public function add($item)
	{
		$this->items[] = $item;

		return $this;
	}

	public function addAll(Collection $collection)
	{
		$this->merge($collection->all());

		return $this;
	}

	public function merge(array $items)
	{
		$this->items = array_merge($this->items, $items);

		return $this;
	}

	public function reverse()
	{
		return new static(array_reverse($this->items, true));
	}

	public function last(callable $callback = null)
	{
		if (null === $callback)
		{
			return end($this->items);
		}

		foreach (array_reverse($this->all()) as $key => $value)
		{
			if ($callback($value, $key, $this)) return $value;
		}
	}

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

	public function filter(callable $callback)
	{
		return new static(array_filter($this->all(), $callback));
	}

	/**
	* @param callable|null $callback
	* @return array
	*/
	public function map(callable $callback = null)
	{
		$items = array_map($callback, $this->items, $keys = $this->keys());

		return new static(array_combine($keys, $items));
	}

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

	public function sort(callable $callback = null)
	{	
		$items = $this->all();

		$callback ? uasort($items, $callback) : asort($items, SORT_REGULAR);

		return new static($items);
	}

	public function sortBy(callable $callback, $ascending = true)
	{
		$results = $this->map($callback)->all();

       	$ascending ? asort($results, SORT_REGULAR) : arsort($results, SORT_REGULAR);
       
		foreach (array_keys($results) as $key) {

			$results[$key] = $this->items[$key];
		}
       	
       	return new static($results);
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

	public function contains($value)
	{
		return in_array($value, $this->all(), true);
	}

	public function search($value)
	{
		return array_search($value, $this->items, true);
	}

	public function isEmpty()
	{
		return empty($this->items);
	}

	public function all()
	{
		return $this->items;
	}

	public function values()
	{
		return array_values($this->all());
	}

	public function offsetSet($key, $value)
	{
		if ($key === null) {

			return $this->add($value);

		} else {

			$this->set($key, $value);
		}
	}

	public function offsetGet($key)
	{
		return $this->get($key);
	}

	public function offsetExists($key)
	{
		return $this->has($key);
	}

	public function offsetUnset($key)
	{
		$this->removeKey($key);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->all());
	}

	public function get($key, $default = null)
	{
		return $this->has($key) ? $this->items[$key] : $default;
	}

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
		$value = $this->get($key);

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
	* @param array $items
	* @return $this
	*/
	public function replace(array $items)
	{
		$this->items = $items;

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

 		return new static($func($this->all(), $collection->all()));
    }


    /**
    * @param \PHPLegends\Collections\Collection $collection
	* @param boolean $associative 
    **/
    public function diff(self $collection, $associative = false)
    {
    	$func = ($associative) ? 'array_diff_assoc' : 'array_diff';

 		return new static($func($this->all(), $collection->all()));
    }

    /**
    * @param callable $callback
    * @param mixed|null $initial
    * @return mixed
    */
    public function reduce(callable $callback, $initial = null)
    {
    	return array_reduce($this->items, $callback, $initial);
    }


}