<?php

namespace ValueObjects\Geography;

use BadFunctionCallException;
use BadMethodCallException;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function count;

class Street implements ValueObjectInterface
{
    /** @var StringLiteral */
    protected StringLiteral $name;

    /** @var StringLiteral */
    protected StringLiteral $number;

    /** @var StringLiteral Building, floor and unit */
    protected StringLiteral $elements;

    /**
     * @var StringLiteral __toString() format
     * Use properties corresponding placeholders: %name%, %number%, %elements%
     */
    protected StringLiteral $format;

    /**
     * Returns a new Street from native PHP string name and number.
     *
     * @param string $name
     * @param string $number
     * @param string $elements
     *
     * @return Street
     * @throws BadFunctionCallException
     */
    public static function fromNative(): self
    {
        $args = func_get_args();

        if (count($args) < 2) {
            throw new BadMethodCallException(
                'You must provide from 2 to 4 arguments: 1) street name, 2) street number, 3) elements, 4) format (optional)'
            );
        }

        $nameString = $args[0];
        $numberString = $args[1];
        $elementsString = isset($args[2]) ? $args[2] : null;
        $formatString = isset($args[3]) ? $args[3] : null;

        $name = new StringLiteral($nameString);
        $number = new StringLiteral($numberString);
        $elements = $elementsString ? new StringLiteral($elementsString) : null;
        $format = $formatString ? new StringLiteral($formatString) : null;

        return new static($name, $number, $elements, $format);
    }

    /**
     * Returns a new Street object
     *
     * @param StringLiteral      $name
     * @param StringLiteral      $number
     * @param StringLiteral|null $elements
     * @param StringLiteral|null $format
     */
    public function __construct(
        StringLiteral $name,
        StringLiteral $number,
        StringLiteral $elements = null,
        StringLiteral $format = null
    ) {
        $this->name = $name;
        $this->number = $number;

        if ($elements === null) {
            $elements = new StringLiteral('');
        }
        $this->elements = $elements;

        if ($format === null) {
            $format = new StringLiteral('%number% %name%');
        }
        $this->format = $format;
    }

    /**
     * Tells whether two Street objects are equal
     *
     * @param ValueObjectInterface $street
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $street): bool
    {
        if (false === Util::classEquals($this, $street)) {
            return false;
        }

        return $this->getName()->sameValueAs($street->getName()) &&
            $this->getNumber()->sameValueAs($street->getNumber()) &&
            $this->getElements()->sameValueAs($street->getElements());
    }

    /**
     * Returns street name
     *
     * @return StringLiteral
     */
    public function getName(): StringLiteral
    {
        return clone $this->name;
    }

    /**
     * Returns street number
     *
     * @return StringLiteral
     */
    public function getNumber(): StringLiteral
    {
        return clone $this->number;
    }

    /**
     * Returns street elements
     * @return StringLiteral
     */
    public function getElements(): StringLiteral
    {
        return clone $this->elements;
    }

    /**
     * Returns a string representation of the StringLiteral in the format defined in the constructor
     *
     * @return string
     */
    public function __toString(): string
    {
        $replacements = [
            "%name%" => $this->getName(),
            "%number%" => $this->getNumber(),
            "%elements%" => $this->getElements(),
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $this->format);
    }
}
