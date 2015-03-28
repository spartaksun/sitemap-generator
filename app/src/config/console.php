<?php

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\console\controllers',
    'components' => [
        'db' => require("db.php"),
    ]
];
