<?php

namespace Dwo\Ispec\Helper;

use Dwo\Ispec\Exception\IspecException;

/**
 * Class IpHelper
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpHelper
{
    /**
     * @param string $ip
     * @param bool   $returnFirstKey
     *
     * @return string
     */
    public static function createIpKey($ip, $returnFirstKey = false)
    {
        $mask = null;
        if (preg_match('/\//', $ip)) {
            list($ip, $mask) = explode('/', $ip, 2);
        }

        $parts = explode('.', $ip);
        if (!isset($parts[1])) {
            throw new IspecException('invalid ip IpHelper::createIpKey');
        }

        //for lower masks then 16
        if ($returnFirstKey || (null !== $mask && (int) $mask < 16)) {
            return $parts[0];
        }

        return $parts[0].'.'.$parts[1];
    }
}
