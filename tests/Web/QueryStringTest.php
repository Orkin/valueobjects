<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Structure\Dictionary;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\QueryString;
use ValueObjects\Web\NullQueryString;

class QueryStringTest extends TestCase
{
    public function testValidQueryString()
    {
        $query = new QueryString('?foo=bar');

        $this->assertInstanceOf(QueryString::class, $query);
    }

    public function testEmptyQueryString()
    {
        $query = new NullQueryString();

        $this->assertInstanceOf(QueryString::class, $query);

        $dictionary = $query->toDictionary();
        $this->assertInstanceOf(Dictionary::class, $dictionary);
    }

    public function testInvalidQueryString()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new QueryString('invalìd');
    }

    public function testToDictionary()
    {
        $query = new QueryString('?foo=bar&array[]=one&array[]=two');
        $dictionary = $query->toDictionary();

        $this->assertInstanceOf(Dictionary::class, $dictionary);

        $array = array(
            'foo'   => 'bar',
            'array' => array(
                'one',
                'two'
            )
        );
        $expectedDictionary = Dictionary::fromNative($array);

        $this->assertTrue($expectedDictionary->sameValueAs($dictionary));
    }
}
