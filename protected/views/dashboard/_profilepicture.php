<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'profilepicture-form',
    'action' => 'profile',
    'enableClientValidation' => TRUE,
    'clientOptions' => array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE
    ),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'autocomplete' => 'off',
        'role' => 'form'
        )));
?>

<div class="row">
    <div class="col-md-12">                                                
        <h3><?php echo Yii::t('lang', 'profile_photo'); ?>:</h3>
        <hr/>
        <?php
        $flag = 1;
        $path = Utils::UserImagePath_M();
        if (!empty($model->admin_image)) {
            $path = Utils::UserImagePath() . $model->admin_image;
            $flag = 0;
        }
        ?>                                        
        <div class="innerdiv">
            <img id="imagePreview" style="height: 300px;width: 100%" src="<?php echo $path; ?>" class="img-responsive img-profile"/>
            <span id="span_close">
                <?php if ($flag == 0) { ?>
                    <span id="close" style="display:none" title="Click here to delete this image"><i class="fa fa-times fa-2x"></i></span>
                <?php } ?>
            </span>                                                
        </div>
        <br>                                                                                    
        <div class="form-group">
            <?php echo $form->fileField($model, 'admin_image'); ?>
            <?php echo $form->error($model, 'user_image', array('class' => 'text-red')); ?>
            <p class="help-block text-orange"><?php echo Yii::t('lang', 'msg_images'); ?></p>
        </div>                                        

        <?php echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'profile_photo'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSaveProfilePicture', 'name' => 'btnSaveProfilePicture')); ?>
        <button class="btn btn-square btn-orange"><?php echo Yii::t('lang', 'reset'); ?></button>

    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

    $(function() {

        /*********************************************************/
        /*   User Image Block Start   */
        /*********************************************************/
        $('#Admin_admin_image').on('change', function() {
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
                        $("#imagePreview").attr("src", '<?php echo!empty($model->admin_image) ? Utils::UserImagePath() . $model->admin_image : Utils::UserImagePath_M(); ?>');
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
                    $("#imagePreview").attr("src", '<?php echo!empty($model->admin_image) ? Utils::UserImagePath() . $model->admin_image : Utils::UserImagePath_M() ?>');
                    setTimeout(function() {
                        $('#statusMsg').removeClass('alert alert-danger').html('');
                    }, 3000);
                }
            } else {
                $('#statusMsg').addClass('alert alert-danger').html('Please upload a valid Image File.');
                $(this).val('');
                $("#imagePreview").attr("src", '<?php echo!empty($model->admin_image) ? Utils::UserImagePath() . $model->admin_image : Utils::UserImagePath_M(); ?>');
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
            var img_data = '<?php echo $model->admin_image; ?>';
            if (img_data) {
                $.post(
                        '<?php echo Yii::app()->request->baseUrl; ?>/dashboard/removeImage',
                        {'id': '<?php echo $model->admin_id; ?>'},
                function(data) {
                    if (data == 1) {
                        $('#statusMsg').addClass('alert alert-success').html('Photo deleted successfully.');
                        setTimeout(function() {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                        //window.location.reload();
                    } else {
                        $('#statusMsg').addClass('alert alert-danger').html('System Error.');
                        setTimeout(function() {
                            $('#statusMsg').removeClass('alert alert-danger').html('');
                        }, 3000);
                    }
                });
            } else {
                $("#imagePreview").attr("src", '<?php echo Utils::UserImagePath_M() ?>');
                $('#Admin_admin_image').val('');
                $("#span_close").html("");
            }
        });

        $("#span_close").on("click", function() {
            $("#imagePreview").attr("src", '<?php echo Utils::UserImagePath_M() ?>');
            $('#Admin_admin_image').val('');
            $("#span_close").html("");
        });
        /*********************************************************/
        /*   User Image Block End   */
        /*********************************************************/
    });
</script>
<style>
    #close{
        right: 0;
        position: absolute;
        top: -2px;
        display: block;
        cursor: pointer;
        color: #d82551;
    }
    .innerdiv{
        position: relative;
        width: 280px;
        /*        height: 350px;*/
        margin: 0 auto;
        text-align: center;
        border: 1px solid #ccc;
        padding: 4px;
    }
</style>