<?php

namespace App\Config;

use App\Controller\GalleryController;
use App\Controller\HomeController;
use App\Config\Message\Request;
use App\Domain\GalleryManager;
use App\Infrastructure\ApiClient;
use App\Infrastructure\GalleryDriver;
use App\Infrastructure\GalleryRepository;
use App\Infrastructure\UriBuilder;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Application
{
    public function run(): void
    {
        $config = new Config();
        $logger = new Logger('gallery_images_log');

        try {
            $logger->pushHandler(new StreamHandler($config->getParameter('LOGS_PATH'), Logger::WARNING));
        } catch (\Exception $e) {
            echo "Error while configuring logger";
        }

        // Instanciate dependencies
        $apiClient = new ApiClient(new Client(), $logger);
        $uriBuilder = new UriBuilder();
        $galeryDriver = new GalleryDriver($apiClient, $uriBuilder);
        $repository = new GalleryRepository($galeryDriver);
        $manager = new GalleryManager($repository);

        // Define route
        $router = new Router();

        $router->get('/', function (Request $request) use ($logger, $config) {
            echo ((new HomeController($request, $logger, $config))->index())->getContent();
        });

        $router->get('/gallery-images/', function (Request $request) use ($manager, $logger, $config) {
            echo ((new GalleryController($request, $manager, $logger, $config))->showGallery())->getContent();
        });
    }
}
