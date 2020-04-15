<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => [
			  'contact' => 'contact/index',
			  'expertise' => 'real-estate/index',
			  'charitychoice' => 'charity/index',
			  'properties' => 'property/index',
			  'properties/details/<id:\d+>' => 'property/details',
			  '' => 'site/index' 	 		  
		  ],
        ],
    ],
];


