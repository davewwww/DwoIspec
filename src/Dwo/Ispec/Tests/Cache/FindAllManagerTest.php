<?php

namespace Dwo\Ispec\Tests\Cache;

use Dwo\Ispec\Cache\FindAllManager;
use Dwo\Ispec\Model\IpInfo;

class FindAllManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider provider
     */
    public function test($expect, $key)
    {
        $manager = new FindAllManager($this->fixtures());
        $ipInfos = $manager->findAllByKey($key);

        if (null === $expect) {
            self::assertCount(0, $ipInfos);
        } else {
            if (!is_array($expect)) {
                $expect = array($expect);
            }
            $asns = [];
            foreach ($ipInfos as $ipInfo) {
                $asns[] = $ipInfo->asn;
            }
            self::assertEquals($expect, $asns);
        }
    }

    public function provider()
    {
        return array(
            array(['1', '2'], '30.50'),
            array(null, '30'),
            array(['3'], '170.100'),
            array(null, '170'),
            array(null, '66.0'),
            array(['4'], '66'),
            array(null, '88.88'),
            array(null, '88'),
        );
    }

    private function fixtures()
    {

        $ipInfo1 = new IpInfo();
        $ipInfo1->ip = $ip = '30.50.50.128';
        $ipInfo1->subnet = $ip.'/25';
        $ipInfo1->asn = '1';

        $ipInfo2 = new IpInfo();
        $ipInfo2->ip = $ip = '30.50.10.128';
        $ipInfo2->subnet = $ip.'/25';
        $ipInfo2->asn = '2';

        $ipInfo3 = new IpInfo();
        $ipInfo3->ip = $ip = '170.100.0.0';
        $ipInfo3->subnet = $ip.'/16';
        $ipInfo3->asn = '3';

        $ipInfo4 = new IpInfo();
        $ipInfo4->ip = $ip = '66.0.0.0';
        $ipInfo4->subnet = $ip.'/12';
        $ipInfo4->asn = '4';

        return array(
            $ipInfo1,
            $ipInfo2,
            $ipInfo3,
            $ipInfo4,
        );
    }
}