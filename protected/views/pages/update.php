<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . $model->pages_name_en . ' / ' . $model->pages_name_ch; ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo $model->pages_name_en . ' / ' . $model->pages_name_ch; ?>  | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('pages/index'); ?>">Back to Listing</a></small></h1></li>
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
                    <li class="active"><a href="#pages-update" data-toggle="tab"><?php echo $model->pages_name_en . ' / ' . $model->pages_name_ch; ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="pages-update">                            
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