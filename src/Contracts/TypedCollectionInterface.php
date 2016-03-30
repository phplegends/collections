<?php

namespace PHPLegends\Collections\Contracts;

use PHPLegends\Collections\Exceptions\TypedCollectionException;

interface TypedCollectionInterface
{	
	/**
	* @param mixed $value
	* @return boolean
	*/
	public function of($value);

	/**
	* @throws \PHPLegends\Collections\Exceptions\TypedCollectionException
	*/
	public function raiseException($value);

}

