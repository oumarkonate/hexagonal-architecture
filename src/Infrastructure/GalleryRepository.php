<?php

namespace App\Infrastructure;

use App\Domain\GalleryDataFinderInterface;

final class GalleryRepository implements GalleryDataFinderInterface
{
    /** @var GalleryDriverInterface */
    private $driver;

    /**
     * GalleryRepository constructor.
     *
     * @param GalleryDriverInterface $driver
     */
    public function __construct(GalleryDriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function findAll (array $options): array
    {
        return $this->driver->findAll($options);
    }
}
