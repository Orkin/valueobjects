<?php

namespace ValueObjects\Tests\Geography;

use TypeError;
use ValueObjects\Geography\Latitude;
use ValueObjects\Tests\TestCase;

class LatitudeTest extends TestCase
{
    public function testNormalization()
    {
        $latitude = new Latitude(91);
        $this->assertEquals(90, $latitude->toNative());
    }

    public function testInvalidLatitude()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage("Argument 1 passed to ValueObjects\Geography\Latitude::__construct() must be of the type float, string given");
        new Latitude('invalid');
    }
}
