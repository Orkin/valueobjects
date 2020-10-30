<?php

declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use function intval;

class Minute extends Natural
{
    const MIN_MINUTE = 0;

    const MAX_MINUTE = 59;

    /**
     * Returns a new Minute from native int value
     *
     * @param int $value
     *
     * @return Minute
     */
    public static function fromNative(): self
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns a new Minute object
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $options = [
            'options' => ['min_range' => self::MIN_MINUTE, 'max_range' => self::MAX_MINUTE],
        ];

        $filteredValue = filter_var($value, FILTER_VALIDATE_INT, $options);

        if (false === $filteredValue) {
            throw new InvalidNativeArgumentException($value, ['int (>=0, <=59)']);
        }

        parent::__construct($filteredValue);
    }

    /**
     * Returns the current minute.
     *
     * @return Minute
     */
    public static function now(): self
    {
        $now = new \DateTime('now');
        $minute = intval($now->format('i'));

        return new static($minute);
    }
}
