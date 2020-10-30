<?php

declare(strict_types=1);

namespace ValueObjects\Geography;

use League\Geotools\Coordinate\Coordinate as BaseCoordinate;
use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\Number\Real;

class Latitude extends Real
{
    /**
     * Returns a new Latitude object
     *
     * @param $value
     *
     * @throws InvalidNativeArgumentException
     */
    public function __construct(float $value)
    {
        // normalization process through Coordinate object
        $coordinate = new BaseCoordinate([$value, 0]);
        $latitude = $coordinate->getLatitude();

        parent::__construct($latitude);
    }
}
