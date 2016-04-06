<?php

namespace PHPLegends\Collections\Contracts;

/**
 * Methods responsible for modifying data of collection (order, groups and filters)
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */

interface Modifiable
{
    /**
    * @param int $size
    * @param boolean $preserveKeys
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function chunk($amont, $preserveKeys = true);

    /**
    * @param Collectible $collection
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function intersect(Collectible $collection);

    /**
    * @param Collectible $collection
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function diff(Collectible $collection);

    /**
    * @param callable $callback
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function filter(callable $callback);

    /**
    * @param callable $callback|null
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function map(callable $callback = null);

    /**
    * @param callable $callback
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function reject(callable $callback);

    /**
    * @param boolean $preserveKeys
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function reverse($preserveKeys = true);

    /**
    * Returns the slice for collection
    * @param int $offset
    * @param null|int $limit 
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function slice($offset, $limit);


    /**
    * @param callable $callback|null
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function sort(callable $callback = null);

    /**
    * @param callable|null $callback
    * @param boolean $ascending
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function sortBy(callable $callback, $ascending = true);

    /**
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function unique();

    /**
    * @return \PHPLegends\Collections\Contracts\Collectible
    */
    public function shuffle();

    /**
     * Group by
     * @param callable $callback
     * @param boolean $preserveKeys
     * @return \PHPLegends\Collections\Contracts\Collectible
     * */
    public function groupBy(callable $callback, $preserveKeys = true);

}