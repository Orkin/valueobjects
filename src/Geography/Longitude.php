<?php

declare(strict_types=1);

namespace ValueObjects\Geography;

use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Real;

class Longitude extends Real
{
    /**
     * Returns a new Longitude object
     *
     * @param $value
     *
     * @throws InvalidNativeArgumentException
     */
    public function __construct(float $value)
    {
        // normalization process through Coordinate object
        $coordinate = new BaseCoordinate([0, $value]);
        $longitude = $coordinate->getLongitude();

        parent::__construct($longitude);
    }
}
