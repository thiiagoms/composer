<?php

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
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var Crawler
     */
    private Crawler $crawler;

    /**
     * @param ClientInterface $httpClient
     * @param Crawler         $crawler
     */
    public function __construct(ClientInterface $httpClient, Crawler $crawler)
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

        $this->crawler->addHtmlContent($html);
        $coursesElement = $this->crawler->filter('span.card-curso__nome');
        $courses = [];

        foreach ($coursesElement as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
