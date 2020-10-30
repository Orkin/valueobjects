<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\FragmentIdentifier;
use ValueObjects\Web\NullFragmentIdentifier;

class FragmentIdentifierTest extends TestCase
{
    public function testValidFragmentIdentifier()
    {
        $fragment = new FragmentIdentifier('#id');

        $this->assertInstanceOf(FragmentIdentifier::class, $fragment);
    }

    public function testNullFragmentIdentifier()
    {
        $fragment = new NullFragmentIdentifier();

        $this->assertInstanceOf(FragmentIdentifier::class, $fragment);
    }

    public function testInvalidFragmentIdentifier()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new FragmentIdentifier('invalìd');
    }
}
