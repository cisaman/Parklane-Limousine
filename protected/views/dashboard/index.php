<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'admin') . ' ' . Yii::t('lang', 'dashboard');

if (isset(Yii::app()->session['admin_data']['admin_id']) && !empty(Yii::app()->session['admin_data']['admin_id'])) {
    $model = Admin::getProfile();
}
?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">
            <h1><?php echo Yii::t('lang', 'dashboard'); ?> <small><?php echo Yii::t('lang', 'overview'); ?></small></h1>
        </div>
    </div>    
</div>
<!-- end PAGE TITLE AREA -->

<div class="row">

    <?php if ($model['role_id'] == 1) { ?>
        <div class="col-lg-12">
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading dark-blue">
                            <i class="fa fa-users fa-fw fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'users'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo User::model()->count(); ?>
                            <span id="sparklineA"></span>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('user/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading green">
                            <img src="<?php echo Utils::getBaseUrl() ?>/bootstrap/dashboard/img/website-icon.png" />
                        </div>
                    </a>
                    <div class="circle-tile-content green">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'pages'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo Pages::model()->count(); ?>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('pages/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading orange">
                            <img src="<?php echo Utils::getBaseUrl() ?>/bootstrap/dashboard/img/country-icon.png" />
                        </div>
                    </a>
                    <div class="circle-tile-content orange">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'countries'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo Country::model()->count(); ?>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('country/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading blue">
                            <img src="<?php echo Utils::getBaseUrl() ?>/bootstrap/dashboard/img/district-icon.png" />
                        </div>
                    </a>
                    <div class="circle-tile-content blue">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'districts'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo District::model()->count(); ?>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('district/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading red">
                            <i class="fa fa-tasks fa-fw fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content red">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'visa_card') . ' ' . Yii::t('lang', 'quotas'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo Quota::model()->count(); ?>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('quota/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div> 
            <div class="col-lg-2 col-sm-6">
                <div class="circle-tile">
                    <a href="javascript:void(0);">
                        <div class="circle-tile-heading purple">
                            <i class="fa fa-cab fa-fw fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content purple">
                        <div class="circle-tile-description text-faded">
                            <?php echo Yii::t('lang', 'drivers'); ?>
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php echo Drivers::model()->count(); ?>
                        </div>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('drivers/index'); ?>" class="circle-tile-footer">
                            <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div> 
        </div>
    <?php } ?>

    <div class="col-lg-12">
        <div class="col-lg-3 col-sm-8">
            <div class="circle-tile">
                <a href="javascript:void(0);">
                    <div class="circle-tile-heading green">
                        <i class="fa fa-tags fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content green">
                    <div class="circle-tile-description text-faded">
                        <?php echo Yii::t('lang', 'airport_transfer') ?> (<?php echo Yii::t('lang', 'arrival') ?>)
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?php echo Booking::model()->count('booking_type=1'); ?>
                    </div>
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('booking/arrival'); ?>" class="circle-tile-footer">
                        <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>    
        <div class="col-lg-3 col-sm-8">
            <div class="circle-tile">
                <a href="javascript:void(0);">
                    <div class="circle-tile-heading blue">
                        <i class="fa fa-tags fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content blue">
                    <div class="circle-tile-description text-faded">
                        <?php echo Yii::t('lang', 'airport_transfer') ?> (<?php echo Yii::t('lang', 'departure') ?>)
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?php echo Booking::model()->count('booking_type=2'); ?>
                    </div>                    
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('booking/departure'); ?>" class="circle-tile-footer">
                        <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-8">
            <div class="circle-tile">
                <a href="javascript:void(0);">
                    <div class="circle-tile-heading dark-blue">
                        <i class="fa fa-tags fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content dark-blue">
                    <div class="circle-tile-description text-faded">
                        <?php echo Yii::t("lang", "hourly_on_hire"); ?>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?php echo Hourlyonhire::model()->count(); ?>
                    </div>                    
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('hourlyonhire/index'); ?>" class="circle-tile-footer">
                        <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-8">
            <div class="circle-tile">
                <a href="javascript:void(0);">
                    <div class="circle-tile-heading orange">
                        <i class="fa fa-tags fa-fw fa-3x"></i>
                    </div>
                </a>
                <div class="circle-tile-content orange">
                    <div class="circle-tile-description text-faded">
                        <?php echo Yii::t("lang", "adhoc_point_to_point"); ?>
                    </div>
                    <div class="circle-tile-number text-faded">
                        <?php echo Adhocptop::model()->count(); ?>
                    </div>                    
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('adhocptop/index'); ?>" class="circle-tile-footer">
                        <?php echo Yii::t('lang', 'more_info') ?> <i class="fa fa-chevron-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>