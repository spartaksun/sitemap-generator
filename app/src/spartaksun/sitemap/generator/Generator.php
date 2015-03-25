<?php

namespace spartaksun\sitemap\generator;


class Generator
{
    /**
     * @param $url
     * @throws \ErrorException
     */
    public function generate($url)
    {
        $loader = new Loader();
        $mainPageUrl = $this->getMainPageUrl($url);

        $links = $loader->load($mainPageUrl);

        var_dump($links);

    }

    /**
     * @param $url
     * @return string
     * @throws \ErrorException
     */
    private function getMainPageUrl($url)
    {
        $parsed = parse_url($url);
        if($parsed) {
            // TODO port!
            return "{$parsed['scheme']}://{$parsed['host']}";
        }

        throw new \ErrorException("Can not parse {$url}");
    }
}