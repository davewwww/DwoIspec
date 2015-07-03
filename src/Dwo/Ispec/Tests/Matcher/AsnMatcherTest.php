<?php

namespace Dwo\Ispec\Tests\Helper;

use Dwo\Ispec\Matcher\AsnMatcher;
use Dwo\Ispec\Model\IpInfo;

class AsnMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testAsnMatches($result, $asnOne, $asnSecond)
    {
        $ipInfo = new IpInfo();
        $ipInfo->asn = $asnOne;
        $ipInfoSecond = new IpInfo();
        $ipInfoSecond->asn = $asnSecond;

        self::assertEquals($result, (new AsnMatcher())->isMatching($ipInfo, $ipInfoSecond));
    }

    public function provider()
    {
        return array(
            array(true, '123', '123'),
            array(false, '123', '456'),
        );
    }
}