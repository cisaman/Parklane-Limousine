<?php
$create_url = Yii::app()->createAbsoluteUrl('promotion/create');
$update_url = Yii::app()->createAbsoluteUrl('promotion/update/' . $model->promotion_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'promotion-form',
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
    'focus' => array($model, 'promotion_title'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'promotion_title'); ?>
                    <?php echo $form->textField($model, 'promotion_title', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('promotion_title'))); ?>
                    <?php echo $form->error($model, 'promotion_title', array('class' => 'text-red')); ?>
                </div>				
				<div class="form-group">
					<?php echo $form->labelEx($model, 'promotion_file'); ?>
					<?php echo $form->fileField($model, 'promotion_file'); ?>
					<?php echo $form->error($model, 'promotion_file', array('class' => 'text-red')); ?>
					<p class="help-block text-orange">Upload pdf, doc, docx, xls, xlsx, jpg, jpeg, png, gif.</p>
				</div>                
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'promotion_status'); ?>
                        <?php echo $form->checkBox($model, 'promotion_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'promotion_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Promotion', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Promotion', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(function() {      
        $('#Promotion_promotion_file').on('change', function() {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return;

            var ftype = $(this)[0].files[0].type;
            var types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            if ($.inArray(ftype, types) > 0) {
                if (/^image/.test(files[0].type)) {
                    if ($(this)[0].files[0].size > 2097152) {
                        $('#statusMsg').addClass('alert alert-danger').html('The Image Size is too Big. Max size for the image is 2MB');
                        $(this).val('');
                        $("#imagePreview").attr("src", '<?php echo!empty($model->vehicle_image) ? Utils::getVehicleImageThumb() . $model->vehicle_image : Utils::getNoImageAvailable() ?>');
                        setTimeout(function() {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                    }
                } else {
                    $('#statusMsg').addClass('alert alert-danger').html('Please upload a valid Image File.');
                    $(this).val('');
                    $("#imagePreview").attr("src", '<?php echo!empty($model->vehicle_image) ? Utils::getVehicleImageThumb() . $model->vehicle_image : Utils::getNoImageAvailable() ?>');
                    setTimeout(function() {
                        $('#statusMsg').removeClass('alert alert-danger').html('');
                    }, 3000);
                }
            } else {
                $('#statusMsg').addClass('alert alert-danger').html('Please upload a valid Image File.');
                $(this).val('');
                $("#imagePreview").attr("src", '<?php echo!empty($model->vehicle_image) ? Utils::getVehicleImageThumb() . $model->vehicle_image : Utils::getNoImageAvailable() ?>');
                setTimeout(function() {
                    $('#statusMsg').removeClass('alert alert-danger').html('');
                }, 3000);
            }
        });
    });
</script>