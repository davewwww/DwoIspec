<?php

namespace Dwo\Ispec\Tests\Decorator;

use Dwo\Ispec\Factory\IpInfoFactory;

class IpInfoFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEmpty()
    {
        $ipInfo = IpInfoFactory::create();

        self::assertInstanceOf('Dwo\Ispec\Model\IpInfo', $ipInfo);
    }

    public function testCreateWithData()
    {
        $ipInfo = IpInfoFactory::create(
            $array = array(
                'ip'  => '1.2.3.4',
                'isp' => 'foobar',
            )
        );

        self::assertEquals($array['ip'], $ipInfo->ip);
        self::assertEquals($array['isp'], $ipInfo->isp);
    }
}