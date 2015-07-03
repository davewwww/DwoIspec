<?php

namespace Dwo\Ispec\Helper;

use Dwo\Ispec\Exception\IspecException;
use Dwo\Ispec\Model\IpInfo;
use IpUtils\Factory;

/**
 * Class IpInfoHelper
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpInfoHelper
{
    /**
     * @param IpInfo $ipInfo
     *
     * @return IpInfo
     * @throws IspecException
     */
    public static function getIp(IpInfo $ipInfo)
    {
        $ip = $ipInfo->ip;

        if (empty($ip)) {
            if (empty($ipInfo->subnet)) {
                throw new IspecException('no ip found');
            }
            list($ip) = explode('/', $ipInfo->subnet, 2);
        }

        return $ip;
    }

    /**
     * @param string         $ip
     * @param array|IpInfo[] $entries
     * @param mixed          $entryReturn
     *
     * @return bool
     */
    public static function isIpInSubnets($ip, array $entries, &$entryReturn = null)
    {
        $ipObj = Factory::getAddress($ip);

        foreach ($entries as $entry) {
            if (Factory::getExpression(self::getSubnet($entry))->matches($ipObj)) {
                $entryReturn = $entry;

                return true;
            }
        }

        return false;
    }

    /**
     * @return object|array $data
     *
     * @return string
     * @throws IspecException
     */
    public static function getSubnet($data)
    {
        $subnet = null;

        if ($data instanceof IpInfo) {
            $subnet = $data->subnet;
        } elseif (is_array($data) && isset($data['subnet'])) {
            $subnet = $data['subnet'];
        } else {
            throw new IspecException('key "subnet" is missing');
        }

        return $subnet;
    }
}
