<?php

namespace App\Config\Message;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function getContent(): string;
}
