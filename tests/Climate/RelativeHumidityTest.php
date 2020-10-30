<?php

namespace ValueObjects\Tests\Climate;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Climate\RelativeHumidity;

class RelativeHumidityTest extends TestCase
{
    public function testFromNative()
    {
        $fromNativeRelHum  = RelativeHumidity::fromNative(70);
        $constructedRelHum = new RelativeHumidity(70);

        $this->assertTrue($fromNativeRelHum->sameValueAs($constructedRelHum));
    }

    public function testInvalidRelativeHumidity()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        $this->expectExceptionMessage("Argument \"128\" is invalid. Allowed types for argument are \"int (>=0, <=100)");
        new RelativeHumidity(128);
    }
}
