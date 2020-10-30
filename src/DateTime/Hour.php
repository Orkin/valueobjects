<?php

declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use function intval;

class Hour extends Natural
{
    const MIN_HOUR = 0;
    const MAX_HOUR = 23;

    /**
     * Returns a new Hour from native int value
     *
     * @param int $value
     *
     * @return Hour
     */
    public static function fromNative(): self
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new Hour object
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => ['min_range' => self::MIN_HOUR, 'max_range' => self::MAX_HOUR],
        ];

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, ['int (>=0, <=23)']);
        }

        parent::__construct($filteredValue);
    }

    /**
     * Returns the current hour.
     *
     * @return Hour
     */
    public static function now(): self
    {
        $now = new \DateTime('now');
        $hour = intval($now->format('G'));

        return new static($hour);
    }
}
