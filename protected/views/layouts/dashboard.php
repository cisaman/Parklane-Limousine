<?php
if (isset(Yii::app()->session['admin_data']['admin_id']) && !empty(Yii::app()->session['admin_data']['admin_id'])) {
    $model = Admin::getProfile();
}
//echo Yii::app()->user->getState('lang');;

$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<!DOCTYPE html>
<html>
    <head>

        <?php
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.js' => Utils::getStyleUrl() . 'js/jquery.js',
        );
        $cs->registerCoreScript('jquery');
        ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>                
        <!--link rel="icon" href="http://www.w3schools.com/tags/demo_icon.gif" type="image/gif" sizes="16x16"--> 

        <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/pace/pace.css" rel="stylesheet">
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/pace/pace.js"></script>

        <!-- GLOBAL STYLES - Include these on every page. -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
        <link href="<?php echo Utils::getStyleUrl() ?>icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- PAGE LEVEL PLUGIN STYLES -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/messenger/messenger.css" rel="stylesheet">
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet">
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/morris/morris.css" rel="stylesheet">

        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins/datatables/datatables.css" rel="stylesheet">

        <!-- THEME STYLES - Include these on every page. -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/style.css" rel="stylesheet">
        <link href="<?php echo Utils::getStyleUrl() ?>css/plugins.css" rel="stylesheet">

        <!-- THEME DEMO STYLES - Use these styles for reference if needed. Otherwise they can be deleted. -->
        <link href="<?php echo Utils::getStyleUrl() ?>css/demo.css" rel="stylesheet">


        <link href="<?php echo Utils::getStyleUrl() ?>css/custom.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="<?php echo Utils::getStyleUrl() ?>js/html5shiv.js"></script>
          <script src="<?php echo Utils::getStyleUrl() ?>js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- begin TOP NAVIGATION -->
            <nav class="navbar-top" role="navigation">

                <!-- begin BRAND HEADING -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse">
                        <i class="fa fa-bars"></i> Menu
                    </button>
                    <div class="navbar-brand">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/index'); ?>">
                            <span style="color: #fff;font-size: 22px;font-family: Ubuntu, Helvetica Neue, Helvetica, Arial, sans-serif"><i class="fa fa-gears"></i> <?php echo Yii::t('lang', 'parklane'); ?></span>
                        </a>
                    </div>
                </div>
                <!-- end BRAND HEADING -->

                <div class="nav-top">                    
                    <ul class="nav navbar-left">
                        <li class="tooltip-sidebar-toggle">
                            <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Click here to Sidebar Toggle.">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>                      
                    </ul>                    
                    <ul class="nav navbar-right">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-language"></i> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="javascript:void(0);" class="lang" alt="en">
                                        <i class="fa fa-send"></i> English
                                    </a>
                                </li>                                
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:void(0);" class="lang" alt="zh-tw">
                                        <i class="fa fa-send"></i> Chinese
                                    </a>
                                </li>                                
                            </ul>                           
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/profile'); ?>">
                                        <i class="fa fa-user"></i> <?php echo Yii::t('lang', 'profile'); ?>
                                    </a>
                                </li>                                
                                <li class="divider"></li>                                
                                <li>
                                    <a class="logout_open" href="#logout">
                                        <i class="fa fa-sign-out"></i> <?php echo Yii::t('lang', 'log_out'); ?>
                                        <strong><?php echo $model['name']; ?></strong>
                                    </a>
                                </li>
                            </ul>                           
                        </li>

                    </ul>                   

                </div>                
            </nav>
            <!-- /.navbar-top -->
            <!-- end TOP NAVIGATION -->

            <!-- begin SIDE NAVIGATION -->
            <nav class="navbar-side" role="navigation">
                <div class="navbar-collapse sidebar-collapse collapse">

                    <ul id="side" class="nav navbar-nav side-nav">
                        <li class="side-user hidden-xs">
                            <img class="img-circle" src="<?php echo $model["photo"]; ?>" alt="" style="height: 150px;width: 150px;">
                            <p class="welcome">
                                <i class="fa fa-key"></i> <?php echo Yii::t('lang', 'logged_in_as'); ?> <span><?php echo $model["role"]; ?></span>
                            </p>
                            <p class="name tooltip-sidebar-logout">
                                <?php echo $model["name"]; ?>
                                <a style="color: inherit; background: none repeat scroll 0% 0% transparent ! important;" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                            </p>
                            <div class="clearfix"></div>
                        </li>                        
                        <li class="<?php echo ($controller == 'dashboard' && $action == 'index') ? 'active' : ''; ?>">                            
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/index'); ?>">
                                <i class="fa fa-dashboard"></i> <?php echo Yii::t('lang', 'dashboard'); ?>
                            </a>
                        </li>
                        <li class="panel">
                            <a href="javascript:void(0);" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#airporttransferservice">
                                <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'airport_transfer') ?><i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="collapse nav" id="airporttransferservice">
                                <li class="<?php echo ($controller == 'booking' && in_array($action, array('arrival'))) ? 'active' : ''; ?>">
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('/booking/arrival'); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'arrival'); ?>
                                    </a>                                    
                                </li>                                
                                <li class="<?php echo ($controller == 'booking' && in_array($action, array('departure'))) ? 'active' : ''; ?>">
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('/booking/departure'); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'departure'); ?>
                                    </a>                                    
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo ($controller == 'hourlyonhire' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('hourlyonhire/index'); ?>">
                                <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'hourly_on_hire'); ?>
                            </a>
                        </li>
                        <li class="<?php echo ($controller == 'adhocptop' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('adhocptop/index'); ?>">
                                <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'adhoc_point_to_point'); ?>
                            </a>
                        </li>
                        <?php if ($model['role_id'] == 1) { ?>
                            <li class="<?php echo ($controller == 'user' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('user/index'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'users'); ?>
                                </a>
                            </li>
                            <li class="<?php echo ($controller == 'drivers' && in_array($action, array('index', 'create', 'update', 'delete'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('drivers/index'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'drivers'); ?>
                                </a>
                            </li>
                            <li class="panel">
                                <a href="javascript:void(0);" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#setup">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'setup') ?><i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="collapse nav" id="setup">
                                    <li class="<?php echo ($controller == 'country' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/country/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'countries'); ?>
                                        </a>                                    
                                    </li>                                
                                    <li class="<?php echo ($controller == 'district' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/district/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'districts'); ?>
                                        </a>                                    
                                    </li>
                                    <li class="<?php echo ($controller == 'creditcard' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/creditcard/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'credit_cards'); ?>
                                        </a>                                    
                                    </li>
                                    <li class="<?php echo ($controller == 'quota' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/quota/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'visa_card') . ' ' . Yii::t('lang', 'quotas'); ?>
                                        </a>                                    
                                    </li>
                                    <li class="<?php echo ($controller == 'pages' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/pages/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'pages'); ?>
                                        </a>                                    
                                    </li>
                                    <li class="<?php echo ($controller == 'lang' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/lang/index'); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo Yii::t('lang', 'languages'); ?>
                                        </a>                                    
                                    </li>
                                </ul>
                            </li>                            
                            <li class="<?php echo ($controller == 'countrydistrictgroup' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('countrydistrictgroup/index'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'country_district_group'); ?>
                                </a>
                            </li>
                            <li class="<?php echo ($controller == 'pricelistptop' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('pricelistptop/index'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'pricelistptop'); ?>
                                </a>
                            </li>
                            <li class="<?php echo ($controller == 'promotion' && in_array($action, array('index'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('promotion/index'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'promotion'); ?>
                                </a>
                            </li>                            
                            <li class="<?php echo ($controller == 'dashboard' && in_array($action, array('settings'))) ? 'active' : ''; ?>">
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/settings'); ?>">
                                    <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'settings'); ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="<?php echo ($controller == 'dashboard' && in_array($action, array('profile'))) ? 'active' : ''; ?>">
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/profile'); ?>">
                                <i class="fa fa-inbox"></i> <?php echo Yii::t('lang', 'profile'); ?>
                            </a>
                        </li>

                    </ul>

                </div>
            </nav>

            <div id="page-wrapper">
                <div class="page-content">
                    <?php echo $content; ?>
                </div>
            </div>

        </div>        

        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/popupoverlay/defaults.js"></script>

        <!-- Log Out Notification Box -->
        <div id="logout">
            <div class="logout-message">
                <img class="img-circle img-logout" src="<?php echo $model["photo"]; ?>" alt="" style="height: 150px;width: 150px;">
                <h3><i class="fa fa-sign-out text-green"></i> Ready to go?</h3>
                <p>Select "Log Out" below if you are ready<br> to end your current session.</p>
                <ul class="list-inline">
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/logout'); ?>" class="btn btn-green">
                            <strong>Log Out</strong>
                        </a>
                    </li>
                    <li><button class="logout_close btn btn-green">Cancel</button></li>
                </ul>
            </div>
        </div>
        <!-- /#logout -->

        <!-- Log Out Notification jQuery -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/popupoverlay/logout.js"></script>
        <!-- HISRC Retina Images -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/hisrc/hisrc.js"></script>

        <!-- PAGE LEVEL PLUGIN SCRIPTS -->
        <!-- HubSpot Messenger -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/messenger/messenger.min.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/messenger/messenger-theme-flat.js"></script>
        <!-- Date Range Picker -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/daterangepicker/moment.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/daterangepicker/daterangepicker.js"></script>        
        <!-- Flot Charts -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/flot/jquery.flot.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/flot/jquery.flot.resize.js"></script>
        <!-- Sparkline Charts -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- Moment.js -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/moment/moment.min.js"></script>
        <!-- jQuery Vector Map -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/demo/map-demo-data.js"></script>
        <!-- Easy Pie Chart -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/datatables/datatables-bs3.js"></script>

        <!-- THEME SCRIPTS -->
        <script src="<?php echo Utils::getStyleUrl() ?>js/flex.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/demo/dashboard-demo.js"></script>
        <script src="<?php echo Utils::getStyleUrl() ?>js/demo/advanced-tables-demo.js"></script>

        <script src="<?php echo Utils::getStyleUrl() ?>js/plugins/hisrc/hisrc.js"></script>

        <script src="<?php echo Utils::getStyleUrl() ?>js/admin.js"></script>


        <!----------------------- Language Selector Settings  ------------------------------>
        <style type="text/css">
            .lang{display: block;}
        </style>
        <script type="text/javascript">
            $(document).ready(function () {

                $('.lang').click(function () {
                    var code = $(this).attr('alt');

                    if (code === '') {
                        code = 'zh-tw';
                    }

                    $.get('<?php echo Utils::GetBaseUrl(); ?>/dashboard/language', {code: code}, function (data) {
                        location.reload();
                    });
                });

                var controller = '<?php echo $controller ?>';
                var action = '<?php echo $action ?>';
                var arr = ["booking"];
                var arr2 = ["arrival", "departure", 'update'];

                if (controller == 'booking' && $.inArray(action, arr2) !== -1) {
                    $('#airporttransferservice').removeClass('collapse nav');
                    $('#airporttransferservice').addClass('nav in');
                }

                var setup_array = ['country', 'district', 'creditcard', 'quota', 'lang', 'pages'];
                if ($.inArray(controller, setup_array) !== -1) {
                    $('#setup').removeClass('collapse nav');
                    $('#setup').addClass('nav in');
                }

            });
        </script>
        <!----------------------- Language Selector Settings  ------------------------------>

        <style type="text/css">
            #side .active a {
                background: none repeat scroll 0 0 #16a085 !important;
                color: #fff !important;
                font-weight: bold !important;
            }
            #side a:hover {
                background: none repeat scroll 0 0 #16a085 !important;
                color: #fff !important;
                font-weight: bold !important;
            }
        </style>

    </body>
</html>