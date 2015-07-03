<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Matcher\SubnetMatcher;
use Dwo\Ispec\Model\IpInfo;

class SubnetMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider ipIpInSubnetProvider
     */
    public function testIsIpInSubnets($result, $ip, $subnet)
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = $ip;
        $ipInfoSubnet = new IpInfo();
        $ipInfoSubnet->subnet = $subnet;

        self::assertEquals($result, (new SubnetMatcher())->isMatching($ipInfo, $ipInfoSubnet));
    }

    public function ipIpInSubnetProvider()
    {
        return array(
            array(true, '1.2.3.4', '1.2.3.4/12'),
            array(false, '2.2.3.4', '1.2.3.4/12'),
        );
    }
}