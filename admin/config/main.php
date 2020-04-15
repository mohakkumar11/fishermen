<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-manage',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
	'aliases' => [
		'@adminlte/widgets'=>'@vendor/adminlte/yii2-widgets'
    	],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-manage',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            //'enableAutoLogin' => true,
			'enableAutoLogin' => false,
        	'authTimeout' => 3600,
            'identityCookie' => ['name' => '_identity-manage', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the manage
            'name' => 'advanced-manage',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
       
    ],
    'params' => $params,
];
