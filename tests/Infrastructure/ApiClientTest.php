<?php

namespace App\Tests\Infrastructure;

use App\Infrastructure\ApiClient;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

class ApiClientTest extends TestCase
{
    private $client;

    private $logger;

    public function setUp(): void
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
    }

    /**
     * @test
     */
    public function itShouldReturnMessageWhenClientRequestedSuccesfull()
    {
        $uri = '/url';
        $responseBody = '[{"field":"value"}]';

        $responseStream = $this->createMock(StreamInterface::class);
        $responseStream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($responseBody)
        ;

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($responseStream)
        ;

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with('GET', $uri)
            ->willReturn($response)
        ;

        $apiClient = new ApiClient($this->client, $this->logger);

        $this->assertEquals($responseBody, $apiClient->retrieve('/url'));
    }

    /**
     * @test
     */
    public function itShoudThrowExceptionWhenClientThrowException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('some errors messages.');

        $this->client
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new \Exception('some errors messages.'))
        ;

        $apiClient = new ApiClient($this->client, $this->logger);

        $apiClient->retrieve('/url');
    }
    
    /**
     * @test
     */
    public function itShouldCallLoggerWhenClientThrowException()
    {
        $this->client
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new \Exception('some errors messages.'))
        ;

        $this->expectException(\Exception::class);

        $this->logger
            ->expects($this->once())
            ->method('error')
            ->with('Error: some errors messages.');

        $apiClient = new ApiClient($this->client, $this->logger);

        $apiClient->retrieve('/url');
    }
}
