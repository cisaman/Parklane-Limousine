<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::t('lang', 'parklane') . ' | ' . Yii::t('lang', 'forgot_password');
?>

<div class="col-md-4 col-md-offset-4">
    <div class="login-banner text-center">
        <h1><i class="fa fa-gears"></i> <?php echo Yii::t('lang', 'parklane'); ?></h1>
    </div>
    <div class="portlet portlet-green">
        <div class="portlet-heading login-heading">
            <div class="portlet-title">
                <h4><strong><?php echo Yii::t('lang', 'forgot_password'); ?></strong>
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
                    'id' => 'forgot-password-form',
                    'enableClientValidation' => TRUE,
                    'clientOptions' => array(
                        'validateOnSubmit' => TRUE,
                        'validateOnChange' => TRUE
                    ),
                    'htmlOptions' => array(
                        'autocomplete' => 'off'
                    ),
                ));
                ?>   

                <?php if (Yii::app()->user->hasFlash('message')): ?>
                    <div class="alert alert-<?php echo Yii::app()->user->getFlash('type'); ?>" id="successmsg">
                        <?php echo Yii::app()->user->getFlash('message'); ?>
                    </div>
                <?php endif; ?>


                <div class="form-group">
                    <div style="margin-bottom: 6px;"><?php echo Yii::t('lang', 'email_id'); ?> <span class="required">*</span></div>
                    <input type="text" id="email" name="email" placeholder="<?php echo Yii::t('lang', 'email_id'); ?>" class="form-control">
                    <div style="" id="email_em" class="errorMessage"></div>
                </div>

                <?php echo CHtml::submitButton(Yii::t('lang', 'forgot_password'), array('class' => 'btn btn-lg btn-green btn-block', 'id' => 'btnForgotPassword')); ?>

                <?php $this->endWidget(); ?>
                <br>
                <p class="small text-center">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('dashboard/login'); ?>">
                        <?php echo Yii::t('lang', 'back_to') . ' ' . Yii::t('lang', 'log_in'); ?>
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    }

    $('#email').blur(function() {
        if ($('#email').val() == '') {
            $('#email_em').html('<?php echo Yii::t('lang', 'please_enter') . ' ' . Yii::t('lang', 'email_id') ?>');
        } else {
            if (!isValidEmailAddress($('#email').val())) {
                $('#email_em').html('<?php echo Yii::t('lang', 'msg_valid_email_id') ?>');
            } else {
                $('#email_em').html('');
            }
        }
    });



    $('#btnForgotPassword').on('click', function(e) {
        if ($('#email').val() == '') {
            $('#email_em').html('<?php echo Yii::t('lang', 'please_enter') . ' ' . Yii::t('lang', 'email_id') ?>');
            e.preventDefault();
        } else {
            if (!isValidEmailAddress($('#email').val())) {
                $('#email_em').html('<?php echo Yii::t('lang', 'msg_valid_email_id') ?>');
                e.preventDefault();
            } else {
                $('#email_em').html('');
            }
        }
    });

</script>