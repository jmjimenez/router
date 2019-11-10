<?php

namespace App\Router\Application\Command;

use App\Router\Domain\Value\IpAddress;

class GetGateway
{
    /** @var IpAddress */
    private $ipAddress;

    public function __construct(string $ipAddress)
    {
        $this->ipAddress = new IpAddress($ipAddress);
    }

    public function ipAddress(): IpAddress
    {
        return $this->ipAddress;
    }
}
