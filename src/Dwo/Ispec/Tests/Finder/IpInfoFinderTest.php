<?php

namespace Dwo\Ispec\Tests\Finder;

use Dwo\Ispec\Finder\IpInfoFinder;
use Dwo\Ispec\Matcher\IpInfoMatcherInterface;
use Dwo\Ispec\Model\IpInfo;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;

class IpInfoFinderTest extends \PHPUnit_Framework_TestCase
{
    public function testFindByIpAtFirstTry()
    {
        $manager = $this->mockManager();
        $matcher = $this->mockMatcher();

        $ipInfo = new IpInfo();
        $ipInfo->asn = '1';

        $manager->expects(self::once())
            ->method('findAllByKey')
            ->with('1.2')
            ->willReturn(array($ipInfo));

        $matcher->expects(self::once())
            ->method('isMatching')
            ->willReturn(true);

        $finder = new IpInfoFinder($manager, $matcher);
        $result = $finder->findByIp('1.2.3.4');

        self::assertEquals($ipInfo, $result);
    }

    public function testFindByIpAtSecondTry()
    {
        $manager = $this->mockManager();
        $matcher = $this->mockMatcher();

        $ipInfo = new IpInfo();
        $ipInfo->asn = '1';
        $ipInfo2 = new IpInfo();
        $ipInfo2->asn = '2';

        $manager->expects(self::exactly(2))
            ->method('findAllByKey')
            ->withConsecutive(array('1.2'), array('1'))
            ->will(self::onConsecutiveCalls(array($ipInfo), array($ipInfo2)));

        $matcher->expects(self::exactly(2))
            ->method('isMatching')
            ->will(self::onConsecutiveCalls(false, true));

        $finder = new IpInfoFinder($manager, $matcher);
        $result = $finder->findByIp('1.2.3.4');

        self::assertEquals($ipInfo2, $result);
    }

    public function testFindByIpNothingMatches()
    {
        $manager = $this->mockManager();
        $matcher = $this->mockMatcher();

        $ipInfo = new IpInfo();
        $ipInfo->asn = '1';

        $manager->expects(self::exactly(2))
            ->method('findAllByKey')
            ->withConsecutive(array('1.2'), array('1'))
            ->will(self::onConsecutiveCalls(array($ipInfo), array($ipInfo)));

        $matcher->expects(self::exactly(2))
            ->method('isMatching')
            ->will(self::onConsecutiveCalls(false, false));

        $finder = new IpInfoFinder($manager, $matcher);
        $result = $finder->findByIp('1.2.3.4');

        self::assertNull($result);
    }

    public function testFindByIpFoundNoIpInfos()
    {
        $manager = $this->mockManager();
        $matcher = $this->mockMatcher();

        $manager->expects(self::exactly(2))
            ->method('findAllByKey')
            ->withConsecutive(array('1.2'), array('1'))
            ->will(self::onConsecutiveCalls(array(), array()));

        $matcher->expects(self::never())
            ->method('isMatching');

        $finder = new IpInfoFinder($manager, $matcher);
        $result = $finder->findByIp('1.2.3.4');

        self::assertNull($result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|IpInfoMatcherInterface
     */
    private function mockMatcher()
    {
        return $this->getMockBuilder('Dwo\Ispec\Matcher\IpInfoMatcherInterface')
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|IpInfoFindAllManagerInterface
     */
    private function mockManager()
    {
        return $this->getMockBuilder('Dwo\Ispec\Model\IpInfoFindAllManagerInterface')
            ->getMock();
    }
}