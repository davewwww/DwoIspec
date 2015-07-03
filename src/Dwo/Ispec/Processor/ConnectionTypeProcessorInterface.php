<?php

namespace Dwo\Ispec\Processor;

/**
 * Interface ConnectionTypeProcessor
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface ConnectionTypeProcessorInterface
{
    /**
     * @param string $ip
     *
     * @return string
     */
    public function getConnectionType($ip);
}
