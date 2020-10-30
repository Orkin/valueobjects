<?php

declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\Exception\InvalidNativeArgumentException;
use Laminas\Validator\Hostname as Validator;

class Hostname extends Domain
{
    /**
     * Returns a Hostname
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $validator = new Validator(['allow' => Validator::ALLOW_DNS | Validator::ALLOW_LOCAL]);

        if (false === $validator->isValid($value)) {
            throw new InvalidNativeArgumentException($value, ['string (valid hostname)']);
        }

        parent::__construct($value);
    }
}
