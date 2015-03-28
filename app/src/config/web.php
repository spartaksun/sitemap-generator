<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'index/index',
            ],
         ],
        'request' => [
            'cookieValidationKey' => 'jsghwlek1erwe987iyiuyiu',
        ],
        'db' => require("db.php")
    ],
];

return $config;
