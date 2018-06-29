<?php
return [
    'enablePrettyUrl' => true,
    'class' => 'yii\web\UrlManager',
    'suffix' => '/',
    'hostinfo' => '/',
    'showScriptName' => false,
    'rules' => [
        //'/<surl:[-a-z0-9_]+>/'                     => 'page/su',
        'cart/result/<res:[-a-z0-9_]+>' => 'cart/result',
        '<controller:[-a-z0-9_]+>/' => '<controller>/index',
        '<controller:[-a-z0-9_]+>/<id:\d+>' => '<controller>/view',
        '<controller:[-a-z0-9_]+>/<surl:[-a-z0-9_]+>' => '<controller>/su',
        '<controller:[-a-z0-9_]+>/a/<action:[-a-z0-9_]+>' => '<controller>/<action>',
        '<controller:[-a-z0-9_]+>/a/<action:[-a-z0-9_]+>/<id:\d+>' => '<controller>/<action>',
        '<controller:[-a-z0-9_]+>/a/<action:[-a-z0-9_]+>/<surl:[-a-z0-9_]+>' => '<controller>/<action>',



    ],
];
