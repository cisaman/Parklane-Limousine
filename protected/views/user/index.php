<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | Manage Users';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
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
                <li><h1><i class="fa fa-user"></i> Manage Users </h1></li>
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
                    <li class="active"><a href="#user-list" data-toggle="tab">List of Users</a></li>                    
                    <!--li class=""><a href="#user-add" data-toggle="tab">Add User</a></li-->
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="user-list">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'user-grid',
                                        'htmlOptions' => array('class' => 'dataTables_wrapper sampleScroll', 'role' => 'grid'),
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
                                                'name' => 'user_intial_name',
                                                'value' => '$data->user_intial_name',
                                                'htmlOptions' => array('style' => 'text-align:justify;width:80px;'),
                                                'filter' => CHtml::activeDropDownList($model, 'user_intial_name', array('Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss' => 'Miss'), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('user_intial_name')))
                                            ),
                                            array(
                                                'name' => 'user_name',
                                                'value' => '$data->user_name',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'user_name', array('placeholder' => $model->getAttributeLabel('user_name'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'user_email',
                                                'value' => '$data->user_email',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'user_email', array('placeholder' => $model->getAttributeLabel('user_email'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
//                                            array(
//                                                'name' => 'user_country_code',
//                                                'value' => '$data->user_country_code',
//                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
//                                                'filter' => CHtml::activeTextField($model, 'user_country_code', array('placeholder' => $model->getAttributeLabel('user_country_code'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
//                                            ),
                                            array(
                                                'name' => 'user_mobile',
                                                'value' => '$data->user_country_code." ".$data->user_mobile',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'filter' => CHtml::activeTextField($model, 'user_mobile', array('placeholder' => $model->getAttributeLabel('user_mobile'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'name' => 'user_type',
                                                'value' => 'CreditCard::model()->getCreditCardType($data->user_type)',
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                'filter' => CHtml::activeDropDownList($model, 'user_status', CreditCard::model()->getCreditCardType(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' => $model->getAttributeLabel('user_type')))
                                            ),
                                            array(
                                                'name' => 'user_created_date',
                                                'value' => '$data->user_created_date',
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                'filter' => CHtml::activeTextField($model, 'user_created_date', array('placeholder' => $model->getAttributeLabel('user_created_date'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                            ),
                                            array(
                                                'header' => 'View',
                                                'class' => 'CButtonColumn',
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:70px'),
                                                'htmlOptions' => array('style' => 'text-align:center;'),
                                                'template' => '{view}',
                                                'buttons' => array
                                                    (
                                                    'view' => array
                                                        (
                                                        'label' => '<i class="fa fa-search"></i>',
                                                        'options' => array('title' => 'View'),
                                                        'imageUrl' => FALSE
                                                    ),
                                                ),
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
                                                'deleteConfirmation' => Yii::t('lang', 'msg_delete_question') . ' ' . Yii::t('lang', 'users') . '?',
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
                                        'itemsCssClass' => 'table table-bordered table-green dataTable',
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

                    <!--div class="tab-pane fade" id="user-add">                            
                        <div class="row">
                            <div class="col-md-12">

                    <?php //$this->renderPartial('_form', array('model' => $model));   ?>

                            </div>
                        </div>
                    </div-->
                </div>
            </div>            
        </div>
    </div>    
</div>


<style type="text/css">
    .v_image{width: 100% !important;height: 70px;border: 1px solid #ccc;padding: 1px;}    
    .sampleScroll table{width: 1300px;}
</style>
