<?php

namespace AppTest\Router\Unit\Domain\Value;

use App\Router\Domain\Value\Exception\InvalidIPv4Address;
use App\Router\Domain\Value\IpAddress;
use PHPUnit\Framework\TestCase;

class IpAddressTest extends TestCase
{
    public function testConstructWhenValid()
    {
        $test = '127.0.0.1';

        $ipAddress = new IpAddress($test);
        $this->assertEquals($test, $ipAddress->__toString());
    }

    public function testConstructWhenInvalid()
    {
        $test = '33.33.33';
        $ipAddress = null;
        $errorMessage = null;

        try {
            $ipAddress = new IpAddress($test);
        } catch (InvalidIPv4Address $exception) {
            $errorMessage = $exception->getMessage();
        }

        $this->assertNull($ipAddress);
        $this->assertEquals(sprintf('%s is not a valid IPv4 address', $test), $errorMessage);
    }
}
