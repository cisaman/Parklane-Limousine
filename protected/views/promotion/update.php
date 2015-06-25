<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | Update Promotion (#' . $model->promotion_id . ')'; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> Update Promotion (#<?php echo $model->promotion_id; ?>)  | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('promotion/index'); ?>">Back to Listing</a></small></h1></li>
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
                    <li class="active"><a href="#promotion-update" data-toggle="tab">Update Promotion (#<?php echo $model->promotion_id; ?>)</a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="promotion-update">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php if (Yii::app()->user->hasFlash('message')): ?>
                                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                                        <?php echo Yii::app()->user->getFlash('message'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php $this->renderPartial('_form', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>