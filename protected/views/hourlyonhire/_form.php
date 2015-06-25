<?php
$create_url = Yii::app()->createAbsoluteUrl('hourlyonhire/create');
$update_url = Yii::app()->createAbsoluteUrl('hourlyonhire/update/' . $model->hourlyonhire_id);

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
            <?php echo $model->hourlyonhire_initials . ' ' . $model->hourlyonhire_passengername; ?>
        </h3>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'hourlyonhire_model'); ?>                            
            <?php echo $form->dropDownList($model, 'hourlyonhire_model', Booking::model()->getBookingCarModel(), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('hourlyonhire_model'), 'options' => array($model->hourlyonhire_model => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'hourlyonhire_model', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'hourlyonhire_licenseplateno'); ?>
            <?php echo $form->dropDownList($model, 'hourlyonhire_licenseplateno', CHtml::listData(Drivers::model()->findAll(), 'driver_id', 'driver_licenseno'), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('hourlyonhire_licenseplateno'), 'options' => array($model->hourlyonhire_licenseplateno => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'hourlyonhire_licenseplateno', array('class' => 'text-red')); ?>                            
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'hourlyonhire_drivername'); ?>
            <?php echo $form->dropDownList($model, 'hourlyonhire_drivername', CHtml::listData(Drivers::model()->findAll(), 'driver_id', 'driver_name'), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('hourlyonhire_drivername'), 'options' => array($model->hourlyonhire_drivername => array('selected' => true)))) ?>
            <?php echo $form->error($model, 'hourlyonhire_drivername', array('class' => 'text-red')); ?>                            
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'hourlyonhire_totalhours'); ?>                            
                    <?php echo $form->textField($model, 'hourlyonhire_totalhours', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_totalhours'))) ?>
                    <?php echo $form->error($model, 'hourlyonhire_totalhours', array('class' => 'text-red')); ?>                            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'hourlyonhire_parkingfee'); ?>                            
                    <?php echo $form->textField($model, 'hourlyonhire_parkingfee', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_parkingfee'))) ?>
                    <?php echo $form->error($model, 'hourlyonhire_parkingfee', array('class' => 'text-red')); ?>                            
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'hourlyonhire_toll'); ?>                            
                    <?php echo $form->textField($model, 'hourlyonhire_toll', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_toll'))) ?>
                    <?php echo $form->error($model, 'hourlyonhire_toll', array('class' => 'text-red')); ?>                            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'hourlyonhire_tolls'); ?>                            
                    <?php echo $form->textField($model, 'hourlyonhire_tolls', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_tolls'))) ?>
                    <?php echo $form->error($model, 'hourlyonhire_tolls', array('class' => 'text-red')); ?>                            
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'hourlyonhire_surcharge'); ?>                            
                    <?php echo $form->textField($model, 'hourlyonhire_surcharge', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_surcharge'))) ?>
                    <?php echo $form->error($model, 'hourlyonhire_surcharge', array('class' => 'text-red')); ?>                            
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'hourlyonhire_remark'); ?>                            
            <?php echo $form->textArea($model, 'hourlyonhire_remark', array('maxlength' => 300, 'rows' => 4, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('hourlyonhire_remark'))) ?>
            <?php echo $form->error($model, 'hourlyonhire_remark', array('class' => 'text-red')); ?>                            
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

            if ($('#Hourlyonhire_hourlyonhire_licenseplateno').val() == '') {
                $('#Hourlyonhire_hourlyonhire_licenseplateno_em_').html('Please select License Plate Number.');
                $('#Hourlyonhire_hourlyonhire_licenseplateno_em_').show();
                $('#Hourlyonhire_hourlyonhire_licenseplateno').focus();
                return false;
            } else {
                $('#Hourlyonhire_hourlyonhire_licenseplateno_em_').html('');
                $('#Hourlyonhire_hourlyonhire_licenseplateno_em_').hide();
            }

            if ($('#Hourlyonhire_hourlyonhire_drivername').val() == '') {
                $('#Hourlyonhire_hourlyonhire_drivername_em_').html('Please select Driver.');
                $('#Hourlyonhire_hourlyonhire_drivername_em_').show();
                $('#Hourlyonhire_hourlyonhire_drivername').focus();
                return false;
            } else {
                $('#Hourlyonhire_hourlyonhire_drivername_em_').html('');
                $('#Hourlyonhire_hourlyonhire_drivername_em_').hide();
            }

            if ($('#Hourlyonhire_hourlyonhire_totalhours').val() == '') {
                $('#Hourlyonhire_hourlyonhire_totalhours_em_').html('Please enter Total Hours.');
                $('#Hourlyonhire_hourlyonhire_totalhours_em_').show();
                $('#Hourlyonhire_hourlyonhire_totalhours').focus();
                return false;
            } else {
                $('#Hourlyonhire_hourlyonhire_totalhours_em_').html('');
                $('#Hourlyonhire_hourlyonhire_totalhours_em_').hide();
            }

        });
    });

</script>