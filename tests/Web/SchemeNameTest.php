<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\SchemeName;

class SchemeNameTest extends TestCase
{
    public function testValidSchemeName()
    {
        $scheme = new SchemeName('git+ssh');
        $this->assertInstanceOf(SchemeName::class, $scheme);
    }

    public function testInvalidSchemeName()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        $this->expectExceptionMessage(
            "Argument \"ht*tp\" is invalid. Allowed types for argument are \"string (valid scheme name)\"."
        );
        new SchemeName('ht*tp');
    }
}
