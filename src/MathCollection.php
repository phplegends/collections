<?php

namespace PHPLegends\Collections;

/**
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
*/
class MathCollection extends Collection
{
	/**
	* @param callable $callback
	* @return mixed
	*/
	public function sum(callable $callback = null)
	{
		if ($callback === null) {
			
			return array_sum($this->all());
		}

		return $this->reduce(function($result, $value) use($callback)
		{
			return $result + $callback($value);
			
		}, 0);
	}

	/**
	* @param callable $callback
	* @return mixed
	*/
	public function max(callable $callback = null)
	{
		if ($callback === null) {

			return max($this->all());
		}

		return max($this->map($callback)->all());
	}

	/**
	* @param callable $callback
	* @return mixed
	*/
	public function min(callable $callback = null)
	{
		if ($callback === null) {

			return min($this->all());
		}

		return min($this->map($callback)->all());
	}

	/**
	* @param callable $callback
	* @return mixed
	*/
	public function average(callable $callback = null)
	{
		return $this->sum($callback) / $this->count();
	}
}