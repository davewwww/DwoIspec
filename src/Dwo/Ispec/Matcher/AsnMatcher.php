<?php

namespace Dwo\Ispec\Matcher;

use Dwo\Ispec\Model\IpInfo;

/**
 * Class AsnMatcher
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class AsnMatcher implements IpInfoMatcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function isMatching(IpInfo $ipInfo, IpInfo $ipInfoSecond)
    {
        return $ipInfo->asn === $ipInfoSecond->asn;
    }
}
