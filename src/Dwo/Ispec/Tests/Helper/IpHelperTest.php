<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Helper\IpHelper;

class IpHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIps
     */
    public function testCreateIpKey($result, $ip, $returnFirstKey = false)
    {
        self::assertTrue($result === IpHelper::createIpKey($ip, $returnFirstKey), $result.' === '.$ip);
    }

    /**
     * @expectedException \Dwo\Ispec\Exception\IspecException
     * @expectedExceptionMessageRegExp /invalid ip/
     */
    public function testCreateIpKeyWithInvalidIp1()
    {
        IpHelper::createIpKey('');
    }

    /**
     * @expectedException \Dwo\Ispec\Exception\IspecException
     * @expectedExceptionMessageRegExp /invalid ip/
     */
    public function testCreateIpKeyWithInvalidIp2()
    {
        IpHelper::createIpKey('1');
    }

    public function providerIps()
    {
        return array(
            array('1.0', '1.0.0.1'),
            array('127.0', '127.0.0.1'),
            array('127.255', '127.255.0.1'),
            array('1.0', '1.0.0.1/24'),
            array('127.0', '127.0.0.1/24'),
            array('127.255', '127.255.0.1/24'),
            array('1', '1.0.0.1/15'),
            array('127', '127.0.0.1/15'),
            array('127', '127.255.0.1/15'),
            array('1', '1.0.0.1/24', true),
            array('127', '127.0.0.1/24', true),
            array('127', '127.255.0.1/24', true),
        );
    }
}