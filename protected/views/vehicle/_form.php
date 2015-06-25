<?php
$create_url = Yii::app()->createAbsoluteUrl('vehicle/create');
$update_url = Yii::app()->createAbsoluteUrl('vehicle/update/' . $model->vehicle_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'vehicle-form',
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
    'focus' => array($model, 'vehicle_model'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <h3>Basic Information:</h3>
                <hr/>                
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'vehicle_name'); ?>
                    <?php echo $form->textField($model, 'vehicle_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('vehicle_name'))); ?>
                    <?php echo $form->error($model, 'vehicle_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'vehicle_description'); ?>
                    <?php echo $form->textArea($model, 'vehicle_description', array('maxlength' => 500, 'rows' => 12, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('vehicle_description'))); ?>
                    <?php echo $form->error($model, 'vehicle_description', array('class' => 'text-red')); ?>
                    <input type="hidden" name="description" id="description"/>
                </div>                
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'vehicle_status'); ?>
                        <?php echo $form->checkBox($model, 'vehicle_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'vehicle_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div> 
            <div class="col-md-4">
                <h3>Seaters:</h3>
                <hr/>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'vehicle_seater'); ?>
                    <?php echo $form->textField($model, 'vehicle_seater', array('maxlength' => 2, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('vehicle_seater'))); ?>
                    <?php echo $form->error($model, 'vehicle_seater', array('class' => 'text-red')); ?>
                </div>
                <h3>Featured Photo:</h3>
                <hr/>
                <?php
                $flag = 1;
                $path = Utils::getNoImageAvailable();
                if (!empty($model->vehicle_image)) {
                    $path = Utils::getVehicleImageThumb() . $model->vehicle_image;
                    $flag = 0;
                }
                ?>                                        
                <div class="innerdiv">
                    <img id="imagePreview" style="height: 200px;width: 100%" src="<?php echo $path; ?>" class="img-responsive img-profile"/>
                    <span id="span_close">
                        <?php if ($flag == 0) { ?>
                            <span id="close" style="display:none" title="Click here to delete this image"><i class="fa fa-times fa-2x"></i></span>
                        <?php } ?>
                    </span>                                                
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'vehicle_image'); ?>
                    <?php echo $form->fileField($model, 'vehicle_image'); ?>
                    <?php echo $form->error($model, 'vehicle_image', array('class' => 'text-red')); ?>
                    <span class="text-orange">(Please upload photo for the Vehicle.)</span>    
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Vehicle', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Vehicle', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
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
        $('#Vehicle_vehicle_description').summernote({
            name: 'Vehicle_vehicle_description',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
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
                $('#Vehicle_vehicle_description_em_').css('display', 'block');
                $('#Vehicle_vehicle_description_em_').html('Please enter description.');
            } else {
                $('#Vehicle_vehicle_description_em_').css('display', 'none');
                $('#Vehicle_vehicle_description_em_').html('');
                $('#description').val($('.note-editable').html());
            }
        }
    });
</script>


<script type="text/javascript">

    $(function() {

        /*********************************************************/
        /*   Vehicle Image Block Start   */
        /*********************************************************/
        $('#Vehicle_vehicle_image').on('change', function() {
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
                    } else {
                        var reader = new FileReader();
                        reader.readAsDataURL(files[0]);
                        reader.onloadend = function(event) {
                            $("#imagePreview").attr("src", event.target.result);
                            $("#span_close").html('<span id="close" style="display:none" title="Click here to delete this image"><i class="fa fa-times fa-2x"></i></span>');
                        }
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
        $("#imagePreview").mouseover(function() {
            $("#close").show();
        });
        $("#close").mouseover(function() {
            $("#close").show();
        });
        $("#span_close").mouseover(function() {
            $("#close").show();
        });
        $("#close").mouseout(function() {
            $("#close").hide();
        });
        $("#imagePreview").mouseout(function() {
            $("#close").hide();
        });

        $("#close").on("click", function() {
            var img_data = '<?php echo $model->vehicle_image; ?>';
            if (img_data) {
                $.post(
                        '<?php echo Utils::getBaseUrl(); ?>/vehicle/remove',
                        {'id': '<?php echo $model->vehicle_id; ?>'},
                function(data) {
                    if (data == 2) {
                        $('#statusMsg').addClass('alert alert-success').html('Photo deleted successfully.');
                        setTimeout(function() {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                        location.reload();
                    } else {
                        $('#statusMsg').addClass('alert alert-danger').html('System Error.');
                        setTimeout(function() {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                    }
                });
            } else {
                $("#imagePreview").attr("src", '<?php echo!empty($model->vehicle_image) ? Utils::getVehicleImageThumb() . $model->vehicle_image : Utils::getNoImageAvailable() ?>');
                $('#Vehicle_vehicle_image').val('');
                $("#span_close").html("");
            }
        });
        $("#span_close").on("click", function() {
            $("#imagePreview").attr("src", '<?php echo!empty($model->vehicle_image) ? Utils::getVehicleImageThumb() . $model->vehicle_image : Utils::getNoImageAvailable() ?>');
            $('#Vehicle_vehicle_image').val('');
            $("#span_close").html("");
        });
        /*********************************************************/
        /*   Vehicle Image Block End   */
        /*********************************************************/
    });
</script>
<style>
    #close{
        right: 3px;
        position: absolute;
        top: 0px;
        display: block;
        cursor: pointer;
        color: #d82551;
    }
    .innerdiv{
        position: relative;
        width: 100%;
        border: 1px solid #ccc;
        padding: 3px;
    }
    .img-profile{
        margin-bottom: 0px;
    }
</style>