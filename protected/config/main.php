<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

class ApplicationConfigBehavior extends CBehavior {

    /**
     * Declares events and the event handler methods
     * See yii documentation on behaviour
     */
    public function events() {
        return array_merge(parent::events(), array(
            'onBeginRequest' => 'beginRequest',
        ));
    }

    /**
     * Load configuration that cannot be put in config/main
     */
    public function beginRequest() {
        $code = Yii::app()->user->getState('lang');
        if (!empty($code)) {
            $lang = $code;
        } else {
            Yii::app()->user->setState('lang', 'zh-tw');
            $lang = Yii::app()->user->getState('lang');
        }

        $folder = Yii::getPathOfAlias('webroot.protected.messages') . DIRECTORY_SEPARATOR;
        $sql = "select lang_id from pa_lang where lang_shortcode='" . $lang . "' ";

        $list = Yii::app()->db->createCommand($sql)->queryAll();

        if (!is_dir($folder . $lang) && !empty($list)) {
            $oldumask = umask(0);
            @mkdir($folder . $lang, 0777);
            @umask($oldumask);
            copy($folder . "fr/lang.php", $folder . $lang . "/lang.php");
        }

        if (isset(Yii::app()->request->cookies['pref_lang'])) {
            $this->owner->language = Yii::app()->request->cookies['pref_lang']->value;
        } else {
            $this->owner->language = $lang;
        }
    }

}

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Parklane',
    'defaultController' => 'dashboard',
    'behaviors' => array('ApplicationConfigBehavior'),
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'parklane',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '103.231.46.168', $_SERVER['REMOTE_ADDR']),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                '<action:[\w\-]+>' => 'dashboard/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=parklane_parklane',
            'emulatePrepare' => true,
//            'username' => 'parklane_user',
//            'password' => 'parklane123$',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'pa_',
            'persistent' => true
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'dashboard/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'admin@parklanelimousine.com',
        'site_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/'
    ),
);
