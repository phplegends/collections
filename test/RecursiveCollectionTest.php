<?php

use PHPLegends\Collections\RecursiveCollection;

class RecursiveCollectionTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->arrayData = [
			'name' => 'Wallace',
			'age' => '26',
			'languages' => [
				'php', 'python', 'javascript', 'sass', 
			],

			'frameworks' => [
				'symfony', 'cakephp', 'laravel'
			]
		];

		$this->recursiveCollection = new RecursiveCollection($this->arrayData);
	}

	public function testIsRecursive()
	{
			
		$r = $this->recursiveCollection;

		$this->assertTrue(
			$r->isRecursive('frameworks')
		);

		$this->assertTrue(
			$r->isRecursive('languages')
		);

		$this->assertFalse(
			$r->isRecursive('name')
		);

		$this->assertInstanceOf(
			'\PHPLegends\Collections\RecursiveCollection',
			$r->get('languages')
		);
	}

	public function testRecursiveArrayIterator()
	{
		$this->assertEquals($this->arrayData, iterator_to_array($this->recursiveCollection));	
	}

	public function testSet()
	{
		$r = new RecursiveCollection();

		$r->set('key', 'value');

		$r->set('key.recursive', ['name' => 'wallace']);

		$this->assertTrue($r['key.recursive'] instanceof RecursiveCollection);

		$this->assertTrue($r->isRecursive('key.recursive'));

		$this->assertFalse($r->isRecursive('key'));
	}

	public function testAdd()
	{
		$r = new RecursiveCollection();

		$r->add('single');

		$r->add(['i', 'love', 'you']);

		$this->assertFalse($r->first() instanceof RecursiveCollection);

		$this->assertTrue($r->last() instanceof RecursiveCollection);
		
	}

}	