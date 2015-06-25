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