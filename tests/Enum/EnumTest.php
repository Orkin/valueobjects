<?php

namespace ValueObjects\Tests\Enum;

use ValueObjects\Enum\Enum;
use ValueObjects\Tests\TestCase;

class EnumTest extends TestCase
{
    public function testSameValueAs()
    {
        $stub1 = $this->createMock(Enum::class, [], [], '', false);
        $stub2 = $this->createMock(Enum::class, [], [], '', false);

        $stub1->expects($this->any())
              ->method('sameValueAs')
              ->will($this->returnValue(true));

        $this->assertTrue($stub1->sameValueAs($stub2));
    }

    public function testToString()
    {
        $stub = $this->createMock(Enum::class, [], [], '', false);

        $this->assertEquals('', $stub->__toString());
    }
}
