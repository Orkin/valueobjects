<?php

declare(strict_types=1);

namespace ValueObjects\Web;

class NullPath extends Path implements PathInterface
{
    /**
     * Returns a new NullPath
     *
     */
    public function __construct()
    {
        $this->value = '';
    }
}
