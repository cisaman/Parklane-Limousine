<?php
$create_url = Yii::app()->createAbsoluteUrl('booking/create');
$update_url = Yii::app()->createAbsoluteUrl('booking/update/' . $model->booking_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'booking-form',
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
    'focus' => array($model, 'booking_name'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h4 class="text-dark-blue">
            <?php echo $model->booking_initials . ' ' . $model->booking_passenger_name; ?>
        </h4>
        <hr/>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'booking_model'); ?>                            
            <?php echo $form->dropDownList($model, 'booking_model', Booking::model()->getBookingCarModel(), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('booking_model'), 'options' => array($model->booking_model => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'booking_model', array('class' => 'text-red')); ?>                            
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'booking_remark'); ?>                            
            <?php echo $form->textArea($model, 'booking_remark', array('maxlength' => 500, 'rows' => 4, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('booking_remark'))) ?>
            <?php echo $form->error($model, 'booking_remark', array('class' => 'text-red')); ?>                            
        </div>

        <div class="form-group">
            <?php
            if ($model->isNewRecord) {
                echo CHtml::submitButton('Add', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                echo '&nbsp;&nbsp;';
                echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
            } else {
                echo CHtml::submitButton('Update', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
            }
            ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>