<?php

namespace Src;

use GuzzleHttp\Client;
use Src\Helpers\Printer;
use Src\Requests\CrawlerRequest;
use Symfony\Component\DomCrawler\Crawler;

class App extends CrawlerRequest
{
    /**
     * @var Printer
     */
    private Printer $printer;

    /**
     * @param string $base_uri
     */
    public function __construct(string $base_uri)
    {
        parent::__construct(new Client(['base_uri' => $base_uri]), new Crawler());
        $this->printer = new Printer();
    }

    /**
     * @param  string $url
     * @return array
     */
    public function getCourses(string $url): array
    {
        return parent::search($url);
    }

    /**
     * @return Printer
     */
    public function printer(): Printer
    {
        return $this->printer;
    }
}
