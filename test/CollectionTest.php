<?php

use PHPLegends\Collections\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{

	public function testAdd()
	{
		$c = new Collection([1]);

		$c->add(2);

		$this->assertEquals(
			[1, 2],
			$c->all()
		);

		
	}

	public function testAddAll()
	{
		$c1 = new Collection([1, 2, 3]);

		$c2 = new Collection([4, 5, 6]);

		$c1->addAll($c2);

		$this->assertCount(6, $c1);

		$this->assertEquals(
			[1, 2, 3, 4, 5, 6],
			$c1->all()
		);

	}

	public function testMerge()
	{

		$c = new Collection([1, 2]);

		$c->merge([3, 4]);

		$this->assertEquals([1, 2, 3, 4], $c->all());

	}

	public function testReverse()
	{
		$c = new Collection([1, 2, 3]);

		$this->assertEquals(
			[3, 2, 1],
			$c->reverse()->all()
		);
	}

	public function testLast()
	{
		$c = new Collection([1, 3, 5, 9]);

		$this->assertEquals(
			9,
			$c->last()
		);

		$this->assertEquals(
			9,
			$c->last(function ($value)
			{
				return $value % 2 != 0;
			})
		);

		$this->assertEquals(
			5,
			$c->last(function ($value)
			{
				return $value % 5 == 0;
			})
		);
	}

	public function testFirst()
	{
		$c = new Collection(['guilherme', 'eu' => 'wallace', 'zoom', 'bacco', 'gabe']);

		$this->assertEquals('guilherme', $c->first());

		$this->assertEquals(
			'wallace', 
			$c->first(function ($value) {

				return 'w' == substr($value, 0, 1);
			}
		));

		$this->assertEquals(
			'wallace',
			$c->first(function ($value, $key)
			{
				return $key === 'eu';
			})
		);

	}

	public function testFilter()
	{
		$c = new Collection(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i']);

		$voyels = $c->filter(function ($value) {

			return preg_match('/^(a|e|i|o|u)$/', $value) > 0;
		});

		$this->assertEquals(
			['a', 'e', 'i'],
			$voyels->values()
		);

	}

	public function testMap()
	{
		$c1 = new Collection([1, 2, 3]);

		$c2 = $c1->map(function ($value)
		{
			return 4 * $value;
		});	

		$this->assertEquals(
			[4, 8, 12],
			$c2->values()
		);
	}

	public function testCount()
	{
		$c = new Collection([1, 2, 3]);

		$c->merge([4, 5]);

		$this->assertCount(5, $c);

		$this->assertInstanceOf('Countable', $c);
	}

	public function testToArray()
	{
		$c = new Collection([]);

		$c['guilherme'] = new Collection([
			'nick' => '@GuilhermeNascimento',
			'languages' => new Collection([
				'php', 'javascript'
			])
		]);

		$this->assertEquals(
			[
				'guilherme' => [
					'nick' => '@GuilhermeNascimento',
					'languages' => ['php', 'javascript']
				]
			],
			$c->toArray()
		);
	}

	public function testSort()
	{
		$c = new Collection(['dez' => 10, 'cinco' => 5, 'quinze' => 15]);

		$c2  = $c->sort(function ($a, $b)
		{
			return $b - $a;
		});

		$c3 = $c->sort();

		$this->assertEquals(
			['quinze' => 15, 'dez' => 10, 'cinco' => 5],
			$c2->all()
		);

		$this->assertEquals(
			[5, 10, 15],
			$c3->values()
		);

	}

	public function testPop()
	{
		$c = new Collection([1, 2, 3, 4, 5, 6]);

		$value = $c->pop();

		$this->assertCount(5, $c);

		$this->assertEquals(6, $value);
	}

	public function testUnshift()
	{
		$c = new Collection(['a' => 2, 'b' => 3, 'd' => 4]);

		$c->unshift(1);

		$this->assertEquals(
			[1, 2, 3, 4],
			$c->values()
		);

		$this->assertEquals(
			[0 => 1, 'a' => 2, 'b' => 3, 'd' => 4],

			$c->all()
		);
	}

	public function testContains()
	{
		$object = new \stdClass;

		$c = new Collection([
			1, 2, 3, $object, [1, 2], false
		]);

		$this->assertTrue($c->contains(1));

		$this->assertTrue($c->contains(3));

		$this->assertFalse($c->contains(4));

		$this->assertTrue($c->contains(false));

		$this->assertTrue($c->contains([1, 2]));

		$this->assertTrue($c->contains($object));

		// Teste strict

		$this->assertFalse($c->contains(true));
	}


	public function testSearch()
	{
		$object = new \stdclass;

		$c = new Collection();

		$c->set('object', $object);

		$c['another'] = $object;

		$this->assertEquals(
			'object',
			$c->search($object)
		);

		$c['another'] = ':)';

		$this->assertEquals(
			'another',
			$c->search(':)')
		);

	}

	public function testIsEmpty()
	{
		$c = new Collection;

		$this->assertTrue($c->isEmpty());

		$c->add(NULL);

		$this->assertFalse($c->isEmpty());
	}


	public function testAll()
	{
		$c = new Collection();

		$c->add(1)->add(2)->add(3);

		$this->assertEquals(
			[1, 2, 3],
			$c->all()
		);
	}

	public function testValues()
	{
		$c = new Collection(['x' => 1, 'y' => 2, 'z' => 3]);
		$this->assertEquals(
			[1, 2, 3],
			$c->values()
		);
	}

	public function testArrayAccess()
	{
		$c = new Collection();

		$this->assertFalse(isset($c['non-exists']));

		$c['non-exists'] = null;

		$this->assertFalse(isset($c['non-exists']));

		$c['non-exists'] = 1;

		$this->assertTrue(isset($c['non-exists']));

		$this->assertEquals(1, $c['non-exists']);

		unset($c['non-exists']);

		$this->assertFalse(isset($c['non-exists']));

	}

	public function testGet()
	{
		$c = new Collection;

		$value = $c->get('non-exists', 'default_value');

		$this->assertEquals('default_value', $value);

		$c->set('nome', 'wallace');

		$this->assertEquals(
			'wallace',
			$c->get('nome')
		);

		$this->assertEquals(
			'wallace',
			$c['nome']
		);
	}

	public function testHas()
	{
		$c = new Collection;

		$c[1] = 1;

		$this->assertTrue($c->has(1));

		$this->assertFalse($c->has(2));
	}


	public function testIteratorAggregate()
	{

		$c = new Collection([1, 2, 3]);

		$this->assertInstanceOf('ArrayIterator', $c->getIterator());
	}


	public function testReplace()
	{
		$c = new Collection(['a', 'b', 'c']);

		$c->replace([]);

		$this->assertCount(0, $c);

		$this->assertEquals([], $c->all());
	}

	public function testJsonSerialize()
	{
		$c = new Collection([
			'nome' => 'wallace',
		]);

		$json = json_encode($c);

		$this->assertJson($json);

		$this->assertEquals('{"nome":"wallace"}', $json);
	}


	public function testIntersect()
	{
		$a = new Collection(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);

		$b = new Collection([2, 3]);

		$c = new Collection(['b' => 2, 'd' => 4]);

		$d = new Collection([2, 4]);

		$ab = $a->intersect($b);

		$ac = $a->intersect($c, true);

		$ad = $a->intersect($d);

		$this->assertEquals(
			['b' => 2, 'c' => 3],
			$ab->all()
		);

		$this->assertEquals(
			['b' => 2, 'd' => 4],
			$ac->all()
		);

		$this->assertEquals(
			['b' => 2, 'd' => 4],
			$ad->all()
		);

	}

	public function testReduce()
	{
		$c = new Collection(['a', 'b', 'c']);	

		$str1 = $c->reduce(function ($a, $b)
		{
			$a .= $b;

			return $a;
		});

		$str2 = Collection::create(['b', 'c', 'd'])->reduce(function ($a, $b)
		{
			return $a . $b;
			
		}, 'a');

		$this->assertEquals('abc', $str1);

		$this->assertEquals('abcd', $str2);
	}


}