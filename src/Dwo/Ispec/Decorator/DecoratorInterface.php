<?php

namespace Dwo\Ispec\Decorator;

use Dwo\Ispec\Model\IpInfo;

/**
 * Interface Decorator
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface DecoratorInterface
{
    /**
     * @param IpInfo $ipInfo
     * @param bool   $overwrite
     *
     * @return IpInfo
     */
    public function decorate(IpInfo $ipInfo, $overwrite = false);
}
