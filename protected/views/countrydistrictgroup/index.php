<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'country_district_group');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#countrydistrictgroup-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$symbols = array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H', 'I' => 'I', 'J' => 'J',
    'K' => 'K', 'L' => 'L', 'M' => 'M', 'N' => 'N', 'O' => 'O', 'P' => 'P', 'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' => 'T',
    'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X', 'Y' => 'Y', 'Z' => 'Z'
);
?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'manage') . ' ' . Yii::t('lang', 'country_district_group'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('countrydistrictgroup/create'); ?>"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country_district_group') ?></a></small></h1></li>
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
                    <li class="active"><a href="#country_district_group-list" data-toggle="tab"><?php echo Yii::t('lang', 'list_of') . ' ' . Yii::t('lang', 'country_district_group') ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="country_district_group-list">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="table-responsive">
                                    <?php
                                    $this->widget('zii.widgets.grid.CGridView', array(
                                        'id' => 'country-grid',
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
                                                'name' => 'group_name',
                                                'value' => '$data->group_name',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:120px'),
                                                'filter' => CHtml::activeDropDownList($model, 'group_name', $symbols, array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' =>  $model->getAttributeLabel('group_name')))
                                            ),
                                            array(
                                                'name' => 'group_countryID',
                                                'value' => 'Country::model()->getCountryName($data->group_countryID)',
                                                'htmlOptions' => array('style' => 'text-align:center;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;width:150px'),
                                                'filter' => CHtml::activeDropDownList($model, 'group_countryID', Country::model()->getCountryList(), array('style' => 'font-style:italic', 'class' => 'form-control', 'empty' =>  $model->getAttributeLabel('group_countryID')))
                                            ),
                                            array(
                                                'name' => 'group_cities',
                                                'value' => 'Countrydistrictgroup::model()->getDistricts($data->group_cities)',
                                                'htmlOptions' => array('style' => 'text-align:justify;-ms-word-break: break-all;word-break: break-all;'),
                                                'headerHtmlOptions' => array('style' => 'text-align: center;'),
                                                //'filter' => CHtml::activeTextField($model, 'group_cities', array('placeholder' => $model->getAttributeLabel('group_cities'), 'style' => 'font-style:italic', 'autocomplete' => 'off', 'class' => 'form-control'))
                                                'filter' => ''
                                            ),
                                            array(
                                                'header' => Yii::t('lang', 'action'),
                                                'class' => 'CButtonColumn',
                                                'deleteConfirmation' => Yii::t('lang', 'msg_delete_question') . ' ' . Yii::t('lang', 'country') . '?',
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
                </div>
            </div>            
        </div>
    </div>    
</div>