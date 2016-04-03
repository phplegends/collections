<?php

use PHPLegends\Collections\ListCollection;

class ListCollectionTest extends PHPUnit_Framework_TestCase
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

	public function testValidates()
	{

		$pogs = $this->createStringCollection();

		$this->assertTrue(
			$pogs->every('is_string')
		);

		$this->assertTrue(
			$pogs->every(function ($value)
			{
				return strpos($value, 'e') !== false;
			})
		);

		$this->assertTrue(
			$pogs->some(function ($value) {
				return $value == 'wallace';
			})
		);

		$this->assertFalse($pogs->every('is_numeric'));

		$this->assertFalse($pogs->some('is_int'));
	}

	protected function createNumericCollection()
	{
		return new ListCollection([1, 3, 8, 9, 12, 5]);
	}

	protected function createStringCollection()
	{
		return new ListCollection(['miguel', 'guilherme', 'wallace']);
	}
}

