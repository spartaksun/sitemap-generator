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
        try {
            $loader = new Loader(
                Loader::getMainPageUrl($url)
            );

            /**
             * Consider host with www as the same
             */
            $loader->wwwIsTheSameDomain = true;

            $storage = new ArrayStorage();
            foreach($loader->load() as $url) {
                $storage->add($url);
            }

            $total = $storage->total();
            $storage->offset(5);

            echo $total;
            var_dump($storage->get());

        } catch (\ErrorException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}