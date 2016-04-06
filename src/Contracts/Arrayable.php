<?php

namespace PHPLegends\Collections\Contracts;

/**
* Indicates that the class can be transformed into array
 * @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
 * */
interface Arrayable
{
	/**
	* @return array
	*/
	public function toArray();
}
