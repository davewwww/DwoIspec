<?php

namespace Dwo\Ispec\Matcher;

use Dwo\Ispec\Model\IpInfo;

/**
 * Interface IpInfoMatcher
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface IpInfoMatcherInterface
{
    /**
     * @param IpInfo $ipInfo
     * @param IpInfo $ipInfoSecond
     *
     * @return bool
     */
    public function isMatching(IpInfo $ipInfo, IpInfo $ipInfoSecond);
}
