<?php

use PHPLegends\Collections\Collection;

class CollectionTest extends PHPUnit\Framework\TestCase
{

    public function setUp(): void
    {
        $this->fruits = new Collection(['Pêra', 'Banana', 'Maçã']); 
    }

    public function testAdd()
    {
        $this->fruits->add('Laranja');

        $this->assertCount(4, $this->fruits, 'The value expected is 4');
    }


    public function testAll()
    {
        $this->assertIsArray($this->fruits->all(), 'Is not a array');
    }


    public function testRemove()
    {
        $this->fruits->remove('Maçã');

        $this->assertCount(2, $this->fruits);
    }

    public function testRemoveAll()
    {
        $collection = new Collection([
            'um'   => 1,
            'one'  => 1,
            'uno'  => 1,
            'dois' => 2,
            'tres' => 3,
        ]);
        
        $this->assertCount(5, $collection);

        $removed = $collection->removeAll(1);

        $this->assertCount(2, $collection);
    }



    public function testContains()
    {
        $collection = $this->fruits;
        
        $this->assertTrue($collection->contains('Banana'));

        $this->assertTrue($collection->contains('Maçã'));

        $this->assertFalse($collection->contains('Abacaxi'));
        
    }

    public function testShift()
    {
        $this->assertCount(3, $this->fruits);

        $this->assertEquals('Pêra', $this->fruits->shift());

        $this->assertCount(2, $this->fruits);

    }

    public function testUnshift()
    {
        $this->assertCount(3, $this->fruits);

        $this->fruits->unshift('Morango', 'Uva');

        $this->assertCount(5, $this->fruits);

    }


    public function testFirst()
    {
        $this->assertEquals('Pêra', $this->fruits->first());
        
        $this->fruits->add('Banana 1')->add('Banana 2');
        
        $this->assertEquals('Banana', $this->fruits->first(function ($value) {
            return substr($value, 0, 3) === 'Ban';
        }));

    }

    public function testLast()
    {
       
        $this->assertEquals('Maçã', $this->fruits->last());
        
        $this->fruits->add('Banana 1')->add('Banana 2');

        $this->assertEquals('Banana 2', $this->fruits->last(function ($value) {
            return substr($value, 0, 3) === 'Ban';
        }));
    }


    public function testFilter()
    {
        $this->fruits->add('Uva')->add('Kiwi');

        $result = $this->fruits->filter(function ($value) {
            return $value === 'Uva' || $value == 'Banana';
        });

        $this->assertContains('Uva', $result);
        $this->assertContains('Banana', $result);
        $this->assertNotContains('Pera', $result);
    }

    public function testReverse()
    {
        $this->assertEquals($this->fruits->reverse()->all(), [2 => 'Maçã', 1 => 'Banana', 0 => 'Pêra']);

        $this->assertEquals($this->fruits->reverse(false)->all(), ['Maçã', 'Banana', 'Pêra']);
    }


    public function testOnly()
    {
        $collection = new Collection([
            'first_name' => 'Wallace', 
            'last_name'  => 'Maxters',
            'year'       => 2021,
            'age'        => 31,
        ]);

        $this->assertCount(2, $only = $collection->only(['first_name', 'last_name']));

        $only = $collection->only(['first_name', 'last_name']);

        $this->assertEquals($only->get('first_name'), 'Wallace');
    }

    public function testExcept()
    {

        $collection = new Collection([
            'first_name' => 'Wallace', 
            'last_name'  => 'Maxters',
            'year'       => 2021,
            'age'        => 31,
            'city'       => 'Contagem',
        ]);

        $this->assertCount(3, $only = $collection->except(['first_name', 'last_name']));

        $this->assertNull($only->get('first_name'));
        $this->assertNull($only->get('last_name'));

        $this->assertEquals('Contagem', $only->get('city'));
    }

    public function testJsonSerialize()
    {
        $json = json_encode($this->fruits);

        $this->assertEquals('["P\u00eara","Banana","Ma\u00e7\u00e3"]', $json);

    }


    public function testGet()
    {
        $collection = new Collection([
            'name' => 'Maxters',
            'number' => 25
        ]);

        $this->assertEquals('Maxters', $collection->get('name'));
        $this->assertEquals(25, $collection->get('number'));
    }

    public function testGetOrDefault()
    {
        $collection = new Collection(['name' => 'Maxters']);

        $this->assertEquals('Maxters', $collection->getOrDefault('name', 'Wallace'));
        $this->assertEquals('Wallace', $collection->getOrDefault('first_name', 'Wallace')); 
    }

    public function testSet()
    {
        $collection = new Collection([
            'name' => 'BrContainer'
        ]);

        $this->assertEquals('BrContainer', $collection->get('name'));

        $collection->set('name', 'Maxters');

        $this->assertEquals('Maxters', $collection->get('name'));
    }



    public function testSearchall()
    {
        $collection = new Collection([
            'um'   => 1,
            'one'  => 1,
            'uno'  => 1,
            'dois' => 2,
            'tres' => 3,
        ]);

        $keys = $collection->searchAll(1);
        
        $this->assertCount(3, $keys);
    }
}