<?php

declare(strict_types=1);

namespace ValueObjects\Web;

interface QueryStringInterface
{
    public function toDictionary();
}
