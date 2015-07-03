<?php

namespace Dwo\Ispec\Model;

/**
 * Interface IpInfoManager
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface IpInfoManagerInterface extends IpInfoFindAllManagerInterface
{
    /**
     * @param string $id
     * @param string $subnet
     *
     * @return IpInfo
     */
    public function findEntryByIdAndSubnet($id, $subnet);

    /**
     * @param string $id
     *
     * @return IpInfo[]
     */
    public function findAllSubnetsForIsp($id);

    /**
     * @param string $subnet
     *
     * @return IpInfo
     */
    public function findOneBySubnet($subnet);

    /**
     * @param IpInfo $ipInfo
     */
    public function saveIpInfo(IpInfo $ipInfo);

    /**
     * @param IpInfo $ipInfo
     */
    public function removeIpInfo(IpInfo $ipInfo);
}
