<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Кованные изделия в томске','language'=>'rus',
    'defaultController' => 'Pages',

    'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),

    'components'=>array(
        'user'=>array(
        'loginUrl' => array ('/auth'),
            'allowAutoLogin'=>true,
        ),

        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),

        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD',
        ),

        'cache'=>array(
            'class'=>'CApcCache',

        ),

        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'appendParams' => false
        ),

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=yii',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'enableProfiling'=>true,
        ),

//        'db'=>array(
//            'connectionString' => 'mysql:host=localhost;dbname=base576',
//            'emulatePrepare' => true,
//            'username' => 'base576',
//            'password' => '1234',
//            'charset' => 'utf8',
//            'enableProfiling'=>true,
//        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error, warning',
                    'showInFireBug' => true,

                ),
            ),
        ),
    ),
);
