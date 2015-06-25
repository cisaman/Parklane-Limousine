<?php
$create_url = Yii::app()->createAbsoluteUrl('lang/create');
$update_url = Yii::app()->createAbsoluteUrl('lang/update/' . $model->lang_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lang-form',
    'action' => ($model->isNewRecord) ? $create_url : $update_url,
    'enableAjaxValidation' => TRUE,
    'enableClientValidation' => TRUE,
    'clientOptions' => array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE
    ),
    'htmlOptions' => array(
        'autocomplete' => 'off',
        'role' => 'form'
    ),
    'focus' => array($model, 'lang_attribute'),
        ));
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-6">               
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'lang_attribute'); ?>
                    <?php echo $form->textField($model, 'lang_attribute', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('lang_attribute'))); ?>
                    <?php echo $form->error($model, 'lang_attribute', array('class' => 'text-red')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'en_t'); ?>
                    <?php echo $form->textField($model, 'en_t', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('en_t'))); ?>
                    <?php echo $form->error($model, 'en_t', array('class' => 'text-red')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'ch_t'); ?>
                    <?php echo $form->textField($model, 'ch_t', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('ch_t'))); ?>
                    <?php echo $form->error($model, 'ch_t', array('class' => 'text-red')); ?>
                </div> 
            </div>            
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Language', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Language', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>