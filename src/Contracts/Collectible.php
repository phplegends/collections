<?php

namespace PHPLegends\Collections\Contracts;

/**
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * 
 * */
interface Collectible
{

    /**
    * @param mixed $item
    */

    public function __construct(array $items = []);

    /**
     * Adds an item in collection
     * @param mixed $item 
     * @return $this
     */
    public function add($item);

    /**
     * Adds all items of another collection in this collection
     * @param Collectible $collection
     * @return $this
     * */
    public function addAll(Collectible $collection);

    /**
     * Checks if this Collection contains an determined item
     * @param $item
     * @return boolean
     * */
    public function contains($item);

    /**
     * Removes all from this collection based on another collection
     * @param Collectible $collection
     * @return $this
     * */
    public function removeAll(Collectible $collection);

    /**
     * Removes an item from collection
     * @param $item
     * */
    public function remove($item);

    /**
     * Gives all itens from collection
     * @return array
     * */
    public function all();

    /**
     * @return array
     **/
    public function keys();

}
