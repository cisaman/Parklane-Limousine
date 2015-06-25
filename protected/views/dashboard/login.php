<?php
$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'log_in_to') . ' ' . Yii::t('lang', 'dashboard');
//$utils = new Utils;
//echo $utils->passwordEncrypt(123456);
?>

<div class="col-md-4 col-md-offset-4">
    <div class="login-banner text-center">
        <h1><i class="fa fa-gears"></i> <?php echo Yii::t('lang', 'parklane'); ?></h1>
    </div>
    <div class="portlet portlet-green">
        <div class="portlet-heading login-heading">
            <div class="portlet-title">
                <h4><strong><?php echo Yii::t('lang', 'log_in_to') . ' ' . Yii::t('lang', 'dashboard'); ?>!</strong>
                </h4>
            </div>
            <div class="portlet-widgets">
                <!--<button class="btn btn-white btn-xs"><i class="fa fa-plus-circle"></i> New User</button>-->
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="portlet-body">

            <div role="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    //'enableAjaxValidation' => TRUE,
                    'enableClientValidation' => TRUE,
                    'clientOptions' => array(
                        'validateOnSubmit' => TRUE,
                        'validateOnChange' => TRUE
                    ),
                    'htmlOptions' => array(
                        'autocomplete' => 'off'
                    ),
                    'focus' => array($model, 'username'),
                ));
                ?>   

                <?php if (Yii::app()->user->hasFlash('msg')): ?>
                    <div class="alert alert-danger" id="successmsg">
                        <?php
                        echo Yii::app()->user->getFlash('msg');
                        $model->password = '';
                        ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <?php //$model->username= 'admin';  ?>
                    <?php echo $form->labelEx($model, 'username'); ?>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username'))); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>

                <div class="form-group">
                    <?php //$model->password = '123456';  ?>
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password'))); ?>
                    <?php echo $form->error($model, 'password'); ?>                    
                </div>              

                <div class="form-group">
                    <?php //echo CHtml::activeLabel($model, 'validacion'); ?>
                    <?php
                    $this->widget('application.extensions.recaptcha.EReCaptcha', array(
                        'model' => $model,
                        'attribute' => 'validation',
                        'theme' => 'red',
                        'publicKey' => '6LcWggYTAAAAADeD2qAPC1lmWgD1lHqV3TJp9W_i'
                    ));
                    ?>
                    <?php echo CHtml::error($model, 'validation'); ?>
                    <div class="errorMessage" id="catcha_error"></div>
                </div>

                <?php echo CHtml::submitButton(Yii::t('lang', 'log_in'), array('class' => 'btn btn-lg btn-green btn-block', 'id' => 'btnLogin')); ?>

                <?php $this->endWidget(); ?>
                <br>
                <p class="small text-center">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/forgotpassword'); ?>">
                        <?php echo Yii::t('lang', 'forgot_your_password?'); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#successmsg").animate({opacity: 1.0}, 2000).fadeOut("slow");

        $('#LoginForm_username').blur(function() {
            if ($('#LoginForm_username_em_').css('display') != 'none') {
                $('#LoginForm_password').val('');
            }
        });

        $('#btnLogin').click(function() {
            if ($('#LoginForm_username_em_').css('display') != 'none') {
                $('#LoginForm_password').val('');
            }

            if ($('#recaptcha_response_field').val() == '') {
                $('#catcha_error').html('Please enter captcha');
                return false;
            }else {
                $('#catcha_error').html('');                
            }
        });
    });
</script>