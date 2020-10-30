<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\Domain;
use ValueObjects\Web\EmailAddress;

class EmailAddressTest extends TestCase
{
    public function testValidEmailAddress()
    {
        $email1 = new EmailAddress('foo@bar.com');
        $this->assertInstanceOf(EmailAddress::class, $email1);

        $email2 = new EmailAddress('foo@[120.0.0.1]');
        $this->assertInstanceOf(EmailAddress::class, $email2);
    }

    public function testInvalidEmailAddress()
    {
        $this->expectException(InvalidNativeArgumentException::class);
        new EmailAddress('invalid');
    }

    public function testGetLocalPart()
    {
        $email = new EmailAddress('foo@bar.baz');
        $localPart = $email->getLocalPart();

        $this->assertEquals('foo', $localPart->toNative());
    }

    public function testGetDomainPart()
    {
        $email = new EmailAddress('foo@bar.com');
        $domainPart = $email->getDomainPart();

        $this->assertEquals('bar.com', $domainPart->toNative());
        $this->assertInstanceOf(Domain::class, $domainPart);
    }
}
