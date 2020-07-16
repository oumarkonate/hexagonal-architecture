<?php

namespace App\Infrastructure;

/**
 * Class GalleryDriver
 */
final class GalleryDriver implements GalleryDriverInterface
{
    /** @var ApiClientInterface */
    private $client;

    /** @var UriBuilderInterface */
    private $uriBuilder;

    /**
     * GalleryDriver constructor.
     *
     * @param ApiClientInterface $client
     * @param UriBuilderInterface $uriBuilder
     */
    public function __construct(ApiClientInterface $client, UriBuilderInterface $uriBuilder)
    {
        $this->client = $client;
        $this->uriBuilder = $uriBuilder;
    }

    /**
     * @inheritDoc
     */
    public function findAll(array $options): array
    {
        $contents = $this->client->retrieve($this->uriBuilder->build($options));

        return \json_decode($contents);
    }
}
