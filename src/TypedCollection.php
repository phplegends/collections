<?php

namespace PHPLegends\Collections;

use PHPLegends\Collections\Contracts\TypedCollectionInterface;

abstract class TypeCollection extends Collection implements TypedCollectionInterface
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

	protected function getType($value)
	{
		if (is_object($value))
		{
			return get_class($value);
		}

		return gettype($value);
	}

	protected function parseValue($value)
	{
		if (is_scalar($value))
		{
			return $value;
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