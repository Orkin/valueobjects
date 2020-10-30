<?php

namespace ValueObjects\Tests\Number;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Natural;
use ValueObjects\Tests\TestCase;

class NaturalTest extends TestCase
{
    public function testInvalidNativeArgument()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        $this->expectExceptionMessage("Argument \"-2\" is invalid. Allowed types for argument are \"int (>=0)\".");
        new Natural(-2);
    }
}
