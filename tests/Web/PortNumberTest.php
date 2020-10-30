<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\PortNumber;

class PortNumberTest extends TestCase
{
    public function testValidPortNumber()
    {
        $port = new PortNumber(80);

        $this->assertInstanceOf(PortNumber::class, $port);
    }

    public function testInvalidPortNumber()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new PortNumber(65536);
    }
}
