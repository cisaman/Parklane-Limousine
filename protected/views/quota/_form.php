<?php
$create_url = Yii::app()->createAbsoluteUrl('quota/create');
$update_url = Yii::app()->createAbsoluteUrl('quota/update/' . $model->quota_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'quota-form',
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
    'focus' => array($model, 'quota_name'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'quota_name'); ?>
                    <?php echo $form->textField($model, 'quota_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('quota_name'))); ?>
                    <?php echo $form->error($model, 'quota_name', array('class' => 'text-red')); ?>
                </div> 
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'quota_desc'); ?>
                    <?php echo $form->textArea($model, 'quota_desc', array('maxlength' => 500, 'rows' => 12, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('quota_desc'))); ?>
                    <?php echo $form->error($model, 'quota_desc', array('class' => 'text-red')); ?>
                    <input type="hidden" name="description" id="description"/>
                </div> 
				<div class="form-group">
					<?php echo $form->labelEx($model, 'quota_image'); ?>
					<?php echo $form->fileField($model, 'quota_image'); ?>
					<?php echo $form->error($model, 'quota_image', array('class' => 'text-red')); ?>
					<p class="help-block text-orange">Upload jpg, jpeg, png or gif for Banners.</p>
				</div> 
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'quota_status'); ?>
                        <?php echo $form->checkBox($model, 'quota_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'quota_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'visa_card') . ' ' . Yii::t('lang', 'quota'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'visa_card') . ' ' . Yii::t('lang', 'quota'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<link href="<?php echo Utils::getStyleUrl(); ?>css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo Utils::getStyleUrl(); ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<script src="<?php echo Utils::getStyleUrl(); ?>js/plugins/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Quota_quota_desc').summernote({
            name: 'Quota_quota_desc',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                /*['para', ['ul', 'ol', 'paragraph']],*/
                ['misc', ['codeview']]
            ]
        });

        $('.note-editable').blur(function() {
            checkDescription();
        });

        $('.note-editable').keypress(function() {
            checkDescription();
        });

        function checkDescription() {
            var length = $('.note-editable').html().length;
            if (length == 0) {
                $('#description').val();
                $('#Quota_quota_desc_em_').css('display', 'block');
                $('#Quota_quota_desc_em_').html('Please enter description.');
            } else {
                $('#Quota_quota_desc_em_').css('display', 'none');
                $('#Quota_quota_desc_em_').html('');
                $('#description').val($('.note-editable').html());
            }
        }
    });
</script>

<script type="text/javascript">

    $(function() {      
        $('#Quota_quota_image').on('change', function() {
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