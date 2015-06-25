<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
<!--        <script src='https://www.google.com/recaptcha/api.js'></script>-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>        

        <?php
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.js' => Utils::getStyleUrl() . 'js/jquery.js',
        );
        $cs->registerCoreScript('jquery');
        ?>

        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
        <link href="<?php echo Utils::getStyleUrl() ?>icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- THEME STYLES -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/style.css" rel="stylesheet">
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins.css" rel="stylesheet">

        <!-- THEME DEMO STYLES -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/demo.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="<?php echo Utils::getStyleUrl() ?>js/html5shiv.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/respond.min.js"></script>
        <![endif]-->

        <link href="<?php echo Utils::getStyleUrl() ?>css/custom.css" rel="stylesheet">

    </head>

    <body class="login">

        <div class="container">
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div>

        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>        
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/hisrc/hisrc.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/flex.js"></script>

    </body>
</html>
