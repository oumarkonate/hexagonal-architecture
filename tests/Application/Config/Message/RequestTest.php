<?php

namespace App\Tests\Application\Config\Message;

use App\Config\Message\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 */
class RequestTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturn1WhenParamPageIs1()
    {
        $_GET['page'] = 1;
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $request = new Request();

        $this->assertEquals(1, $request->get('page'));
    }
}
