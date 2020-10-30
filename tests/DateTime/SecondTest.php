<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\DateTime\Second;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;

class SecondTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeSecond  = Second::fromNative(13);
        $constructedSecond = new Second(13);

        $this->assertTrue($fromNativeSecond->sameValueAs($constructedSecond));
    }

    public function testNow()
    {
        $second = Second::now();
        $this->assertEquals(\intval(date('s')), $second->toNative());
    }

    public function testInvalidSecond()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        $this->expectExceptionMessage(
            "Argument \"60\" is invalid. Allowed types for argument are \"int (>=0, <=59)\"."
        );
        new Second(60);
    }

}
