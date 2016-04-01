<?php

namespace PHPLegends\Collections\Contracts;

interface Validatable
{
	public function some(callable $callback);

	public function every(callable $callback);

	public function isEmpty();
}