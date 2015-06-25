<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | Manage Vehicles';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vehicle-grid').yiiGridView('update', {
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
                <li><h1><i class="fa fa-user"></i> Manage Vehicles | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('vehicle/create'); ?>">Add Vehicle</a></small></h1></li>
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
                    <li class="active"><a href="#vehicle-list" data-toggle="tab">List of Vehicles</a></li>                    
                    <!--li class=""><a href="#vehicle-add" data-toggle="tab">Add Vehicle</a></li-->
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="vehicle-list">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'vehicle-grid',
                                        'htmlOptions' => array('class' => 'dataTables_wrapper', 'role' => 'grid'),
                                        'dataProvider' => $model->search(),
                                        'filter' => $model,
                                        'columns' => array(
                                            array(
                                                'header' => 'S. No.',
                                                'name' => 'S. No.',
                                                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                                                'htmlOptions' => array('style' => 'text-align:center'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:60px'),
                                            ),
                                            array(
                                                'header' => $model->getAttributeLabel('vehicle_image'),
                                                'name' => 'vehicle_image',
                                                'type' => 'html',
                                                'value' => '!empty($data->vehicle_image) ? CHtml::image(Utils::getVehicleImageThumb() . $data->vehicle_image, $data->vehicle_image, array("class" => "v_image")) : CHtml::image(Utils::getNoImageAvailable(), "N/A", array("class" => "v_image"))',
                                                'htmlOptions' => array('style' => 'text-align:center'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                                                'filter' => ''
                                            ),                                            
                                            array(
                                                'name' => 'vehicle_name',
                                                'value' => '$data->vehicle_name',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'vehicle_name', array('placeholder' => $model->getAttributeLabel('vehicle_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'vehicle_seater',
                                                'value' => '$data->vehicle_seater',
                                                'htmlOptions' => array('style' => 'width:80px;text-align:center;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;'),
                                                'filter' => CHtml::activeTextField($model, 'vehicle_seater', array('placeholder' => $model->getAttributeLabel('vehicle_seater'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
//                                            array(
//                                                'name' => 'vehicle_description',
//                                                'value' => '$data->vehicle_description',
//                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
//                                                'filter' => CHtml::activeTextField($model, 'vehicle_description', array('placeholder' => $model->getAttributeLabel('vehicle_description'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
//                                            ),
                                            array(
                                                'name' => 'vehicle_status',
                                                'value' => '($data->vehicle_status == 0) ? "Inactive" : "Active"',
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                                                'filter' => CHtml::activeDropDownList($model, 'vehicle_status', array(0 => 'Inactive', 1 => 'Active'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => 'Status'))
                                            ),
                                            array(
                                                'header' => 'Action',
                                                'class' => 'CButtonColumn',
                                                'deleteConfirmation' => 'Do you really want to delete this Vehicle?',
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
                                        'emptyText' => '<span class="text-danger text-center">No Record Found!</span>',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>                                       

                    <!--div class="tab-pane fade" id="vehicle-add">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php //$this->renderPartial('_form', array('model' => $model)); ?>

                            </div>
                        </div>
                    </div-->
                </div>
            </div>            
        </div>
    </div>    
</div>


<style type="text/css">
    .v_image{
        width: 100% !important;
        height: 85px;
        border: 1px solid #ccc;
        padding: 1px;
    }    
</style>
