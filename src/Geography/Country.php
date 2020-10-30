<?php

declare(strict_types=1);

namespace ValueObjects\Geography;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function func_get_arg;

class Country implements ValueObjectInterface
{
    /** @var CountryCode */
    protected CountryCode $code;

    /**
     * Returns a new Country object given a native PHP string country code
     *
     * @param  string $code
     * @return self
     */
    public static function fromNative(): self
    {
        $codeString = func_get_arg(0);
        $code       = CountryCode::byName($codeString);
        return new static($code);
    }

    /**
     * Returns a new Country object
     *
     * @param CountryCode $code
     */
    public function __construct(CountryCode $code)
    {
        $this->code = $code;
    }

    /**
     * Tells whether two Country are equal
     *
     * @param  ValueObjectInterface $country
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $country): bool
    {
        if (false === Util::classEquals($this, $country)) {
            return false;
        }

        return $this->getCode()->sameValueAs($country->getCode());
    }

    /**
     * Returns country code
     *
     * @return CountryCode
     */
    public function getCode(): CountryCode
    {
        return $this->code;
    }

    /**
     * Returns country name
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        $code = $this->getCode();
        return CountryCodeName::getName($code);
    }

    /**
     * Returns country name as native string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName()->toNative();
    }
}
