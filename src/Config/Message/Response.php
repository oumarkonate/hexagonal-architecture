<?php

namespace App\Config\Message;

/**
 * Class Response
 */
final class Response implements ResponseInterface
{
    /** @var string */
    private $content;

    /**
     * Response constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
