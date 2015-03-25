<?php

namespace spartaksun\sitemap\generator;


class Loader
{
    /**
     * @param $url
     * @throws \HttpException
     * @return array
     */
    public function load($url)
    {
        $html = file_get_contents($url);

        $dom = new \DOMDocument;
        $dom->loadHTML($html);

        $links = $dom->getElementsByTagName('a'); /* @var $links \DOMElement[] */


        $result = [];
        foreach ($links as $link){
            $result[] = $link->getAttribute('href');
        }

        return $result;
    }
}