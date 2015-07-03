<?php

namespace Dwo\Ispec\Model;

/**
 * Interface IpInfoFindAllManager
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface IpInfoFindAllManagerInterface
{
    /**
     * @return IpInfo[]
     */
    public function findAll();

    /**
     * @param string $key
     *
     * @return IpInfo[]
     */
    public function findAllByKey($key);
}
