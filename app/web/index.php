<?php
ini_set('display_errors', 1);
require "../vendor/autoload.php";

$generator = new \spartaksun\sitemap\generator\Generator('http://jewelport.net');

session_start();

$generator->loader          = new \spartaksun\sitemap\generator\loader\Loader();
$generator->worker          = new \spartaksun\sitemap\generator\SiteWorker();
$generator->worker->parser  = new \spartaksun\sitemap\generator\parser\HtmlParser();
$generator->storage         = new \spartaksun\sitemap\generator\storage\MysqlStorage('ttttt');
$generator->storage->db     = [
                                    'name' => 'sitemap',
                                    'host' => 'localhost',
                                    'user' => 'root',
                                    'pass' => '',
                                ];
$generator->level = 5;

$generator->generate();

