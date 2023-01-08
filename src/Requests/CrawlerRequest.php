<?php

declare(strict_types=1);

namespace Src\Requests;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Make requests
 *
 * @package Src\Requests
 */
class CrawlerRequest
{
    /**
     * @param ClientInterface $httpClient
     * @param Crawler         $crawler
     */
    public function __construct(private ClientInterface $httpClient, private Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    /**
     * @param  string $url
     * @return array
     */
    public function search(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);
        $html = $response->getBody();

        $this->crawler->addHtmlContent((string) $html);
        $coursesElement = $this->crawler->filter('span.card-curso__nome');
        $courses = [];

        foreach ($coursesElement as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
