<?php

namespace App\Domain;

/**
 * Interface (Port) use by application.
 *
 * Interface GalleryManagerInterface
 */
interface GalleryManagerInterface
{
    /**
     * @param array $options
     *
     * @return array
     */
    public function getImagesGalleryContents(array $options): array;
}
