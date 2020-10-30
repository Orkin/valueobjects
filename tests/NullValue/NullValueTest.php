<?php

namespace ValueObjects\Tests\NullValue;

use BadMethodCallException;
use ValueObjects\NullValue\NullValue;
use ValueObjects\Tests\TestCase;

class NullValueTest extends TestCase
{
    public function testFromNative()
    {
        $this->expectException(BadMethodCallException::class);
        NullValue::fromNative();
    }

    public function testSameValueAs()
    {
        $null1 = new NullValue();
        $null2 = new NullValue();

        $this->assertTrue($null1->sameValueAs($null2));
    }

    public function testCreate()
    {
        $null = NullValue::create();

        $this->assertInstanceOf(NullValue::class, $null);
    }

    public function testToString()
    {
        $foo = new NullValue();
        $this->assertSame('', $foo->__toString());
    }
}
