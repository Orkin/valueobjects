<?php

namespace ValueObjects\Tests\Boolean;

use ValueObjects\Boolean\BooleanString;
use ValueObjects\Exception\InvalidNativeArgumentException;

class BooleanStringTest extends BooleanTestCase
{
    /** @dataProvider booleanValuesProvider */
    public function testFromNative($boolean)
    {
        $fromNativeBooleanString = BooleanString::fromNative($boolean);
        $constructedBooleanString = new BooleanString($boolean);

        $this->assertTrue($fromNativeBooleanString->sameValueAs($constructedBooleanString));
    }

    public function testInvalidNativeArgument()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new BooleanString('enabled');
    }

    /** @dataProvider booleanValuesProvider */
    public function testToBool($boolean, $expected)
    {
        $booleanString = new BooleanString($boolean);

        $this->assertEquals($booleanString->toBool(), $expected);
    }
}
