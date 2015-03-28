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
            'cookieValidationKey' => 'jsghwlek1erwe987',
        ],
    ],
    'params' => require ("params.php")
];

return $config;
