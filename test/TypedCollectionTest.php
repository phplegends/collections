<?php

include_once 'StdClassCollection.php';

class TypedCollectionTest extends PHPUnit_Framework_TestCase
{
	public function testStdClassCollection()
	{
		$collection = new StdClassCollection;

		$collection->add(new \stdClass);

		//$collection->add(new ArrayObject);
	}
}