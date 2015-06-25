<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'drivers');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#driver-grid').yiiGridView('update', {
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
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'drivers'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('drivers/create'); ?>"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'driver') ?></a></small></h1></li>
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
                    <li class="active"><a href="#driver-list" data-toggle="tab"><?php echo Yii::t('lang', 'list_of') . ' ' . Yii::t('lang', 'drivers') ?></a></li>                    
                    <li class=""><a href="#driver-add" data-toggle="tab"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'driver') ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="driver-list">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'drivers-grid',
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
                                                'name' => 'driver_name',
                                                'value' => '$data->driver_name',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'driver_name', array('placeholder' => $model->getAttributeLabel('driver_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'driver_licenseno',
                                                'value' => '$data->driver_licenseno',
                                                'htmlOptions' => array('style' => 'text-align:left;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:400px'),
                                                'filter' => CHtml::activeTextField($model, 'driver_licenseno', array('placeholder' => $model->getAttributeLabel('driver_licenseno'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'header' => 'Modify',
                                                'class' => 'CButtonColumn',
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'template' => '{update}',
                                                'buttons' => array
                                                    (
                                                    'update' => array
                                                        (
                                                        'label' => '<i class="fa fa-edit"></i>',
                                                        'options' => array('title' => 'Change Car Model'),
                                                        'imageUrl' => FALSE
                                                    ),
                                                ),
                                            ),
                                            array(
                                                'header' => 'Delete',
                                                'class' => 'CButtonColumn',
                                                'deleteConfirmation' => Yii::t('lang', 'msg_delete_question') . ' ' . Yii::t('lang', 'driver') . '?',
                                                'afterDelete' => 'function(link,success,data){ if(success) { $("#statusMsg").css("display", "block"); $("#statusMsg").html(data); $("#statusMsg").animate({opacity: 1.0}, 3000).fadeOut("fast");}}',
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'template' => '{delete}',
                                                'buttons' => array
                                                    (
                                                    'delete' => array
                                                        (
                                                        'label' => '<i class="fa fa-times"></i>',
                                                        'options' => array('title' => 'Delete', 'class' => 'remove'),
                                                        'imageUrl' => FALSE
                                                    )
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

                    <div class="tab-pane fade" id="driver-add">                            
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