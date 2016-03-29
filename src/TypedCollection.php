<?php

namespace PHPLegends\Collections;

use PHPLegends\Collections\Contracts\TypedCollectionInterface;
use PHPLegends\Collections\Exceptions\TypedCollectionException;

/**
* @author Wallace de Souza Vizerra <wallacemaxters@gmail.com>
*/

abstract class TypedCollection extends Collection implements TypedCollectionInterface
{
    abstract function of($value);

    public function raiseException($value)
    {
        throw new TypedCollectionException(
            sprintf('Unexcepted value "%s" of type "%s"',
                $this->parseValue($value),
                $this->parseType($value)
            )
        );
    }

    protected function validateValue($value)
    {
        if (! $this->of($value)) {

            return $this->raiseException($value);
        }

        return true;
    }

    protected function parseType($value)
    {
        if (is_object($value))
        {
            return get_class($value);
        }

        return gettype($value);
    }

    protected function parseValue($value)
    {
        if (is_scalar($value)) {
            
            return $value;

        } elseif (is_object($value))
        {
            return get_class($value);
        }

        return var_export($value, true);
    }

    public function add($item)
    {
        $this->validateValue($item);

        parent::add($item);

        return $this;
    }

    public function set($key, $value)
    {
        $this->validateValue($value);

        parent::set($key, $value);

        return $this;
    }

}