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
			$c->reverse()->values()
		);

		$d = $c->create(['b' => 'B', 'a' => 'A', 'c' => 'C']);

		$this->assertEquals(
			['c' => 'C', 'a' => 'A', 'b' => 'B'],
			$d->reverse()->all()
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

		$value = $c->getOrDefault('non-exists', 'default_value');

		$this->assertEquals('default_value', $value);

		$c->set('nome', 'wallace');

		$this->assertEquals(
			'wallace',
			$c->getOrDefault('nome', 'another')
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
		$c = new Collection(['a' => 'a', 'b' => 'b', 'c' => 'c']);

		$values = $c->replace(['a' => 'A', 'd' => 'D'])->all();

		$this->assertEquals([
				'a' => 'A',
				'b' => 'b',
				'c' => 'c',
				'd' => 'D'
			],
			$values
		);

		$recursiveReplaces = Collection::create([
			'languages' => [ 0 => 'PHP', 1 => 'Javascript', 2 => 'Python']
		])
		->replace(['languages' => [0 => 'PHP-5', 3 => 'NodeJS']], TRUE)
		->all();

		$this->assertEquals(
			[
				'languages' => [
					0 => 'PHP-5',
					1 => 'Javascript',
					2 => 'Python',
					3 => 'NodeJS',
				]
			],
			$recursiveReplaces
		);
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

	public function testSort()
	{

		$c = new Collection(['a', 'd', 'b', 'c']);

		$c = $c->sort(function ($a, $b)
		{
			return strcmp($a, $b);
		});

		$this->assertEquals(
			['a', 'b', 'c', 'd'],
			$c->values()
		);
	}

	public function testSortBy()
	{
		$c = new Collection();

		$c->add(['nome' => 'Wallace', 'idade' => 26]);
		$c->add(['nome' => 'Mayara', 'idade' => 20]);
		$c->add(['nome' => 'Wayne', 'idade' => 23]);

		$d = $c->sortBy(function ($value)
		{
			return $value['idade'];
		});

		$result = [
			[
				'nome'  => 'Mayara', 
				'idade' => 20
			],
			[
				'nome'  => 'Wayne',
				'idade' => 23
			],
			[
				'nome'  => 'Wallace',
				'idade' => 26
			]
		];
		
		$this->assertEquals(
			$result,
			$d->values()
		);

	}

	public function testChunk()
	{
		$c = new Collection([
			1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
		]);

		$chunk = $c->chunk(3, false);

		$this->assertInstanceOf(
			'\PHPLegends\Collections\Collection',
			$chunk->first()
		);

		$this->assertEquals(
			[
				[1, 2, 3],
				[4, 5, 6],
				[7, 8, 9],
				[10, 11, 12]
			],

			$chunk->toArray()
		);

	}

	public function testChunkPreserveKeys()
	{
		$c = new Collection([
			'A' => 1,
			'B' => 2,
			'C' => 3,
			'D' => 4,
			'E' => 5,
			'F' => 6,
			'G' => 7
		]);

		$chunk = $c->chunk(3);

		$this->assertEquals(
			[
				0 => [
					'A' => 1, 
					'B' => 2,
					'C' => 3
				],
				1 => [
					'D' => 4,
					'E' => 5,
					'F' => 6
				],
				2 => [
					'G' => 7
				]
			],
			$chunk->toArray()
		);
	}

	public function testRemoveKey()
	{
		$c = new Collection();

		$c['nome']  = 'Wallace';
		$c['idade'] = 26;
		$c['email'] = 'wallacemaxters@gmail.com';

		$this->assertTrue($c->has('email'));

		$email = $c->delete('email');

		$this->assertEquals(
			'wallacemaxters@gmail.com',
			$email
		);

		$this->assertCount(2, $c);

		$this->assertFalse($c->has('email'));

		$this->assertFalse(isset($c['email']));

	}

	public function testRemoveValue()
	{
		$c = new Collection();

		$c['nome']  = 'Wallace';
		$c['idade'] = 26;
		$c['email'] = 'wallacemaxters@gmail.com';

		$this->assertTrue(
			$c->contains('wallacemaxters@gmail.com')
		);

		$key = $c->remove('wallacemaxters@gmail.com');

		$this->assertEquals(
			'email', $key
		);

		// Where not exists, returns null

		$this->assertNull($c->remove('Non-Exists'));
	}


	public function testKeys()
	{

		$c = new Collection(['a' => 1, 'b' => 2]);

		$this->assertEquals(['a', 'b'], $c->keys());
	}

	public function testDiff()
	{

		$c = new Collection(['a' => 1, 'b' => 2, 'c' => 3]);

		$d = new Collection(['b' => 2, 'c' => 3, 'e' =>99]);

		$e = new Collection([1, 2]);

		// Non-Assoc DIFF

		$this->assertEquals(
			['a' => 1],
			$c->diff($d)->all()
		);

		$this->assertEquals(
			['c' => 3, 'e' => 99],
			$d->diff($e)->all()
		);

		$this->assertEquals(
			['e' => 99],
			$d->diff($c, true)->all()
		);


	}


	public function testSortKey()
	{	

		$items = new Collection([
			'id'    => 1,
			'nome'  => 'Wallace',
			'email' => 'wallacemaxters@gmail.com',
			'idade' => 26
		]);

		$this->assertEquals(
			[
				'email' => 'wallacemaxters@gmail.com',
				'id'    => 1,
				'idade' => 26,
				'nome'  => 'Wallace',
			],
			$items->sortByKeys()->all()
		);

		$this->assertEquals(
			['nome', 'idade', 'id', 'email'],
			$items->sortByKeys(false)->keys()
		);

	}


	public function testGroupBy()
	{
		$pessoas = new Collection();

		$pessoas[] = [
			'nome'  => 'Alexa',
			'idade' => 45,
			'sexo'  => 'F'
		];

		$pessoas[] = [
			'nome'  => 'Fernando',
			'idade' => 33,
			'sexo'  => 'M'
		];

		$pessoas[] = [
			'nome'  => 'Miguel',
			'idade' => '?',
			'sexo'  => 'M'
		];

		$pessoas[] = [
			'nome'  => 'Wallace',
			'idade' => 26,
			'sexo'  => 'M'
		];

		$grupos = $pessoas->groupBy(function ($value, $key)
		{
			return $value['sexo'];
		});

		$this->assertTrue($grupos->has('M'));

		$this->assertTrue($grupos->has('F'));

		$this->assertCount(3, $grupos->get('M'));

		$this->assertCount(1, $grupos->get('F'));

		$this->assertEquals('Alexa', $grupos->get('F')->first()['nome']);

		$this->assertEquals('Wallace', $grupos->get('M')->last()['nome']);
	}


	public function testOnlyAndExcept()
	{
		$collection = new Collection([
			'nome'                => 'wallace',
			'idade'               => 26,
			'linguagem_principal' => 'PHP'
		]);

		$expected = ['nome' => 'wallace', 'idade' => 26];

		$this->assertEquals(
			$expected,
			$collection->only(['nome', 'idade'])->all()
		);

		$this->assertEquals(
			$expected,
			$collection->except(['linguagem_principal'])->all()
		);
	}

}