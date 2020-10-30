<?php

namespace ValueObjects\Tests\DateTime;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\DateTime\MonthDay;

class MonthDayTest extends TestCase
{
    public function fromNative()
    {
        $fromNativeMonthDay  = MonthDay::fromNative(15);
        $constructedMonthDay = new MonthDay(15);

        $this->assertTrue($fromNativeMonthDay->sameValueAs($constructedMonthDay));
    }

    public function testNow()
    {
        $monthDay = MonthDay::now();
        $this->assertEquals(date('j'), $monthDay->toNative());
    }

    public function testInvalidMonthDay()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        $this->expectExceptionMessage(
            "Argument \"32\" is invalid. Allowed types for argument are \"int (>=0, <=31)\"."
        );
        new MonthDay(32);
    }

}
