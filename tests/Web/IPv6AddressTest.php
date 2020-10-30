<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\IPv6Address;

class IPv6AddressTest extends TestCase
{
    public function testValidIPv6Address()
    {
        $ip = new IPv6Address('::1');

        $this->assertInstanceOf(IPv6Address::class, $ip);
    }

    public function testInvalidIPv6Address()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new IPv6Address('127.0.0.1');
    }
}
