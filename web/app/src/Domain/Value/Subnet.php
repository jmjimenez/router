<?php

namespace App\Router\Domain\Value;

use App\Router\Domain\Value\Exception\InvalidIPv4Subnet;

class Subnet
{
    /** @var \IPLib\Range\Subnet|null  */
    private $subnet;

    public function __construct(string $subnet)
    {
        $range = \IPLib\Range\Subnet::fromString($subnet);

        if ($range === null) {
            throw new InvalidIPv4Subnet(sprintf('%s is not a valid subnet', $subnet));
        }

        $this->subnet = $range;
    }

    /**
     * @return \IPLib\Range\Subnet
     */
    public function subnet(): \IPLib\Range\Subnet
    {
        return $this->subnet;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->subnet->toString();
    }
}
