<?php

namespace PHPLegends\Collections\Contracts;

interface TypedCollectionInterface
{	
	/**
	* @param mixed $value
	*/
	public function of($value);

	/**
	* @throws CollectionException
	*/
	public function raiseException($value);

}

