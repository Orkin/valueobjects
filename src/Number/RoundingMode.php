<?php

namespace ValueObjects\Number;

use ValueObjects\Enum\Enum;

/**
 * /**
 * @author Florent Blaison
 *
 * @method static RoundingMode HALF_UP()
 * @method static RoundingMode HALF_DOWN()
 * @method static RoundingMode HALF_EVEN()
 * @method static RoundingMode HALF_ODD()
 */
class RoundingMode extends Enum
{
    const HALF_UP   = PHP_ROUND_HALF_UP;
    const HALF_DOWN = PHP_ROUND_HALF_DOWN;
    const HALF_EVEN = PHP_ROUND_HALF_EVEN;
    const HALF_ODD  = PHP_ROUND_HALF_ODD;
}
