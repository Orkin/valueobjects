<?php

declare(strict_types=1);

namespace ValueObjects\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;

class Natural extends Integer
{
    /**
     * Returns a Natural object given a PHP native int as parameter.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => [
                'min_range' => 0,
            ],
        ];

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, ['int (>=0)']);
        }

        parent::__construct($filteredValue);
    }
}
