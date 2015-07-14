<?php

namespace Dwo\Ispec\Cache;

use Dwo\Ispec\Exception\IspecException;
use Dwo\Ispec\Helper\IpHelper;
use Dwo\Ispec\Model\IpInfo;
use Dwo\Ispec\Model\IpInfoFindAllManagerInterface;

/**
 * Class FindAllManager
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class FindAllManager implements IpInfoFindAllManagerInterface
{
    /**
     * @var IpInfo[]
     */
    private $ipInfos = [];
    /**
     * @var array
     */
    private $ipInfosGrouped = [];

    /**
     * @param IpInfo[] $ipInfos
     */
    public function __construct(array $ipInfos = array())
    {
        foreach ($ipInfos as $ipInfo) {
            $this->addSubnet($ipInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByKey($key)
    {
        return isset($this->ipInfosGrouped[$key]) ? $this->ipInfosGrouped[$key] : array();
    }

    /**
     * @return IpInfo[]
     */
    public function findAll()
    {
        return array();
    }


    /**
     * @param IpInfo $ipInfo
     */
    private function addSubnet(IpInfo $ipInfo)
    {
        $subnet = $ipInfo->subnet;
        if(empty($subnet)) {
            throw new IspecException('subnet is missing');
        }

        $this->ipInfos[$subnet] = $ipInfo;

        $key = IpHelper::createIpKey($subnet);

        if (!isset($this->ipInfosGrouped[$key])) {
            $this->ipInfosGrouped[$key] = array();
        }

        $this->ipInfosGrouped[$key][$subnet] = $ipInfo;
    }

}
