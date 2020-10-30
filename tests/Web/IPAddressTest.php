<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\IPAddress;
use ValueObjects\Web\IPAddressVersion;

class IPAddressTest extends TestCase
{
    public function testGetVersion()
    {
        $ip4 = new IPAddress('127.0.0.1');
        $this->assertSame(IPAddressVersion::IPV4(), $ip4->getVersion());

        $ip6 = new IPAddress('::1');
        $this->assertSame(IPAddressVersion::IPV6(), $ip6->getVersion());
    }

    public function testInvalidIPAddress()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new IPAddress('invalid');
    }
}
