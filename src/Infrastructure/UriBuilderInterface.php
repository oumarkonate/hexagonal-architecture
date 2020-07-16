<?php

namespace App\Infrastructure;

interface UriBuilderInterface
{
    /**
     * @param array $options
     *
     * @return string
     */
    public function build(array $options): string;
}
