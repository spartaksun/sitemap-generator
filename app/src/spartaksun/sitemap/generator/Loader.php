<?php

namespace spartaksun\sitemap\generator;


class Loader
{

    /**
     * @var string
     */
    private $pageUrl;
    private $mainPageUrl;
    private $host;

    public $wwwIsTheSameDomain = false;

    public function __construct($pageUrl)
    {
        if(!is_string($pageUrl)) {
            throw new \InvalidArgumentException('Expected string parameter.');
        }

        $this->pageUrl = $pageUrl;
        $this->mainPageUrl = self::getMainPageUrl($pageUrl);

        $parsed = self::parseUrl($pageUrl);
        $this->host = $parsed['host'];
    }

    /**
     * @throws \ErrorException
     * @return array
     */
    public function load()
    {
        $html = file_get_contents($this->pageUrl);

        if($html === false) {
            throw new \ErrorException('Page loading error');
        }

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument;
        $dom->loadHTML($html);

        $links = $dom->getElementsByTagName('a'); /* @var $links \DOMElement[] */

        $urls = [];
        foreach ($links as $link){
            $urls[] = $link->getAttribute('href');
        }

        return $this->normalizeUrls($urls);
    }

    /**
     * Cast to full URL
     * @param array $urls
     * @return array
     */
    private function normalizeUrls(array $urls)
    {
        $result = [];
        foreach($urls as $url) {

            if(in_array($url, $result)) {
                continue;
            }

            $url = $this->normalizeUrl($url);
            if(!$url) {
                continue;
            }

            if($this->isDomainAllowed($url)) {
                $result[] = $url;
            }
        }

        return $result;
    }

    /**
     * Cast to full URL
     * @param array $url
     * @return array
     */
    private function normalizeUrl($url)
    {

        if(preg_match("~^http(|s):\/\/~", $url)) {
            return $this->prepare($url);
        } elseif(preg_match("~^\/~",$url)) {
            return $this->prepare($this->mainPageUrl . $url);
        } elseif($url == '/') {
            return $this->prepare($this->mainPageUrl);
        } else {
            return false;
        }
    }

    /**
     * @param $url
     * @return string
     * @throws \ErrorException
     */
    private function prepare($url)
    {
        $parsed = self::parseUrl($url);

        $query = (!empty($parsed['query'])) ? "?{$parsed['query']}" : '';
        $path = (!empty($parsed['path'])) ? $parsed['path'] : '';

        return "{$parsed['scheme']}://{$parsed['host']}{$path}{$query}";
    }

    /**
     * Check if URL at the same domain
     * @param $url
     * @return bool
     * @throws \ErrorException
     */
    private function isDomainAllowed($url)
    {
        $parsed = self::parseUrl($url);
        if($parsed['host'] == $this->host) {
            return true;

        } elseif($this->wwwIsTheSameDomain) {
            if("www.{$parsed['host']}" == $this->host) {
                return true;
            }
            if("www.{$this->host}" == $parsed['host']) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $url
     * @return string
     * @throws \ErrorException
     */
    public static function getMainPageUrl($url)
    {
        $parsed = self::parseUrl($url);
        // TODO port!
        return "{$parsed['scheme']}://{$parsed['host']}";
    }


    /**
     * Parse url
     *
     * @param $url
     * @return array
     * @throws \ErrorException
     */
    public static function parseUrl($url)
    {
        $parsed = parse_url($url);
        if(!empty($parsed['scheme']) && !empty($parsed['host'])) {
            return $parsed;
        }

        throw new \ErrorException("Can not parse {$url}");
    }
}