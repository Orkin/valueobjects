<?php

declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\Number\Integer;
use function intval;

class Year extends Integer
{
    /**
     * Returns the current year.
     *
     * @return Year
     */
    public static function now()
    {
        $now  = new \DateTime('now');
        $year = intval($now->format('Y'));

        return new static($year);
    }
}
