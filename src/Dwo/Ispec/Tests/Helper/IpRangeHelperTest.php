<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Helper\IpRangeHelper;

class IpRangeHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIps
     */
    public function testCreateIpKey($expects, $ip)
    {
        self::assertEquals($expects, IpRangeHelper::getIpRangeForSubnet($ip));
    }

    public function testGetSomeIpsFromRange()
    {
        $ips = IpRangeHelper::getSomeIpsFromRange('127.0.0.1/16');
        self::assertEquals('127.0.64.0', $ips[0]);
        self::assertEquals('127.0.128.0', $ips[1]);
        self::assertEquals('127.0.192.0', $ips[2]);
    }

    public function providerIps()
    {
        return array(
            array(array('127.0.0.0', '127.0.0.3'), '127.0.0.1/30'),
            array(array('127.0.0.0', '127.0.255.255'), '127.0.0.1/16'),
            array(array('127.0.0.0', '127.255.255.255'), '127.0.0.1/8'),
            array(array('64.0.0.0', '127.255.255.255'), '127.0.0.1/2'),
        );
    }
}