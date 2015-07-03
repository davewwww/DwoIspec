<?php

namespace Dwo\Ispec\Matcher;

use Dwo\Ispec\Model\IpInfo;
use IpUtils\Factory;

/**
 * Class SubnetMatcher
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class SubnetMatcher implements IpInfoMatcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function isMatching(IpInfo $ipInfo, IpInfo $ipInfoSecond)
    {
        $expression = Factory::getExpression($ipInfoSecond->subnet);

        return $expression->matches(Factory::getAddress($ipInfo->ip));
    }
}
