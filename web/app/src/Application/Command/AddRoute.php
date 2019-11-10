<?php

namespace App\Router\Application\Command;

use App\Router\Domain\Value\IpAddress;
use App\Router\Domain\Value\Subnet;

class AddRoute
{
    /** @var Subnet */
    private $subnet;

    /** @var IpAddress */
    private $gateway;

    public function __construct(string $ipAddress, string $netmask, string $gateway)
    {
        $this->subnet = new Subnet(sprintf('%s/%s', trim($ipAddress), trim($netmask)));
        $this->gateway = new IpAddress($gateway);
    }

    public function subnet(): Subnet
    {
        return $this->subnet;
    }

    public function gateway(): IpAddress
    {
        return $this->gateway;
    }
}
