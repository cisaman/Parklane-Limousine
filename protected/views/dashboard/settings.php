<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'settings'); ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'settings'); ?></h1></li>
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
                    <li class="active"><a href="#settings" data-toggle="tab"><?php echo Yii::t('lang', 'settings'); ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="settings">                            
                        <div class="row">
                            <div class="col-md-12">                                

                                <?php
                                $update_url = Yii::app()->createAbsoluteUrl('dashboard/settings/');

                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'credit-card-form',
                                    'action' => $update_url,
                                    //'enableAjaxValidation' => TRUE,
                                    'enableClientValidation' => TRUE,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => TRUE,
                                        'validateOnChange' => TRUE
                                    ),
                                    'htmlOptions' => array(
                                        'autocomplete' => 'off',
                                        'role' => 'form'
                                    ),
                                ));
                                ?>

                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">        
                                        <div class="row">
                                            <div class="col-md-8">

                                                <?php foreach ($model as $m) { ?>
                                                    <div class="form-group">
                                                        <div><strong><?php echo $m->option_name; ?></strong></div>
                                                        <?php echo $form->textField($m, 'option_value', array('maxlength' => 16, 'class' => 'form-control', 'name' => 'option_' . $m->option_id, 'id' => 'option_' . $m->option_id)); ?>
                                                        <div class="text-dark-blue"><?php echo $m->option_description; ?></div>
                                                    </div>                                                    
                                                <?php } ?>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo CHtml::submitButton(Yii::t('lang', 'save'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                

                                <?php $this->endWidget(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
</div>