<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\ApiClientInterface;
use App\Infrastructure\GalleryDriver;
use App\Infrastructure\UriBuilder;
use App\Infrastructure\UriBuilderInterface;
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

        $uriBuilder = $this->createMock(UriBuilderInterface::class);
        $uriBuilder
            ->expects($this->once())
            ->method('build')
            ->willReturn('https://picsum.photos/v2/list?page=2&limit=2')
        ;

        $client = $this->createMock(ApiClientInterface::class);
        $client
            ->expects($this->once())
            ->method('retrieve')
            ->with('https://picsum.photos/v2/list?page=2&limit=2')
            ->willReturn($contents)
        ;

        $galleryDriver = new GalleryDriver($client, $uriBuilder);

        $this->assertEquals($galleryContentsList, $galleryDriver->findAll(['page' => 2, 'limit' => 2]));
    }
}
