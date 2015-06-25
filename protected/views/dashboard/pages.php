<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . $model->pages_name; ?>

<?php
$text = 'legal';
switch ($model->pages_id) {
    case 3:
        $text = 'legal';
        break;
    case 4:
        $text = 'key';
        break;
}
?>

<div class="col-md-10 col-md-offset-1">
    <div class="login-banner text-center">
        <h1><i class="fa fa-<?php echo $text; ?>"></i> <?php echo $model->pages_name; ?> </h1>
    </div>
    <div class="portlet portlet-green">
        <div class="portlet-heading login-heading">
            <div class="portlet-title">
                <h4><strong><?php echo $model->pages_name; ?></strong>
                </h4>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="portlet-body">            
            <?php echo $model->pages_desc; ?>
        </div>
    </div>
</div>

<style type="text/css">
    .portlet .login-heading {
        padding: 5px 15px !important;
    }
    .login-banner { 
        margin: 25px 0 !important;
    }
</style>