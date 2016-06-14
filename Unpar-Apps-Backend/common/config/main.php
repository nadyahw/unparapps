<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'news', 'directory', 'category', 'calendar',
                        'v3/event', 'v3/news', 'v3/directory', 'v3/category', 'v3/calendar'],
                    'only' => ['index', 'view'],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['gadget', 'v3/gadget'],
                    'only' => ['create'],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v3/aspiration','v3/thumb'],
                    'only' => ['index', 'view','create'],
                ],
            ],
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/unparapps/Unpar-Apps-Backend/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
