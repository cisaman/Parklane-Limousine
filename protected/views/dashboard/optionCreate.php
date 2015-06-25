<?php $this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'settings'); ?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'settings'); ?> | <small><a class="text-blue" href="<?php echo Yii::app()->createAbsoluteUrl('creditcard/index'); ?>"><?php echo Yii::t('lang', 'back_to_listing'); ?></a></small></h1></li>
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
                    <li class="active"><a href="#settings-add" data-toggle="tab"><?php echo Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'settings'); ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="settings-add">                            
                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                $create_url = Yii::app()->createAbsoluteUrl('dashboard/add_settings');
                                $update_url = Yii::app()->createAbsoluteUrl('dashboard/update_settings/' . $model->option_id);

                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'credit-card-form',
                                    'action' => ($model->isNewRecord) ? $create_url : $update_url,
                                    //'enableAjaxValidation' => TRUE,
                                    'enableClientValidation' => TRUE,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => TRUE,
                                        'validateOnChange' => TRUE
                                    ),
                                    'htmlOptions' => array(
                                        'autocomplete' => 'off',
                                        'enctype' => 'multipart/form-data',
                                        'role' => 'form'
                                    ),
                                    'focus' => array($model, 'option_value'),
                                ));

                                $flag_1 = ($model->isNewRecord) ? 1 : 0;
                                ?>

                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">        
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'option_name'); ?>
                                                    <?php echo $form->textField($model, 'option_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('option_name'))); ?>
                                                    <?php echo $form->error($model, 'option_name', array('class' => 'text-red')); ?>
                                                </div> 
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'option_value'); ?>
                                                    <?php echo $form->textField($model, 'option_value', array('maxlength' => 16, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('option_value'))); ?>
                                                    <?php echo $form->error($model, 'option_value', array('class' => 'text-red')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'option_description'); ?>
                                                    <?php echo $form->textField($model, 'option_description', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('option_description'))); ?>
                                                    <?php echo $form->error($model, 'option_description', array('class' => 'text-red')); ?>
                                                </div>                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                if ($model->isNewRecord) {
                                                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'settings'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                                                    echo '&nbsp;&nbsp;';
                                                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                                                } else {
                                                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'settings'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                                                }
                                                ?>
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