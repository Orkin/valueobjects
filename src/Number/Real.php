<?php

namespace ValueObjects\Number;

use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function abs;
use function bccomp;
use function round;
use function strval;

class Real implements ValueObjectInterface, NumberInterface
{
    protected float $value;

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $value
     *
     * @return static
     */
    public static function fromNative(): self
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a Real object given a PHP native float as parameter.
     *
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the native value of the real number
     *
     * @return float
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Tells whether two Real are equal by comparing their values
     *
     * @param ValueObjectInterface $real
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $real): bool
    {
        if (false === Util::classEquals($this, $real)) {
            return false;
        }

        // https://www.php.net/manual/en/language.types.float.php
        return bccomp($this->toNative(), $real->toNative(), 5) === 0;
    }

    /**
     * Returns the integer part of the Real number as a Integer
     *
     * @param RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Integer
     */
    public function toInteger(RoundingMode $rounding_mode = null): self
    {
        if (null === $rounding_mode) {
            $rounding_mode = RoundingMode::HALF_UP();
        }

        $value = $this->toNative();
        $integerValue = round($value, 0, $rounding_mode->toNative());
        $integer = new Integer($integerValue);

        return $integer;
    }

    /**
     * Returns the absolute integer part of the Real number as a Natural
     *
     * @param RoundingMode $rounding_mode Rounding mode of the conversion. Defaults to RoundingMode::HALF_UP.
     *
     * @return Natural
     */
    public function toNatural(RoundingMode $rounding_mode = null)
    {
        $integerValue = $this->toInteger($rounding_mode)->toNative();
        $naturalValue = abs($integerValue);
        $natural = new Natural($naturalValue);

        return $natural;
    }

    /**
     * Returns the string representation of the real value
     *
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->toNative());
    }
}
