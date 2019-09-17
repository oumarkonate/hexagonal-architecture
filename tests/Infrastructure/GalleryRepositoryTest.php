<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\GalleryDriverInterface;
use App\Infrastructure\GalleryRepository;
use PHPUnit\Framework\TestCase;
use stdClass;

class GalleryRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnContentWhenFindAllMethodIsCalled()
    {
        $stdClass1 = new stdClass();
        $stdClass1->field = 1;

        $stdClass2 = new stdClass();
        $stdClass2->field = 2;

        $galleryContentsList = [
            $stdClass1,
            $stdClass2,
        ];

        $driver = $this->createMock(GalleryDriverInterface::class);
        $driver
            ->expects($this->once())
            ->method('findAll')
            ->with(['page' => 2, 'limit' => 2])
            ->willReturn($galleryContentsList)
        ;

        $galleryRepository = new GalleryRepository($driver);

        $this->assertEquals($galleryContentsList, $galleryRepository->findAll(['page' => 2, 'limit' => 2]));
    }
}
