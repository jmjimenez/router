<?php

namespace App\Router\Domain\Aggregate;

use App\Router\Domain\Value\Subnet;
use App\Router\Domain\Value\IpAddress;

class Router
{
    private $routes = [];

    /**
     * @param Subnet $netmask
     * @param IpAddress $gateway
     */
    public function addRoute(Subnet $netmask, IpAddress $gateway): void
    {
        $this->routes[] = [$netmask, $gateway];
    }

    /**
     * @param IpAddress $ipAddress
     * @return string|null
     */
    public function getGatewayForIpAddress(IpAddress $ipAddress): ?string
    {
        foreach ($this->routes as $route) {
            /** @var Subnet $subnet */
            $subnet = $route[0];
            /** @var IpAddress $gateway */
            $gateway = $route[1];

            if ($subnet->subnet()->contains($ipAddress->address())) {
                return $gateway->__toString();
            }
        }

        return null;
    }
}
