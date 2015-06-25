<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'driver') . '(#' . $model->driver_id . ')'; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'driver'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('drivers/index'); ?>"><?php echo Yii::t('lang', 'back_to_listing'); ?></a></small></h1></li>
            </ol>
        </div>
    </div>    
</div>
<!-- end PAGE TITLE AREA -->

<div class="row">
    <div class="col-lg-12">

        <div class="portlet portlet-default">
            <div class="portlet-body">
                <ul id="userTab" class="nav nav-tabs">
                    <li class="active"><a href="#driver-update" data-toggle="tab"><?php echo Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'driver'); ?>(#<?php echo $model->driver_id; ?>)</a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="driver-update">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php $this->renderPartial('_form', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>