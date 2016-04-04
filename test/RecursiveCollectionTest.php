<?php

use PHPLegends\Collections\RecursiveCollection;

class RecursiveCollectionTest extends PHPUnit_Framework_TestCase
{
	public function initialize()
	{

		$data = [
			'name' => 'Wallace',
			'age' => '26',
			'languages' => [
				'php', 'python', 'javascript', 'sass', 
			],

			'frameworks' => [
				'symfony', 'cakephp', 'laravel'
			]
		];

		return new RecursiveCollection($data);
	}

	public function testIsRecursive()
	{
		$r = $this->initialize();

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

	public function testVarious()
	{

		$r = $this->initialize();
		
		$this->assertEquals(
			'sass',
			$r->get('languages')->last()
		);

		$this->assertEquals(
			'php',
			$r->get('languages')->first()
		);
	}
}