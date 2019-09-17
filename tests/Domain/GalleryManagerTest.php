<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\GalleryManager;
use stdClass;
use App\Domain\GalleryDataFinderInterface;

class GalleryManagerTest extends TestCase
{
    /**
     * @test
     */
    public function testGetImagesGalleryContents()
    {
        $stdClass1 = new stdClass();
        $stdClass1->field = 1;

        $stdClass2 = new stdClass();
        $stdClass2->field = 2;

        $galleryContentsList = [
            $stdClass1,
            $stdClass2,
        ];

        $galleryRepository = $this->createMock(GalleryDataFinderInterface::class);
        $galleryRepository
            ->expects($this->once())
            ->method('findAll')
            ->with([
                'page' => 2,
                'limit' => 2,
            ])
            ->willReturn($galleryContentsList)
        ;

        $galleryManager = new GalleryManager($galleryRepository);

        $this->assertEquals($galleryContentsList, $galleryManager->getImagesGalleryContents(['page' => 2, 'limit' => 2]));
    }
}
