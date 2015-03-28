<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../src/vendor/autoload.php');
require(__DIR__ . '/../src/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../src/config/web.php');

\Yii::$container->set(
    \spartaksun\sitemap\generator\loader\LoaderInterface::class,
    \spartaksun\sitemap\generator\loader\GuzzleLoader::class
);
\Yii::$container->set(
    \spartaksun\sitemap\generator\parser\ParserInterface::class,
    \spartaksun\sitemap\generator\parser\HtmlParser::class
);
\Yii::$container->set(
    \spartaksun\sitemap\generator\storage\UniqueValueStorageInterface::class,
    [
        'class' => \spartaksun\sitemap\generator\storage\MysqlStorage::class,
        'db' => $config['params']['db'],
    ]
);

(new yii\web\Application($config))->run();
