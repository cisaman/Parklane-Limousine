<?php
$create_url = Yii::app()->createAbsoluteUrl('adhocptop/create');
$update_url = Yii::app()->createAbsoluteUrl('adhocptop/update/' . $model->adhocptop_id);

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
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h3 class="text-dark-blue">
            <?php echo $model->adhocptop_initials . ' ' . $model->adhocptop_passengername; ?>
        </h3>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'adhocptop_model'); ?>                            
            <?php echo $form->dropDownList($model, 'adhocptop_model', Booking::model()->getBookingCarModel(), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('adhocptop_model'), 'options' => array($model->adhocptop_model => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'adhocptop_model', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'adhocptop_licenseplateno'); ?>
            <?php echo $form->dropDownList($model, 'adhocptop_licenseplateno', CHtml::listData(Drivers::model()->findAll(), 'driver_id', 'driver_licenseno'), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('adhocptop_licenseplateno'), 'options' => array($model->adhocptop_licenseplateno => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'adhocptop_licenseplateno', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'adhocptop_drivername'); ?>
            <?php echo $form->dropDownList($model, 'adhocptop_drivername', CHtml::listData(Drivers::model()->findAll(), 'driver_id', 'driver_name'), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('adhocptop_drivername'), 'options' => array($model->adhocptop_drivername => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'adhocptop_drivername', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'adhocptop_surcharge'); ?>
            <?php echo $form->textField($model, 'adhocptop_surcharge', array('class' => 'form-control', 'maxlength' => 5, 'placeholder' => $model->getAttributeLabel('adhocptop_surcharge'))) ?>
            <?php echo $form->error($model, 'adhocptop_surcharge', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'adhocptop_remark'); ?>
            <?php echo $form->textArea($model, 'adhocptop_remark', array('class' => 'form-control', 'maxlength' => 300, 'rows' => 5, 'placeholder' => $model->getAttributeLabel('adhocptop_remark'))) ?>
            <?php echo $form->error($model, 'adhocptop_remark', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php
            if ($model->isNewRecord) {
                echo CHtml::submitButton('Add Booking', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
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


<script type="text/javascript">

    $(function () {
        $('#btnSave').click(function () {

            if ($('#Adhocptop_adhocptop_licenseplateno').val() == '') {
                $('#Adhocptop_adhocptop_licenseplateno_em_').html('Please select License Plate Number.');
                $('#Adhocptop_adhocptop_licenseplateno_em_').show();
                $('#Adhocptop_adhocptop_licenseplateno').focus();
                return false;
            } else {
                $('#Adhocptop_adhocptop_licenseplateno_em_').html('');
                $('#Adhocptop_adhocptop_licenseplateno_em_').hide();
            }

            if ($('#Adhocptop_adhocptop_drivername').val() == '') {
                $('#Adhocptop_adhocptop_drivername_em_').html('Please select Driver.');
                $('#Adhocptop_adhocptop_drivername_em_').show();
                $('#Adhocptop_adhocptop_drivername').focus();
                return false;
            } else {
                $('#Adhocptop_adhocptop_drivername_em_').html('');
                $('#Adhocptop_adhocptop_drivername_em_').hide();
            }

        });
    });

</script>