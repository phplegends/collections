<?php

namespace PHPLegends\Collections\Contracts;

/**
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
interface Modifiable
{
    /**
    * @param int $size
    * @param boolean $preserveKeys
    * @return Collection
    */
    public function chunk($amont, $preserveKeys = true);

    /**
    * @param Collectible $collection
    * @return Collectible
    */
    public function intersect(Collectible $collection);

    /**
    * @param Collectible $collection
    * @return Collectible
    */
    public function diff(Collectible $collection);

    /**
    * @param callable $callback
    * @return Collectible
    */
    public function filter(callable $callback);

    /**
    * @param callable $callback|null
    * @return Collectible
    */
    public function map(callable $callback = null);

    /**
    * @param callable $callback
    * @return Collectible
    */
    public function reject(callable $callback);

    /**
    * @param boolean $preserveKeys
    * @return Collectible
    */
    public function reverse($preserveKeys = true);

    /**
    * Returns the slice for collection
    * @param int $offset
    * @param null|int $limit 
    * @return Collectible
    */
    public function slice($offset, $limit);


    /**
    * @param callable $callback|null
    * @return Collectible
    */
    public function sort(callable $callback = null);

    /**
    * @param callable|null $callback
    * @param boolean $ascending
    * @return Collectible
    */
    public function sortBy(callable $callback, $ascending = true);

    /**
    * @return Collectible
    */
    public function unique();

    /**
    * @return Collectible
    */
    public function shuffle();

}