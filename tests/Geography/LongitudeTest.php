<?php

namespace ValueObjects\Tests\Geography;

use TypeError;
use ValueObjects\Geography\Longitude;
use ValueObjects\Tests\TestCase;

class LongitudeTest extends TestCase
{
    public function testNormalization()
    {
        $longitude = new Longitude(181);
        $this->assertEquals(-179, $longitude->toNative());
    }

    public function testInvalidLongitude()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage("Argument 1 passed to ValueObjects\Geography\Longitude::__construct() must be of the type float, string given");
        new Longitude('invalid');
    }
}
