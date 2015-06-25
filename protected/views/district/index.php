<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'districts');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#district-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'districts'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('district/create'); ?>"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'district') ?></a></small></h1></li>
            </ol>
        </div>
    </div>    
</div>
<!-- end PAGE TITLE AREA -->

<div class="row">
    <div class="col-lg-12">

        <div class="portlet portlet-default">
            <div class="portlet-body">

                <div id="statusMsg"></div>

                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>

                <ul id="userTab" class="nav nav-tabs">                    
                    <li class="active"><a href="#district-list" data-toggle="tab"><?php echo Yii::t('lang', 'list_of') . ' ' . Yii::t('lang', 'districts') ?></a></li>                    
                    <li class=""><a href="#district-add" data-toggle="tab"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'district') ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="district-list">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'district-grid',
                                        'htmlOptions' => array('class' => 'dataTables_wrapper', 'role' => 'grid'),
                                        'dataProvider' => $model->search(),
                                        'filter' => $model,
                                        'columns' => array(
                                            array(
                                                'header' => '#',
                                                'name' => 'S. No.',
                                                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                                                'htmlOptions' => array('style' => 'text-align:center'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:60px'),
                                            ),
                                            array(
                                                'name' => 'district_countryID',
                                                'value' => 'Country::model()->getCountryName($data->district_countryID)',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeDropDownList($model, 'district_countryID', Country::model()->getCountryList(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('district_countryID')))
                                            ),
                                            array(
                                                'name' => 'district_name_en',
                                                'value' => '$data->district_name_en',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'district_name_en', array('placeholder' => $model->getAttributeLabel('district_name_en'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'district_name_ch',
                                                'value' => '$data->district_name_ch',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'district_name_ch', array('placeholder' => $model->getAttributeLabel('district_name_ch'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'header' => Yii::t('lang', 'price'),
                                                'value' => 'Country::model()->getCountryPrice($data->district_countryID)',
                                                'htmlOptions' => array('style' => 'text-align:right;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                                                'filter' => ''
                                            ),
                                            array(
                                                'name' => 'district_status',
                                                'value' => '($data->district_status == 0) ? "' . Yii::t('lang', 'inactive') . '" : "' . Yii::t('lang', 'active') . '"',
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                                                'filter' => CHtml::activeDropDownList($model, 'district_status', array(0 => Yii::t('lang', 'inactive'), 1 => Yii::t('lang', 'active')), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('district_status')))
                                            ),
                                            array(
                                                'header' => Yii::t('lang', 'action'),
                                                'class' => 'CButtonColumn',
                                                'deleteConfirmation' => Yii::t('lang', 'msg_delete_question') . ' ' . Yii::t('lang', 'district') . '?',
                                                'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:90px'),
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'template' => '{update} {delete}',
                                                //'visible' => Yii::app()->user->name == 'Super Admin',
                                                'buttons' => array
                                                    (
                                                    'update' => array
                                                        (
                                                        'label' => '<i class="fa fa-edit"></i>',
                                                        'options' => array('title' => 'Update'),
                                                        'imageUrl' => FALSE
                                                    ),
                                                    'delete' => array
                                                        (
                                                        'label' => '<i class="fa fa-times"></i>',
                                                        'options' => array('title' => 'Delete', 'class' => 'remove'),
                                                        'imageUrl' => FALSE
                                                    ),
                                                ),
                                            ),
                                        ),
                                        'itemsCssClass' => 'table table-striped table-bordered table-hover table-green dataTable',
                                        'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                                        'summaryCssClass' => 'dataTables_info',
                                        'template' => '{items}<div class = "row"><div class = "col-xs-6">{summary}</div><div class = "col-xs-6">{pager}</div></div>',
                                        'pager' => array(
                                            'htmlOptions' => array('class' => 'pagination', 'id' => ''),
                                            'header' => '',
                                            'cssFile' => false,
                                            'selectedPageCssClass' => 'active',
                                            'previousPageCssClass' => 'prev',
                                            'nextPageCssClass' => 'next',
                                            'hiddenPageCssClass' => 'disabled',
                                            'maxButtonCount' => 5,
                                        ),
                                        'emptyText' => '<span class="text-danger text-center">' . Yii::t('lang', 'no_record_found') . '!</span>',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>                                       

                    <div class="tab-pane fade" id="district-add">                            
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