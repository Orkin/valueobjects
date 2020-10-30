<?php

declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\StringLiteral\StringLiteral;
use function preg_match;

class FragmentIdentifier extends StringLiteral implements FragmentIdentifierInterface
{
    /**
     * Returns a new FragmentIdentifier
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (0 === preg_match('/^#[?%!$&\'()*+,;=a-zA-Z0-9-._~:@\/]*$/', $value)) {
            throw new InvalidNativeArgumentException($value, array('string (valid fragment identifier)'));
        }

        parent::__construct($value);
    }
}
