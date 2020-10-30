<?php

declare(strict_types=1);

namespace ValueObjects\Climate;

use ValueObjects\Number\Natural;
use ValueObjects\Exception\InvalidNativeArgumentException;

class RelativeHumidity extends Natural
{
    const MIN = 0;

    const MAX = 100;

    /**
     * Returns a new RelativeHumidity from native int value
     *
     * @param int $value
     * @return RelativeHumidity
     */
    public static function fromNative(): self
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new RelativeHumidity object
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = array(
            'options' => array('min_range' => self::MIN, 'max_range' => self::MAX)
        );

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, array('int (>=' . self::MIN . ', <=' . self::MAX . ')'));
        }

        parent::__construct($filteredValue);
    }
}
