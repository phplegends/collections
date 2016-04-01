<?php

namespace PHPLegends\Collections\Contracts;

interface Accessible
{
	public function set($key, $value);

	public function get($key);

	public function has($key);

	public function delete($key);

	public function keys();

	public function merge(array $items, $recursive = false);

	public function replace(array $items, $recursive = false);

	public function only(array $keys);

	public function except(array $keys);

	public function search($key);

	public function getOrDefault($key, $default = null);
}