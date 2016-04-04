<?php

namespace PHPLegends\Collections\Contracts;

/**
 * Interface for key value collection. Contract for use named keys in collection
 * 
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
interface Accessible
{   
    /**
     * Description
     * @param int|key $key 
     * @param mixed $value 
     * @return self
     */
    public function set($key, $value);

    /**
     * Description
     * @param int|key $key 
     * @return mixed
     */
    public function get($key);

    /**
     * Checks if key exists in Collection
     * @param int|string $key 
     * @return boolean
     */
    public function has($key);

    /**
     * Delete an item from Collection by index
     * @return mixed
     * */
    public function delete($key);

    /**
     * All keys of Collection 
     * @return array
     * */
    public function keys();

    /**
     * @param array $items
     * @param boolean $recursive
     * @return $this
     * */
    public function merge(array $items, $recursive = false);

    /**
     * Replaces items in Collection
     * @param array $items 
     * @param boolean $recursive 
     * @return $this
     */
    public function replace(array $items, $recursive = false);

    /**
     * Returns elements in collection specified in $keys
     * @param array $keys
     * @return Collection
     * */
    public function only(array $keys);

    /**
     * Returns all elements of Collection, except the specified in $keys
     * @param array $keys
     * @return Collection
     * */
    public function except(array $keys);

    /**
     * Searches element by index in collecion
     * @param int|string $key
     * @return int|string|false
     * */
    public function search($key);

    /**
    * @param boolean $ascending
    */
    public function sortByKeys($ascending = true);

}