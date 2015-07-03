<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Matcher\AsnMatcher;
use Dwo\Ispec\Matcher\IpInfoMatcherInterface;
use Dwo\Ispec\Matcher\MatcherChain;
use Dwo\Ispec\Model\IpInfo;

class MatcherChainTest extends \PHPUnit_Framework_TestCase
{
    public function testAllTrue()
    {
        $ipInfo = $ipInfoSecond = new IpInfo();

        $matcher1 = $this->mockMatcher();
        $matcher1->expects(self::once())
            ->method('isMatching')
            ->with($ipInfo, $ipInfoSecond)
            ->willReturn(true);

        $matcher2 = $this->mockMatcher();
        $matcher2->expects(self::once())
            ->method('isMatching')
            ->with($ipInfo, $ipInfoSecond)
            ->willReturn(true);

        $matcherChain = new MatcherChain(array($matcher1, $matcher2));

        self::assertTrue($matcherChain->isMatching($ipInfo, $ipInfoSecond));
    }

    public function testOneFalse()
    {
        $ipInfo = $ipInfoSecond = new IpInfo();

        $matcher1 = $this->mockMatcher();
        $matcher1->expects(self::once())
            ->method('isMatching')
            ->with($ipInfo, $ipInfoSecond)
            ->willReturn(true);

        $matcher2 = $this->mockMatcher();
        $matcher2->expects(self::once())
            ->method('isMatching')
            ->with($ipInfo, $ipInfoSecond)
            ->willReturn(false);

        $matcherChain = new MatcherChain(array($matcher1, $matcher2));

        self::assertFalse($matcherChain->isMatching($ipInfo, $ipInfoSecond));
    }

    public function testNoMatchers()
    {
        $ipInfo = $ipInfoSecond = new IpInfo();

        $matcherChain = new MatcherChain(array());

        self::assertFalse($matcherChain->isMatching($ipInfo, $ipInfoSecond));
    }


    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|IpInfoMatcherInterface
     */
    private function mockMatcher() {
        return $this->getMockBuilder('Dwo\Ispec\Matcher\IpInfoMatcherInterface')
            ->getMock();
    }
}