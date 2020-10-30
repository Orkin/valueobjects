<?php

declare(strict_types=1);

namespace ValueObjects\Person;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function strval;

class Name implements ValueObjectInterface
{
    /**
     * First name
     *
     * @var StringLiteral
     */
    private StringLiteral $firstName;

    /**
     * Middle name
     *
     * @var StringLiteral
     */
    private StringLiteral $middleName;

    /**
     * Last name
     *
     * @var StringLiteral
     */
    private StringLiteral $lastName;

    /**
     * Returns a Name objects form PHP native values
     *
     * @param  string $first_name
     * @param  string $middle_name
     * @param  string $last_name
     * @return Name
     */
    public static function fromNative(): self
    {
        $args = func_get_args();

        $firstName  = new StringLiteral($args[0]);
        $middleName = new StringLiteral($args[1]);
        $lastName   = new StringLiteral($args[2]);

        return new static($firstName, $middleName, $lastName);
    }

    /**
     * Returns a Name object
     *
     * @param StringLiteral $first_name
     * @param StringLiteral $middle_name
     * @param StringLiteral $last_name
     */
    public function __construct(StringLiteral $first_name, StringLiteral $middle_name, StringLiteral $last_name)
    {
        $this->firstName  = $first_name;
        $this->middleName = $middle_name;
        $this->lastName   = $last_name;
    }

    /**
     * Returns the first name
     *
     * @return StringLiteral
     */
    public function getFirstName(): StringLiteral
    {
        return $this->firstName;
    }

    /**
     * Returns the middle name
     *
     * @return StringLiteral
     */
    public function getMiddleName(): StringLiteral
    {
        return $this->middleName;
    }

    /**
     * Returns the last name
     *
     * @return StringLiteral
     */
    public function getLastName(): StringLiteral
    {
        return $this->lastName;
    }

    /**
     * Returns the full name
     *
     * @return StringLiteral
     */
    public function getFullName(): StringLiteral
    {
        $fullNameString = $this->firstName .
            ($this->middleName->isEmpty() ? '' : ' ' . $this->middleName) .
            ($this->lastName->isEmpty() ? '' : ' ' . $this->lastName);

        $fullName = new StringLiteral($fullNameString);

        return $fullName;
    }

    /**
     * Tells whether two names are equal by comparing their values
     *
     * @param  ValueObjectInterface $name
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $name): bool
    {
        if (false === Util::classEquals($this, $name)) {
            return false;
        }

        return $this->getFullName() == $name->getFullName();
    }

    /**
     * Returns the full name
     *
     * @return string
     */
    public function __toString(): string
    {
        return strval($this->getFullName());
    }
}
