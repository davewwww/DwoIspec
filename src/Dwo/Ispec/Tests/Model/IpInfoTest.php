<?php

namespace Dwo\Ispec\Tests\Model;

use Dwo\Ispec\Model\IpInfo;

class IpInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testPropertiesExists()
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = '1.2.3.4';
        $ipInfo->subnet = '1.2.3.4/12';
    }

    public function testToArray()
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = '1.2.3.4';
        $ipInfo->subnet = '1.2.3.4/12';

        self::assertEquals(
            array(
                'ip'     => '1.2.3.4',
                'subnet' => '1.2.3.4/12',
            ),
            $ipInfo->toArray()
        );
    }
}