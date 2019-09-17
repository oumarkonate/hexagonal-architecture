<?php

namespace App\Tests\Application;

use App\Config\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();
    }

    /**
     * @test
     */
    public function methodGetShouldReturnNullWhenHttpRequestMethodIsPost()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $callback = function ($x) {return $x;};

        $this->assertNull($this->router->get('/', $callback));
    }

    /**
     * @test
     */
    public function methodGetShouldReturnStringWhenHttpRequestIsGetAndCallbackReturnString()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER["REQUEST_URI"] = '/';

        $callback = function () {
            echo 'Bonjour !';
        };

        ob_start();

        $this->router->get('/', $callback);
        $this->assertEquals('Bonjour !', ob_get_clean());
    }

    /**
     * @test
     */
    public function methodPostShouldReturnNullWhenHttpRequestMethodIsGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $callback = function ($x) {return $x;};

        $this->assertNull($this->router->post('/', $callback));
    }

    /**
     * @test
     */
    /*public function methodPostShouldReturnStringWhenHttpRequestIsPostAndCallbackReturnString()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER["REQUEST_URI"] = '/test/?page=3';

        $callback = function () {
            echo 'Test !';
        };

        ob_start();

        $this->router->post('/test/?page=3', $callback);
        $this->assertEquals('Test !', ob_get_clean());
    }*/
}
