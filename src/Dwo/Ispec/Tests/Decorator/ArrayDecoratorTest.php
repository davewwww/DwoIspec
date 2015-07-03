<?php

namespace Dwo\Ispec\Tests\Decorator;

use Dwo\Ispec\Decorator\ArrayDecorator;
use Dwo\Ispec\Model\IpInfo;

class ArrayDecoratorTest extends \PHPUnit_Framework_TestCase
{
    public function testDecorate()
    {
        $decorator = new ArrayDecorator(
            $array = array(
                'ip'  => '1.2.3.4',
                'isp' => 'foobar',
            )
        );
        $decorator->decorate($ipInfo = new IpInfo());

        self::assertEquals($array['ip'], $ipInfo->ip);
        self::assertEquals($array['isp'], $ipInfo->isp);
    }

    public function testDecorateWithEmptyDecorator()
    {
        $decorator = new ArrayDecorator(array());
        $decorator->decorate($ipInfo = new IpInfo());

        self::assertNull($ipInfo->ip);
        self::assertNull($ipInfo->isp);
    }

    public function testDecorateWithEmptyDecorateData()
    {
        $decorator = new ArrayDecorator(
            array(
                'ip'  => '',
                'isp' => null,
            )
        );
        $decorator->decorate($ipInfo = new IpInfo());

        self::assertNull($ipInfo->ip);
        self::assertNull($ipInfo->isp);
    }

    public function testDecorateNoOverwrite()
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = '1.1.1.1';

        $decorator = new ArrayDecorator(
            array(
                'ip' => '1.2.3.4'
            )
        );
        $decorator->decorate($ipInfo);

        self::assertEquals('1.1.1.1', $ipInfo->ip);
    }

    public function testDecorateOverwrite()
    {
        $ipInfo = new IpInfo();
        $ipInfo->ip = '1.1.1.1';

        $decorator = new ArrayDecorator(
            array(
                'ip' => '1.2.3.4'
            )
        );
        $decorator->decorate($ipInfo, true);

        self::assertEquals('1.2.3.4', $ipInfo->ip);
    }
}