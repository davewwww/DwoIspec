<?php

namespace Dwo\Ispec\Finder;

use Dwo\Ispec\Factory\IpInfoFactory;
use Dwo\Ispec\Helper\IpHelper;
use Dwo\Ispec\Matcher\IpInfoMatcherInterface;
use Dwo\Ispec\Model\IpInfo;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;

/**
 * Class IpInfoFinder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpInfoFinder implements IpInfoFinderInterface
{
    /**
     * @var IpInfoFindAllManagerInterface
     */
    private $manager;

    /**
     * @var IpInfoMatcherInterface
     */
    private $matcher;

    /**
     * @param IpInfoFindAllManagerInterface $manager
     * @param IpInfoMatcherInterface        $matcher
     */
    public function __construct(IpInfoFindAllManagerInterface $manager, IpInfoMatcherInterface $matcher)
    {
        $this->manager = $manager;
        $this->matcher = $matcher;
    }

    /**
     * {@inheritdoc}
     */
    public function findByIp($ip)
    {
        $ipInfoOrigin = IpInfoFactory::create(array('ip' => $ip));

        $key = IpHelper::createIpKey($ipInfoOrigin->ip);
        if (null === $ipInfo = $this->findAndMatch($ipInfoOrigin, $key)) {

            $keyFirst = IpHelper::createIpKey($ipInfoOrigin->ip, true);
            if ($key !== $keyFirst) {
                $ipInfo = $this->findAndMatch($ipInfoOrigin, $keyFirst);
            }
        }

        return $ipInfo;
    }

    /**
     * @param IpInfo $ipInfoOrigin
     * @param string $key
     *
     * @return IpInfo|null
     */
    private function findAndMatch(IpInfo $ipInfoOrigin, $key)
    {
        foreach ($this->manager->findAllByKey($key) as $ipInfo) {
            if ($this->matcher->isMatching($ipInfoOrigin, $ipInfo)) {
                return $ipInfo;
            }
        }

        return null;
    }
}
