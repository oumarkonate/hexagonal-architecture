<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\UriBuilder;
use PHPUnit\Framework\TestCase;

class UriBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function buildWillReturnUri(): void
    {
        $this->assertSame(
            'https://picsum.photos/v2/list?page=1&limit=10',
            (new UriBuilder())->build(['page' => 1, 'limit' => 10])
        );
    }
}
