<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\{ResponseInterface, StreamInterface};
use Src\Requests\CrawlerRequest;
use Symfony\Component\DomCrawler\Crawler;

class TestCrawlerRequest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    private $httpClientMock;

    /** @var string */
    private string $url = 'url-test';

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $html = <<<FIM
            <html>
                <body>
                    <span class="card-curso__nome">Curso Teste 1</span>
                    <span class="card-curso__nome">Curso Teste 2</span>
                    <span class="card-curso__nome">Curso Teste 3</span>
                </body>
            </html>    
        FIM;

        $stream = $this->createMock(StreamInterface::class);
        $stream
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    /**
     * @throws GuzzleException
     * @return void
     */
    public function testCrawlerMustReturnCourses(): void
    {
        $crawler = new Crawler();
        $search = new CrawlerRequest($this->httpClientMock, $crawler);
        $courses = $search->search($this->url);

        $this->assertCount(3, $courses);
        $this->assertEquals('Curso Teste 1', $courses[0]);
        $this->assertEquals('Curso Teste 2', $courses[1]);
        $this->assertEquals('Curso Teste 3', $courses[2]);
    }
}
