<?php

namespace AppTest\Router\Unit\Domain\Value;

use App\Router\Domain\Value\Exception\InvalidIPv4Subnet;
use App\Router\Domain\Value\Subnet;
use PHPUnit\Framework\TestCase;

class SubnetTest extends TestCase
{
    public function testConstructWhenValid()
    {
        $test = '127.0.0.0/24';

        $subnet = new Subnet($test);
        $this->assertEquals($test, $subnet->__toString());
    }

    public function testConstructWhenInvalid()
    {
        $test = '127.0.0.1';
        $subnet = null;
        $errorMessage = null;

        try {
            $subnet = new Subnet($test);
        } catch (InvalidIPv4Subnet $exception) {
            $errorMessage = $exception->getMessage();
        }

        $this->assertNull($subnet);
        $this->assertEquals(sprintf('%s is not a valid subnet', $test), $errorMessage);
    }
}
