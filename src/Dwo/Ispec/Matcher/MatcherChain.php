<?php

namespace Dwo\Ispec\Matcher;

use Dwo\Ispec\Model\IpInfo;

/**
 * Class MatcherChain
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class MatcherChain implements IpInfoMatcherInterface
{
    /**
     * @var IpInfoMatcherInterface[]
     */
    private $matcher;

    /**
     * @param IpInfoMatcherInterface[] $matcher
     */
    public function __construct(array $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * {@inheritdoc}
     */
    public function isMatching(IpInfo $ipInfo, IpInfo $ipInfoSecond)
    {
        $count = 0;

        foreach ($this->matcher as $matcher) {
            if ($matcher->isMatching($ipInfo, $ipInfoSecond)) {
                $count++;
            } else {
                break;
            }
        }

        return $count > 0 && count($this->matcher) === $count;
    }
}
