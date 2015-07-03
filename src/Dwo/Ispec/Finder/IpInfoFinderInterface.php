<?php

namespace Dwo\Ispec\Finder;

use Dwo\Ispec\Model\IpInfo;

/**
 * Interface IpInfoFinder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface IpInfoFinderInterface
{
    /**
     * @param string $ip
     *
     * @return IpInfo|null
     */
    public function findByIp($ip);
}
