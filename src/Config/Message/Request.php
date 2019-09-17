<?php

namespace App\Config\Message;

/**
 * Class Request
 */
final class Request implements RequestInterface
{
    /** @var array */
    public $params;

    /** @var string */
    public $reqMethod;
    /** @var string */
    public $contentType;

    /**
     * Request constructor.
     *
     * @param $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    /**
     * @inheritDoc
     */
    public function get(string $param): string
    {
        return htmlspecialchars($_GET[$param]);
    }
}
