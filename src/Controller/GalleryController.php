<?php

namespace App\Controller;

use App\Config\Config;
use App\Config\Message\Request;
use App\Config\Message\Response;
use App\Domain\GalleryManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class GalleryController
 */
final class GalleryController
{
    use ControllerTrait;

    /** @var Request */
    private $request;

    /** @var GalleryManagerInterface */
    private $galleryManager;

    /** @var LoggerInterface */
    private $logger;

    /**
     * GalleryController constructor.
     *
     * @param Request $request
     * @param GalleryManagerInterface $galleryManager
     * @param LoggerInterface $logger
     * @param Config $config
     */
    public function __construct(
        Request $request,
        GalleryManagerInterface $galleryManager,
        LoggerInterface $logger,
        Config $config
    ) {
        $this->request = $request;
        $this->galleryManager = $galleryManager;
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * Display gallery of images.
     *
     * @return Response
     */
    public function showGallery(): Response
    {
        try {
            $imagesLists = $this->galleryManager->getImagesGalleryContents([
                'page'  => $this->request->get('page') ?? 1,
                'limit' => $this->request->get('size') ?? 10,
            ]);
        } catch (\Exception $exception) {
            $errors = true;
        }

        return $this->render('gallery.html', [
            'images_list' => $imagesLists ?? [],
            'error' => $errors ?? false,
        ]);
    }
}
