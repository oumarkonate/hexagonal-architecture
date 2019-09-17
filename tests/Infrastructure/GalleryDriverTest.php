<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\ApiClientInterface;
use App\Infrastructure\GalleryDriver;
use PHPUnit\Framework\TestCase;
use stdClass;

class GalleryDriverTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnContentWhenCallFindMethod()
    {
        $stdClass1 = new stdClass();
        $stdClass1->field = 1;

        $stdClass2 = new stdClass();
        $stdClass2->field = 2;

        $galleryContentsList = [
            $stdClass1,
            $stdClass2,
        ];

        $contents = '[{"field":"1"},{"field":"2"}]';

        $client = $this->createMock(ApiClientInterface::class);
        $client
            ->expects($this->once())
            ->method('retrieve')
            ->with('https://picsum.photos/v2/list?page=2&limit=2')
            ->willReturn($contents)
        ;

        $galleryDriver = new GalleryDriver($client);

        $this->assertEquals($galleryContentsList, $galleryDriver->findAll(['page' => 2, 'limit' => 2]));
    }
}
