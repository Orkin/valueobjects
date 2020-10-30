<?php

declare(strict_types=1);

namespace ValueObjects\Util;

use function get_class;

/**
 * Utility class for methods used all across the library
 * @package ValueObjects\Util
 */
class Util
{
    /**
     * Tells whether two objects are of the same class
     *
     * @param  object $object_a
     * @param  object $object_b
     * @return bool
     */
    public static function classEquals(object $object_a, object $object_b): bool
    {
        return get_class($object_a) === get_class($object_b);
    }

    /**
     * Returns full namespaced class as string
     *
     * @param $object
     * @return string
     */
    public static function getClassAsString($object): string
    {
        return get_class($object);
    }
}
