<?php

namespace App\Infrastructure;

final class UriBuilder implements UriBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(array $options): string
    {
        return sprintf('https://picsum.photos/v2/list?%s', http_build_query($options));
    }
}
