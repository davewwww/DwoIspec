<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Helper\IpRangeHelper;
use Dwo\Ispec\Matcher\IpLongMatcher;
use Dwo\Ispec\Model\IpInfo;

class IpLongMatcherTest extends \PHPUnit_Framework_TestCase
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
        $range = IpRangeHelper::getIpRangeForSubnet($subnet);
        $ipInfoSubnet->ip_from = ip2long($range[0]);
        $ipInfoSubnet->ip_to= ip2long($range[1]);

        self::assertEquals($result, (new IpLongMatcher())->isMatching($ipInfo, $ipInfoSubnet));
    }

    public function ipIpInSubnetProvider()
    {
        return array(
            array(true, '1.2.3.4', '1.2.3.4/12'),
            array(false, '2.2.3.4', '1.2.3.4/12'),

            array(true, '65.28.123.0', '65.28.123.31/24'),
            array(true, '65.28.123.255', '65.28.123.31/24'),
            array(false, '65.28.122.255', '65.28.123.31/24'),
            array(false, '65.28.124.0', '65.28.123.31/24'),
        );
    }
}