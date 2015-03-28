<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../src/vendor/autoload.php');
require(__DIR__ . '/../src/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../src/config/web.php');
require(__DIR__ . '/../src/config/bootstrap.php');

(new yii\web\Application($config))->run();
