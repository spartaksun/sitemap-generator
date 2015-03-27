<?php
ini_set('display_errors', 1);
require "../vendor/autoload.php";

$generator = new \spartaksun\sitemap\generator\Generator();
$generator->storage = new \spartaksun\sitemap\generator\storage\MysqlStorage('qwerty');
$generator->storage->db = [
    'name' => 'sitemap',
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
];
$generator->loader  = new \spartaksun\sitemap\generator\loader\Loader();

$generator->generate('http://facebook.com');

