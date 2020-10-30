<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\Hostname;

class HostnameTest extends TestCase
{
    public function testInvalidHostname()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new Hostname('inv@lìd');
    }
}
