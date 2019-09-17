<?php

namespace App\Infrastructure;

use GuzzleHttp\Exception\GuzzleException;

interface ApiClientInterface
{
    /**
     * @param string $url
     *
     * @return string
     *
     * @throws \Exception
     */
    public function retrieve(string $url): string;
}
