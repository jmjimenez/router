<?php

namespace AppTest\Router\Unit\Domain\Aggregate;

use App\Router\Domain\Aggregate\Router;
use App\Router\Domain\Value\Exception\InvalidIPv4Address;
use App\Router\Domain\Value\Exception\InvalidIPv4Subnet;
use App\Router\Domain\Value\IpAddress;
use App\Router\Domain\Value\Subnet;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @dataProvider getGatewayForIpAddressWhenSingleRouteDataProvider
     * @param string $ipAddress
     * @param string $expectedGateway
     * @throws InvalidIPv4Address
     * @throws InvalidIPv4Subnet
     */
    public function testGetGatewayForIpAddressWhenSingleRoute(string $ipAddress, string $expectedGateway)
    {
        $subnet = '192.168.1.0/24';
        $gateway = '172.16.0.1';

        $router = new Router();

        $router->addRoute(new Subnet($subnet), new IpAddress($gateway));

        $this->assertEquals($expectedGateway, $router->getGatewayForIpAddress(new IpAddress($ipAddress)));
    }

    public function getGatewayForIpAddressWhenSingleRouteDataProvider(): array
    {
        return [
            [ '192.168.1.1', '172.16.0.1' ],
            [ '192.168.2.1', '' ],
        ];
    }

    /**
     * @dataProvider getGatewayForIpAddressWhenManyRoutesDataProvider
     * @param string $ipAddress
     * @param string $expectedGateway
     * @throws InvalidIPv4Address
     * @throws InvalidIPv4Subnet
     */
    public function testGetGatewayForIpAddressWhenManyRoutes(string $ipAddress, string $expectedGateway)
    {
        $routes = [
            [ '192.168.1.0/24', '172.16.1.1' ],
            [ '10.0.0.0/8', '62.3.56.121' ],
            [ '192.168.0.0/16', '172.17.1.1'],
        ];

        $router = new Router();

        foreach ($routes as $route) {
            $router->addRoute(new Subnet($route[0]), new IpAddress($route[1]));
        }

        $this->assertEquals($expectedGateway, $router->getGatewayForIpAddress(new IpAddress($ipAddress)));
    }

    public function getGatewayForIpAddressWhenManyRoutesDataProvider(): array
    {
        return [
            [ '192.168.1.1', '172.16.1.1' ],
            [ '10.1.2.1', '62.3.56.121' ],
            [ '192.168.2.1', '172.17.1.1'],
            [ '11.1.1.1', ''],
            [ '192.169.1.1', ''],
        ];
    }
}
