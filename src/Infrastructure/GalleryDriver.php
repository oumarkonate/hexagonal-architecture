<?php

namespace App\Infrastructure;

/**
 * Class GalleryDriver
 */
final class GalleryDriver implements GalleryDriverInterface
{
    /** @var ApiClientInterface */
    private $client;

    /**
     * GalleryDriver constructor.
     *
     * @param ApiClientInterface $client
     */
    public function __construct(ApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function findAll(array $options): array
    {
        $uri = sprintf('https://picsum.photos/v2/list?%s', http_build_query($options));

        $contents = $this->client->retrieve($uri);

        return \json_decode($contents);
    }
}
