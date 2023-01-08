<?php

declare(strict_types=1);

namespace Src;

use GuzzleHttp\Client;
use Src\Requests\CrawlerRequest;
use Symfony\Component\DomCrawler\Crawler;

final class App extends CrawlerRequest
{
    /**
     * @param string $base_uri
     */
    public function __construct(string $base_uri)
    {
        parent::__construct(new Client(['base_uri' => $base_uri]), new Crawler());
    }

    /**
     * @param  string $url
     * @return array
     */
    public function getCourses(string $url): array
    {
        return parent::search($url);
    }
}
