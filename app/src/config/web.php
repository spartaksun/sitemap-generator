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
];

return $config;
