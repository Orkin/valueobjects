<?php

declare(strict_types=1);

namespace ValueObjects\DateTime;

use ValueObjects\DateTime\Exception\InvalidTimeZoneException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class TimeZone implements ValueObjectInterface
{
    protected StringLiteral $name;

    /**
     * Returns a new Time object from native timezone name
     *
     * @param  string $name
     * @return self
     */
    public static function fromNative(): self
    {
        $args = func_get_args();

        $name = new StringLiteral($args[0]);

        return new static($name);
    }

    /**
     * Returns a new Time from a native PHP \DateTime
     *
     * @param  \DateTimeZone $timezone
     * @return self
     */
    public static function fromNativeDateTimeZone(\DateTimeZone $timezone): self
    {
        return static::fromNative($timezone->getName());
    }

    /**
     * Returns default TimeZone
     *
     * @return self
     */
    public static function fromDefault(): self
    {
        return new static(new StringLiteral(date_default_timezone_get()));
    }

    /**
     * Returns a new TimeZone object
     *
     * @param StringLiteral $name
     * @throws InvalidTimeZoneException
     */
    public function __construct(StringLiteral $name)
    {
        if (!in_array($name->toNative(), timezone_identifiers_list())) {
            throw new InvalidTimeZoneException($name);
        }

        $this->name = $name;
    }

    /**
     * Returns a native PHP \DateTimeZone version of the current TimeZone.
     *
     * @return \DateTimeZone
     */
    public function toNativeDateTimeZone(): \DateTimeZone
    {
        return new \DateTimeZone($this->getName()->toNative());
    }

    /**
     * Tells whether two DateTimeZone are equal by comparing their names
     *
     * @param  ValueObjectInterface $timezone
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $timezone): bool
    {
        if (false === Util::classEquals($this, $timezone)) {
            return false;
        }

        return $this->getName()->sameValueAs($timezone->getName());
    }

    /**
     * Returns timezone name
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return clone $this->name;
    }

    /**
     * Returns timezone name as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName()->__toString();
    }
}
