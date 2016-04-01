<?php

namespace PHPLegends\Collections\Contracts;

interface Collectible
{

	/**
	* @param mixed $item
	*/

	public function __construct(array $items = []);

	public function add($item);

	public function addAll(Collectible $collection);

	public function contains($item);

	public function removeAll(Collectible $collection);

	public function remove($item);

	public function all();

}
