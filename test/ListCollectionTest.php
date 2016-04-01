<?php

use PHPLegends\Collections\ListCollection;

class ListCollectionTes extends PHPUnit_Framework_TestCase
{
	public function testAdd()
	{
		$list = new ListCollection();

		$list->add(1);

		$list->add(3);

		$list->add(5);

		$this->assertCount(3, $list);

		$this->assertEquals([1, 3, 5], $list->all());
	}


	public function testRemove()
	{
		$list = $this->createStringCollection();

		$this->assertTrue($list->contains('miguel'));

		$list->remove('miguel');

		$this->assertFalse($list->contains('miguel'));

	}

	public function testUnShift()
	{
		$list = $this->createStringCollection();

		$list->unshift('wayne');

		$this->assertEquals('wayne', $list->first());

		$this->assertEquals(
			['wayne', 'miguel', 'guilherme', 'wallace'],
			$list->all()
		);
	}

	public function testReject()
	{
		$list = $this->createStringCollection();

		$list->add('wayne');

		$list2 = $list->reject(function ($value)
		{
			return substr($value, 0, 1) === 'w';
		});

		$this->assertCount(2, $list2);

		$this->assertEquals(['miguel', 'guilherme'],  $list2->all());

	}	

	public function testChunkAndMerge()
	{
		$meninos = $this->createStringCollection();

		$meninas = ListCollection::create(['amanda', 'bruna', 'carla']);

		$meninos->addAll($meninas);

		$this->assertEquals(
			['miguel', 'guilherme', 'wallace', 'amanda', 'bruna', 'carla'],
			$meninos->all()
		);

		$pares = $meninos->chunk(2, false);

		$this->assertEquals(
			[
				['miguel', 'guilherme'],
				['wallace', 'amanda'],
				['bruna', 'carla']
			],
			$pares->toArray()	
		);
	}

	protected function createNumericCollection()
	{
		return new ListCollection([1, 3, 8, 9, 12, 5]);
	}

	protected function createStringCollection()
	{
		return new ListCollection(['miguel', 'guilherme', 'wallace']);
	}

	
	/**
	* Check if all elements return true in test of callback
	* @param callable $callback - The callback must return the boolean type
	* @return boolean
	*/
	public function every(callable $callback)
	{
	    return ! in_array(
	        false,
	        array_map($callback, $this->all(), $this->keys()), 
	        true
	    );
	}

	/**
	* Some value returns true.
	* @param callable $callback - The callback must return the boolean type
	* @return boolean
	*/
	public function some(callable $callback)
	{
	    return in_array(
	        true,
	        array_map($callback, $this->all(), $this->keys()),
	        true
	    );
	}
}