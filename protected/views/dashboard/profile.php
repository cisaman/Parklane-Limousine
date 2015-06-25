<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'profile');

if (isset(Yii::app()->session['admin_data']['admin_id']) && !empty(Yii::app()->session['admin_data']['admin_id'])) {
    $admin = Admin::getProfile();
}
?>

<!-- begin PAGE TITLE AREA -->
<div class="row">
    <div class="col-lg-12">
        <div class="page-title">            
            <ol class="breadcrumb">
                <li><h1><i class="fa fa-user"></i> <?php echo Yii::t('lang', 'profile'); ?></h1></li>
            </ol>
        </div>
    </div>    
</div>
<!-- end PAGE TITLE AREA -->

<div class="row">
    <div class="col-lg-12">

        <div class="portlet portlet-default">
            <div class="portlet-body">

                <div id="statusMsg"></div>

                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?> alert-dismissable" id="successmsg">
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>

                <ul id="userTab" class="nav nav-tabs">                    
                    <li class="active"><a href="#profile-settings" data-toggle="tab"><?php echo Yii::t('lang', 'update'); ?> <?php echo Yii::t('lang', 'profile'); ?></a></li>
                </ul>
                <div id="userTabContent" class="tab-content">                    
                    <div class="tab-pane fade active in" id="profile-settings">

                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="userSettings" class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> <?php echo Yii::t('lang', 'basic_information'); ?></a></li>
                                    <li class="">
                                        <a href="#profile-photo" data-toggle="tab">
                                            <i class="fa fa-picture-o fa-fw"></i> <?php echo Yii::t('lang', 'profile_photo'); ?></a>
                                        </a>
                                    </li>
                                    <li class=""><a href="#changePassword" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> <?php echo Yii::t('lang', 'change_password'); ?></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div id="userSettingsContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="basicInformation">

                                        <?php
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'personalinformation-form',
                                            'enableClientValidation' => TRUE,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => TRUE,
                                                'validateOnChange' => TRUE
                                            ),
                                            'htmlOptions' => array(
                                                'enctype' => 'multipart/form-data',
                                                'autocomplete' => 'off',
                                                'role' => 'form'
                                            ),
                                            'focus' => array($model, 'admin_name'),
                                        ));
                                        ?>

                                        <h3><?php echo Yii::t('lang', 'basic_information'); ?>:</h3>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'admin_name'); ?>
                                                    <?php echo $form->textField($model, 'admin_name', array('maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('admin_name'))); ?>
                                                    <?php echo $form->error($model, 'admin_name', array('class' => 'text-red')); ?>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'admin_username'); ?>
                                                    <?php echo $form->textField($model, 'admin_username', array('maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('admin_username'))); ?>
                                                    <?php echo $form->error($model, 'admin_username', array('class' => 'text-red')); ?>
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                        <div class="row">                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->labelEx($model, 'admin_email'); ?>
                                                    <?php echo $form->textField($model, 'admin_email', array('maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('admin_email'))); ?>
                                                    <?php echo $form->error($model, 'admin_email', array('class' => 'text-red')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'profile'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSaveProfile', 'name' => 'btnSaveProfile')); ?>
                                        <button class="btn btn-square btn-orange"><?php echo Yii::t('lang', 'reset'); ?></button>

                                        <?php $this->endWidget(); ?>                                        
                                    </div>                                    

                                    <div class="tab-pane fade" id="profile-photo">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php $this->renderPartial('_profilepicture', array('model' => $model)); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="changePassword">                                        
                                        <?php $this->renderPartial('_changepassword', array('model' => $model)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {

        $('#old_password').blur(function() {
            if ($(this).val() == '') {
                $('#old_password_err').html('Please enter Old Password.');
            } else {
                $('#old_password_err').html('');
            }
        });

        $('#new_password').blur(function() {
            if ($(this).val() == '') {
                $('#new_password_err').html('Please enter New Password.');
                $(this).focus();
            } else {
                if ($(this).val().length < 6) {
                    $('#new_password_err').html('Password length should be between 6 to 16 charatcers.');
                    $(this).val('');
                    $(this).focus();
                } else {
                    $('#new_password_err').html('');
                }
            }
        });
        $('#new_password_again').blur(function() {
            if ($('#new_password').val() == '') {
                $('#new_password_err').html('Please enter New Password, then Re-type New Password.');
                $(this).val('');
                $('#new_password').focus();
            } else {
                if ($(this).val() == '') {
                    $('#new_password_again_err').html('Please Re-type New Password.');
                } else {
                    var new1 = $('#new_password').val();
                    var new2 = $(this).val();
                    if (new1 !== new2) {
                        $('#new_password_again_err').html('Both Passwords didn\'t match.');
                        $('#new_password').val('');
                        $(this).val('');
                        $('#new_password').focus();
                    } else {
                        $('#new_password_again_err').html('');
                    }
                }
            }
        });


        function testOldPassword() {
            var otpt = false;
            var value = $('#old_password').val();

            if (value != '') {
                $.ajax({
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/users/checkPassword',
                    type: 'post',
                    data: {value: value},
                    async: false,
                    success: function(data) {
                        if (data == 1) {
                            $('#old_password_error').removeClass('text-red');
                            $('#old_password_error').addClass('text-green');
                            $('#old_password_error').html('Old Password is correct.');
                            otpt = true;
                        } else {
                            $('#old_password_error').addClass('text-red');
                            $('#old_password_error').removeClass('text-green');
                            $('#old_password_error').html('Old Password is incorrect.');
                            otpt = false;
                            //return data;
                        }
                    }
                });
            } else {
                $('#old_password_error').addClass('text-red');
                $('#old_password_error').removeClass('text-green');
                $('#old_password_error').html('');
            }
            return  otpt;
        }


        $('#old_password').click(function() {
            testOldPassword();
        });

        $('#password-form').submit(function() {

            var flag = 0;
            if ($('#old_password').val() == '') {
                $('#old_password_error').html('Please enter Old Password');
                flag++;
            } else {
                $('#old_password_error').html('');
            }
            if ($('#new_password').val() == '') {
                $('#new_password_error').html('Please enter New Password');
                flag++;
            } else if ($('#new_password').val().length < 6) {
                $('#new_password_error').html('New Password is too short.<br/> New Password should be minimum 6 characters long.');
                flag++;
            } else {
                $('#new_password_error').html('');
            }

            if (flag > 0) {
                return false;
            }
        });

        $('input[name=btnPassword]').click(function() {
            //return testOldPassword();
        });


    });

</script>