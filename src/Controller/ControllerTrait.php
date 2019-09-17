<?php

namespace App\Controller;

use App\Config\Config;
use App\Config\Message\Response;
use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Exception;

trait ControllerTrait
{
    /** @var Config */
    private $config;
    /**
     * @param string $param
     *
     * @return mixed
     *
     * @throws Exception
     */
    private function getParameter(string $param)
    {
        return $this->config->getParameter($param);
    }

    /**
     * @param string $template
     * @param array $params
     *
     * @return Response
     */
    private function render(string $template, array $params): Response
    {
        try {
            return new Response($this->getTemplate()->render($template, $params));
        } catch (Exception $exception) {
            $this->logger->error('Error: ' . $exception->getMessage());
        }
    }

    /**
     * @return TwigEnvironment
     */
    private function getTemplate()
    {
        try {
            $loader = new TwigFilesystemLoader($this->getParameter('TEMPLATE_PATH'));
            return new TwigEnvironment($loader, [
                'cache' => $this->getParameter('CACHE_PATH'),
            ]);
        } catch (Exception $exception) {
            $this->logger->error('Error: ' . $exception->getMessage());
        }
    }
}
