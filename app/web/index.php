<?php
ini_set('display_errors', 1);
require "../vendor/autoload.php";

$generator = new \spartaksun\sitemap\generator\Generator();
$generator->generate('http://facebook.com');

