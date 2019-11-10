<?php

namespace App\Router\Domain\Value;

use App\Router\Domain\Value\Exception\InvalidIPv4Address;
use IPLib\Address\IPv4;

class IpAddress
{
    /** @var IPv4|null */
    private $address;

    /**
     * @param string $ipAddress
     * @throws InvalidIPv4Address
     */
    public function __construct(string $ipAddress)
    {
        $address = IPv4::fromString($ipAddress);

        if ($address === null) {
            throw new InvalidIPv4Address(sprintf('%s is not a valid IPv4 address', $ipAddress));
        }

        $this->address = $address;
    }

    /**
     * @return IPv4
     */
    public function address(): IPv4
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->address->toString();
    }
}
