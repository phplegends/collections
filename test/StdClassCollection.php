<?php

use PHPLegends\Collections\TypedCollection;

class StdClassCollection extends TypedCollection
{
	public function of($value)
	{
		return $value instanceof \stdClass;
	}
}