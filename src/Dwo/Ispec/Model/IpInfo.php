<?php

namespace Dwo\Ispec\Model;

/**
 * Class IpInfo
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class IpInfo
{
    public $ip;
    public $key;
    public $subnet;
    public $ip_from;
    public $ip_to;
    public $isp;
    public $asn;
    public $networkType;
    public $source;

    public $error;

    /**
     * :TODO: move to own maxmind repository
     *
     * @deprecated
     */
    public $connectionType;

    /**
     * :TODO: move to own maxmind repository
     *
     * @deprecated
     */
    public $userType;

    /**
     * @return array
     */
    public function toArray($removeEmptyKeys = true)
    {
        $ar = array(
            'ip'          => $this->ip,
            'key'         => $this->key,
            'subnet'      => $this->subnet,
            'ip_from'     => $this->ip_from,
            'ip_to'       => $this->ip_to,
            'isp'         => $this->isp,
            'asn'         => $this->asn,
            'networkType' => $this->networkType,
        );

        if ($removeEmptyKeys) {
            foreach ($ar as $key => $value) {
                if (null === $value) {
                    unset($ar[$key]);
                }
            }
        }

        return $ar;
    }
}
