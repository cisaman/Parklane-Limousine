<?php
$create_url = Yii::app()->createAbsoluteUrl('creditcard/create');
$update_url = Yii::app()->createAbsoluteUrl('creditcard/update/' . $model->credit_card_id);

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
    'focus' => array($model, 'credit_card_bank'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'credit_card_bank'); ?>
                    <?php echo $form->textField($model, 'credit_card_bank', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('credit_card_bank'))); ?>
                    <?php echo $form->error($model, 'credit_card_bank', array('class' => 'text-red')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'credit_card_number'); ?>
                    <?php echo $form->textField($model, 'credit_card_number', array('maxlength' => 16, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('credit_card_number'))); ?>
                    <?php echo $form->error($model, 'credit_card_number', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'credit_card_type'); ?>
                    <?php echo $form->dropDownList($model, 'credit_card_type', CreditCard::model()->getCreditCardType(), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('credit_card_type'))); ?>
                    <?php //echo $form->textField($model, 'credit_card_type', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('credit_card_type'))); ?>
                    <?php echo $form->error($model, 'credit_card_type', array('class' => 'text-red')); ?>
                </div>
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'credit_card_status'); ?>
                        <?php echo $form->checkBox($model, 'credit_card_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'credit_card_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'credit_card'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'credit_card'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>