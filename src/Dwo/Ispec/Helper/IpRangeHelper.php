<?php

namespace Dwo\Ispec\Helper;

/**
 * Class IpRangeHelper
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpRangeHelper
{
    /**
     * @param string $ipSubnet
     *
     * @return array
     */
    public static function getIpRangeForSubnet($ipSubnet)
    {
        list($ip, $bits) = explode('/', $ipSubnet, 2);

        $mask = $bits == 0 ? 0 : (~0 << (32 - $bits));

        return array(
            long2ip(ip2long($ip) & $mask),
            long2ip(ip2long($ip) | (~$mask & 0xFFFFFFFF))
        );
    }

    /**
     * @param string $ipSubnet
     * @param int    $number
     *
     * @return array
     */
    public static function getSomeIpsFromRange($ipSubnet, $number = 3)
    {
        list($start, $end) = self::getIpRangeForSubnet($ipSubnet);

        $longStart = ip2long($start);
        $diff = ip2long($end) - $longStart;
        $parts = round($diff / ($number + 1));

        $ips = [];
        for ($x = 1; $x <= $number; $x++) {
            $ips[] = long2ip($longStart + ($parts * $x));
        }

        return $ips;
    }
}
