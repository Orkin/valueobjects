<?php

declare(strict_types=1);

namespace ValueObjects\Boolean;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use function filter_var;

class BooleanString extends StringLiteral
{
    /**
     * Returns a BooleanString object
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (null === filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
            throw new InvalidNativeArgumentException($value, array('string (boolean value)'));
        }

        parent::__construct($value);
    }

    /**
     * Returns the bool value of the BooleanString
     *
     * @return bool
     */
    public function toBool(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
    }
}
