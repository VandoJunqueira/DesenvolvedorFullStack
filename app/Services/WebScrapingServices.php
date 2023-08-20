<?php

namespace App\Services;

use Symfony\Component\BrowserKit\HttpBrowser;

class WebScrapingServices
{

    static $url;

    public static function getWebsiteInfo(string $url)
    {

        self::$url = $url;

        $browser = new HttpBrowser();
        $crawler = $browser->request('GET', self::$url);

        $title = $crawler->filter('title')->text();

        $favicon = self::getFavicon($crawler);

        return (object) [
            'title' => $title,
            'favicon' => $favicon,
        ];
    }

    private static function getFavicon($crawler)
    {
        $favicon = null;

        if ($crawler->filter('link[rel="icon"]')->count() > 0) {
            $favicon = $crawler->filter('link[rel="icon"]')->attr('href');
        } elseif ($crawler->filter('link[rel="shortcut icon"]')->count() > 0) {
            $favicon = $crawler->filter('link[rel="shortcut icon"]')->attr('href');
        } else {
            $parsedUrl = parse_url(self::$url);

            $favicon = $parsedUrl['scheme'] . "://" . $parsedUrl['host'] . '/favicon.ico';
        }

        return $favicon;
    }
}
