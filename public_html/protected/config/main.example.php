<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'New project',
    'language'=>'en',
    'theme' => 'profit',

    // preloading 'log' component
    'preload'=>array('log','bootstrap'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'gii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'bootstrap.gii',
            )
        ),
        'pages'=>array(
            'cacheId'=>'pagesPathsMap',
        ),
        'admin',
        'private',
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        'authManager'=>array(
            'class'=>'PhpAuthManager',
            'defaultRoles' => array('guest'),
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
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        /*'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),*/
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
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
        'smtp' => array(
            "host" => "smtp.yandex.ru", //smtp сервер
            "debug" => 1, //отображение информации дебаггера (0 - нет вообще)
            "auth" => true, //сервер требует авторизации
            "port" => 25, //порт (по-умолчанию - 25)
            "username" => "rangeweb", //имя пользователя на сервере
            "password" => "82zczrnhw", //пароль
            "addreply" => "rangeweb@yandex.ru", //ваш е-mail
            "replyto" => "yborschev@gmail.com", //e-mail ответа
            "fromname" => "", //имя
            "from" => "yborschev@gmail.com", //от кого
            "charset" => "utf-8", //от кого
        )
    ),
);