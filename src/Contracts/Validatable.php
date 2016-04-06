<?php

namespace PHPLegends\Collections\Contracts;

/**
 * Asserts if the collection contains a determined value
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
interface Validatable
{
    /**
     * Checks if at least one element returns true
     * @param callable $callback
     * @return boolean
     * */
	public function some(callable $callback);

    /**
     * Checks if every elements returns true
     * @param callable $callback
     * @return boolean
     **/
	public function every(callable $callback);

    /**
     * This Collection is Empty?
     * @return boolean
     * */
	public function isEmpty();
}