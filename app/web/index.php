<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../src/config/web.php');

(new yii\web\Application($config))->run();

//$generator = new \spartaksun\sitemap\generator\Generator('http://www.litmir.me/');
//
//
//$generator->loader          = new \spartaksun\sitemap\generator\loader\Loader();
//$generator->worker          = new \spartaksun\sitemap\generator\SiteWorker();
//$generator->worker->parser  = new \spartaksun\sitemap\generator\parser\HtmlParser();
//$generator->storage         = new \spartaksun\sitemap\generator\storage\MysqlStorage('ttttt');
//$generator->storage->db     = [
//                                    'name' => 'sitemap',
//                                    'host' => 'localhost',
//                                    'user' => 'root',
//                                    'pass' => '',
//                                ];
//$generator->level = 5;
//
//$generator->generate();

