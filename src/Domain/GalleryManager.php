<?php

namespace App\Domain;

/**
 * Class GalleryManager
 */
final class GalleryManager implements GalleryManagerInterface
{
    /** @var GalleryDataFinderInterface */
    private $repository;

    /**
     * GalleryManager constructor.
     *
     * @param GalleryDataFinderInterface $repository
     */
    public function __construct(GalleryDataFinderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getImagesGalleryContents(array $options): array
    {
        return $this->repository->findAll($options);
    }
}
