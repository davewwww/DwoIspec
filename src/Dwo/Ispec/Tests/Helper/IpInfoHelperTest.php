<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Helper\IpInfoHelper;
use Dwo\Ispec\Model\IpInfo;

class IpInfoHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testGetIp()
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = '1.2.3.4';

        self::assertEquals('1.2.3.4', IpInfoHelper::getIp($ipInfo));
    }

    public function testGetIpFromSubnet()
    {
        $ipInfo = new IpInfo();
        $ipInfo->subnet = '1.2.3.4/12';

        self::assertEquals('1.2.3.4', IpInfoHelper::getIp($ipInfo));
    }

    /**
     * @expectedException \Dwo\Ispec\Exception\IspecException
     */
    public function testGetIpAllEmpty()
    {
        IpInfoHelper::getIp(new IpInfo());
    }

    /**
     * @dataProvider ipIpInSubnetProvider
     */
    public function testIsIpInSubnets($result, $ip, $entries)
    {
        self::assertEquals($result, IpInfoHelper::isIpInSubnets($ip, $entries));
    }

    public function ipIpInSubnetProvider()
    {
        $ipInfo1 = new IpInfo();
        $ipInfo1->subnet = '1.2.3.4/12';
        $ipInfo2 = new IpInfo();
        $ipInfo2->subnet = '2.2.3.4/12';

        return array(
            array(true, '1.2.3.4', array($ipInfo1)),
            array(false, '2.2.3.4', array($ipInfo1)),
            array(true, '2.2.3.4', array($ipInfo1, $ipInfo2)),
            array(false, '2.2.3.4', array()),
        );
    }

    /**
     * @dataProvider ipSubnetProvider
     */
    public function testGetSubnet($result, $data)
    {
        self::assertEquals($result, IpInfoHelper::getSubnet($data));
    }

    public function ipSubnetProvider()
    {
        $ipInfo = new IpInfo();
        $ipInfo->subnet = '1.2.3.4/12';

        return array(
            array('1.2.3.4/12', $ipInfo),
            array('1.2.3.4/12', array('subnet' => $ipInfo->subnet)),
        );
    }

    /**
     * @expectedException \Dwo\Ispec\Exception\IspecException
     */
    public function testGetSubnetInvalidData()
    {
        IpInfoHelper::getSubnet(null);
    }
}