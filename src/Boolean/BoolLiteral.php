<?php

declare(strict_types=1);

namespace ValueObjects\Boolean;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class BoolLiteral implements ValueObjectInterface
{
    protected bool $value;

    /**
     * Returns a BoolLiteral object given a BooleanString as parameter.
     *
     * @param BooleanString $booleanString
     *
     * @return static
     */
    public static function fromBooleanString(BooleanString $booleanString)
    {
        return static::fromNative($booleanString->toBool());
    }

    /**
     * Returns a BoolLiteral object given a PHP native bool as parameter.
     *
     * @param bool $value
     *
     * @return static
     */
    public static function fromNative(): self
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a BoolLiteral object given a PHP native bool as parameter.
     *
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * Tells whether two BoolLiteral are equal by comparing their values
     *
     * @param ValueObjectInterface $boolLiteral
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $boolLiteral): bool
    {
        if (false === Util::classEquals($this, $boolLiteral)) {
            return false;
        }

        return $this->toNative() === $boolLiteral->toNative();
    }

    /**
     * Returns the native value of the BoolLiteral
     *
     * @return bool
     */
    public function toNative(): bool
    {
        return $this->value;
    }

    /**
     * Returns a string representation of the BoolLiteral
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
