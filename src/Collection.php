<?php

namespace PHPLegends\Collections;

use PHPLegends\Collections\Contracts\ArrayableInterface;

class Collection implements \ArrayAccess, \Countable,
\IteratorAggregate, \JsonSerializable, ArrayableInterface
{	

	/**
	* @var array
	*/
	protected $items = [];

	public function __construct(array $items = [])
	{
		$this->replace($items);
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
		foreach($items as $item) $this->add($item);

		return $this;
	}

	public function reverse()
	{
		return new static(array_reverse($this->all()));
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
	* @return array
	*/
	public function map(callable $callback = null)
	{
		$items = array_map($callback, $this->all(), array_keys($this->items));

		return new static($items);
	}

	public function count()
	{
		return count($this->all());
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
		$this->set($key, $value);
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
		$this->remove($key);
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

	public function remove($key)
	{
		$value = $this->get($key);

		unset($this->items[$key]);

		return $value;
	}

	public function set($key, $value)
	{
		$this->items[$key] = $value;
	}

	public function replace(array $items)
	{
		$this->items = $items;

		return $this;
	}

	public function jsonSerialize()
	{
		return $this->toArray();
	}

}