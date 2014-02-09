<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Pages Module Demo',
    'language'=>'ru',

    // preloading 'log' component
    'preload'=>array('log','bootstrap'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'modules'=>array(
        'pages'=>array(
            'cacheId'=>'pagesPathsMap',
        ),
    ),

    // application components
    'components'=>array(
        'user'=>array(
            'allowAutoLogin'=>true,
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'urlSuffix'=>'/',
            'rules'=>array(
                array('class'=>'application.modules.pages.components.PagesUrlRule'),
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'db'=>array(
            'connectionString'=>'mysql:host=localhost;dbname=hyi',
            'emulatePrepare'=>true,
            'username'=>'root',
            'password'=>'root',
            'charset'=>'utf8',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
        'bootstrap'=>array(
            'class'=>'ext.bootstrap.components.Bootstrap',
        ),
        'cache'=>array(
            'class'=>'CFileCache',
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'adminEmail'=>'webmaster@example.com',
    ),
);