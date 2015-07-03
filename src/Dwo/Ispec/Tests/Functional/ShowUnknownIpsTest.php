<?php

namespace Dwo\Ispec\Tests\Functional;

use Dwo\Ispec\Cache\FindAllManager;
use Dwo\Ispec\Factory\IpInfoFactory;
use Dwo\Ispec\Finder\IpInfoFinder;
use Dwo\Ispec\Matcher\SubnetMatcher;
use Dwo\Ispec\Model\IpInfo;

/**
 * Class ShowUnknownIpsTest
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class ShowUnknownIpsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private static $ips = array(
        '62.177.128.0/20',
        '82.204.0.0/18',
        '95.36.0.0/16',
        '202.150.0.0/28',
    );

    /**
     * @dataProvider provider
     */
    public function test($result, $ip)
    {
        $manager = new FindAllManager($this->createIpInfosFromSubnet(self::$ips));
        $matcher = new SubnetMatcher();
        $finder = new IpInfoFinder($manager, $matcher);
        $ipInfo = $finder->findByIp($ip);

        if (null === $result) {
            self::assertNull($ipInfo, $ip);
        } else {
            self::assertEquals($result, $ipInfo->subnet, $ip);
        }
    }

    public function provider()
    {
        return array(
            array(self::$ips[0], '62.177.128.0'),
            array(self::$ips[0], '62.177.135.162'),
            array(self::$ips[0], '62.177.143.200'),
            array(null, '62.178.145.0'),
            array(self::$ips[2], '95.36.0.0'),
            array(self::$ips[2], '95.36.127.127'),
            array(self::$ips[2], '95.36.255.255'),
            array(null, '95.37.0.0'),
            array(self::$ips[3], '202.150.0.1'),
            array(self::$ips[3], '202.150.0.10'),
            array(null, '202.150.0.16'),
            array(null, '216.39.58.17'),
            array(null, '217.146.191.18'),
            array(null, '98.139.134.97'),
            array(null, '178.65.210.178'),
        );
    }

    /**
     * @return IpInfo[]
     */
    private function createIpInfosFromSubnet(array $subnets)
    {
        $ipinfos = array();
        foreach ($subnets as $subnet) {
            $ipinfos[] = IpInfoFactory::create(array('subnet' => $subnet));
        }

        return $ipinfos;
    }
}
