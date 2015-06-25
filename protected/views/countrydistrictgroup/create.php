<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country_district_group'); ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country_district_group'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('countrydistrictgroup/index'); ?>"><?php echo Yii::t('lang', 'back_to_listing'); ?></a></small></h1></li>
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
                    <li class="active"><a href="#country_district_group-add" data-toggle="tab"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country_district_group'); ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="country_district_group-add">                            
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