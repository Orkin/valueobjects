<?php

namespace ValueObjects\Identity;

use Ramsey\Uuid\Validator\GenericValidator;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use Ramsey\Uuid\Uuid as BaseUuid;
use function func_get_arg;
use function preg_match;
use function strval;

class UUID extends StringLiteral
{
    protected string $value;

    /**
     * @param string $uuid
     *
     * @return UUID
     * @throws InvalidNativeArgumentException
     */
    public static function fromNative(): self
    {
        $uuid_str = func_get_arg(0);

        return new static($uuid_str);
    }

    /**
     * Generate a new UUID string
     *
     * @return string
     */
    public static function generateAsString(): string
    {
        $uuid = new static();

        return $uuid->toNative();
    }

    public function __construct(string $value = null)
    {
        $uuid_str = BaseUuid::uuid4();

        if (null !== $value) {
            $genericValidator = new GenericValidator();
            $pattern = '/' . $genericValidator->getPattern() . '/';

            if (! preg_match($pattern, $value)) {
                throw new InvalidNativeArgumentException($value, ['UUID string']);
            }

            $uuid_str = $value;
        }

        parent::__construct(strval($uuid_str));
    }

    /**
     * Tells whether two UUID are equal by comparing their values
     *
     * @param UUID $uuid
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $uuid): bool
    {
        if (false === Util::classEquals($this, $uuid)) {
            return false;
        }

        return $this->toNative() === $uuid->toNative();
    }
}
