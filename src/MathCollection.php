<?php

namespace PHPLegends\Collections\Collection;

/**
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
* 
*/
class MathCollection extends Collection
{
	/**
	* @param callable $callback
	*/
	public function sum(callable $callback = null)
	{
		if ($callback === null) {
			
			return array_sum($this->all());
		}

		return $this->reduce($callback, 0);
	}

	/**
	* @param callable $callback
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
	*/
	public function average(callable $callback = null)
	{
		return $this->sum($callback) / $this->count();
	}
}