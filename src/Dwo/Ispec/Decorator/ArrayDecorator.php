<?php

namespace Dwo\Ispec\Decorator;

use Dwo\Ispec\Model\IpInfo;

/**
 * Class ArrayDecorator
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class ArrayDecorator implements DecoratorInterface
{
    protected $data = array();

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function decorate(IpInfo $ipInfo, $overwrite = false)
    {
        foreach ($ipInfo->toArray(false) as $key => $value) {
            if ((empty($value) || $overwrite) && isset($this->data[$key]) && !empty($this->data[$key])) {
                $ipInfo->$key = $this->data[$key];
            }
        }

        return $ipInfo;
    }
}
