<?php

namespace App\Tests\Application\Config\Message;

use App\Config\Message\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 */
class ResponseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnContent()
    {
        $response = new Response('some string ...');

        $this->assertEquals('some string ...', $response->getContent());
    }
}
