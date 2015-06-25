<?php
$create_url = Yii::app()->createAbsoluteUrl('country/create');
$update_url = Yii::app()->createAbsoluteUrl('country/update/' . $model->country_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'country-form',
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
    'focus' => array($model, 'country_name_en'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_name_en'); ?>
                    <?php echo $form->textField($model, 'country_name_en', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_name_en'))); ?>
                    <?php echo $form->error($model, 'country_name_en', array('class' => 'text-red')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_name_ch'); ?>
                    <?php echo $form->textField($model, 'country_name_ch', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_name_ch'))); ?>
                    <?php echo $form->error($model, 'country_name_ch', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'country_price'); ?>
                    <?php echo $form->textField($model, 'country_price', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('country_price'))); ?>
                    <?php echo $form->error($model, 'country_price', array('class' => 'text-red')); ?>
                </div> 
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'country_status'); ?>
                        <?php echo $form->checkBox($model, 'country_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'country_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'country'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>