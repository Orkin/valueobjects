<?php

declare(strict_types=1);

namespace ValueObjects\NullValue;

use BadMethodCallException;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function strval;

class NullValue implements ValueObjectInterface
{
    /**
     * @throws BadMethodCallException
     */
    public static function fromNative(): self
    {
        throw new BadMethodCallException('Cannot create a NullValue object via this method.');
    }

    /**
     * Returns a new NullValue object
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Tells whether two objects are both NullValue
     * @param  ValueObjectInterface $null
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $null): bool
    {
        return Util::classEquals($this, $null);
    }

    /**
     * Returns a string representation of the NullValue object
     *
     * @return string
     */
    public function __toString(): string
    {
        return strval(null);
    }
}
