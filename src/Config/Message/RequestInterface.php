<?php

namespace App\Config\Message;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    /**
     * @param string $param
     *
     * @return string
     */
    public function get(string $param): string;
}
