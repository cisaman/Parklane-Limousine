<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'view') . ' ' . Yii::t('lang', 'quota') . '(#' . $model->quota_id . ')'; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'view') . ' ' . Yii::t('lang', 'quota'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('quota/index'); ?>"><?php echo Yii::t('lang', 'back_to_listing'); ?></a></small></h1></li>
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
                    <li class="active"><a href="#quota-view" data-toggle="tab"> <?php echo Yii::t('lang', 'view') . ' ' . Yii::t('lang', 'quota'); ?>(#<?php echo $model->quota_id; ?>)</a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="quota-view">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php $this->renderPartial('_view', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>