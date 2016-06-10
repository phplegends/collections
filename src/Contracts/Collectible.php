<?php

namespace PHPLegends\Collections\Contracts;

/**
* Essentials methods for implementation of collection
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
interface Collectible
{

    /**
     * The constructor 
     * 
    * @param array $item
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

    /**
     * Searches element by index in collecion
     * @param int|string $key
     * @return int|string|false
     * */
    public function search($key);

    /**
     * Remove all elements for collections
     * @return self
     * */
    public function clear();

    /**
    * Removes last item from items
    * @return mixed
    */
    public function pop();

    /**
    * Remove first element of array
    * @return mixed
    */
    public function shift();

    /**
    * Add an element at first position of collection
    * @param mixed $item
    * @return $this
    */
    public function unshift($item);

    /**
     * This Collection is Empty?
     * @return boolean
     * */
    public function isEmpty();

}
