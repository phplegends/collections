<?php


use PHPLegends\Collections\MathCollection;

class MathCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $list = MathCollection::create([
            9,
            5,
            10
        ]);

        $this->assertEquals(
            24,
            $list->sum()
        );

        $this->assertEquals(10, $list->max());

        $this->assertEquals(5, $list->min());

        $this->assertEquals(
            (5 + 9 + 10) / 3,
            $list->average()
        );
    }

    public function testWithCallback()
    {

        $list = MathCollection::create([
            ['idade' => 9],
            ['idade' => 5],
            ['idade' => 10]
        ]);

        $key = function ($value) {
            return $value['idade'];
        };

        $this->assertEquals(24, $list->sum($key));

        $this->assertEquals(5, $list->min($key));

        $this->assertEquals(10, $list->max($key));

        $this->assertEquals((5 + 9 + 10) / 3, $list->average($key));

    }
}