<?php

namespace App\Infrastructure;

interface GalleryDriverInterface
{
    /**
     * @param array $options
     *
     * @return array
     */
    public function findAll(array $options): array;
}
