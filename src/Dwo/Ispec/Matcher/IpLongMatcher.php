<?php

namespace Dwo\Ispec\Matcher;

use Dwo\Ispec\Exception\IspecException;
use Dwo\Ispec\Helper\IpRangeHelper;
use Dwo\Ispec\Model\IpInfo;

/**
 * Class IpLongMatcher
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpLongMatcher implements IpInfoMatcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function isMatching(IpInfo $ipInfo, IpInfo $ipInfoSecond)
    {
        if (null === $ipInfoSecond->ip_from || null === $ipInfoSecond->ip_to) {
            if(null === $ipInfoSecond->subnet) {
                throw new IspecException('ip informations are empty in IpLongMatcher');
            }
            $range = IpRangeHelper::getIpRangeForSubnet($ipInfoSecond->subnet);
            $ipInfoSecond->ip_from = ip2long($range[0]);
            $ipInfoSecond->ip_to = ip2long($range[1]);
        }

        $ip = ip2long($ipInfo->ip);

        return $ip >= $ipInfoSecond->ip_from && $ip <= $ipInfoSecond->ip_to;
    }
}
