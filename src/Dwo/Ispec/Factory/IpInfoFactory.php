<?php

namespace Dwo\Ispec\Factory;

use Dwo\Ispec\Decorator\ArrayDecorator;
use Dwo\Ispec\Model\IpInfo;

/**
 * Class IpInfoFactory
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpInfoFactory
{
    /**
     * @param array $array
     *
     * @return IpInfo
     */
    public static function create(array $array = array())
    {
        $ipInfo = new IpInfo();

        if (!empty($array)) {
            (new ArrayDecorator($array))->decorate($ipInfo);
        }

        return $ipInfo;
    }
}
