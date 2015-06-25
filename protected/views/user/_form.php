<?php
$create_url = Yii::app()->createAbsoluteUrl('user/create');
$update_url = Yii::app()->createAbsoluteUrl('user/update/' . $model->user_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
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
    'focus' => array($model, 'user_name'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Basic Information:</h3>
                <hr/>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_intial_name'); ?>                            
                            <?php echo $form->dropDownList($model, 'user_intial_name', array('Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss' => 'Miss'), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('user_intial_name'), 'options' => array($model->user_intial_name => array('selected' => true)))) ?>
                            <?php echo $form->error($model, 'user_intial_name', array('class' => 'text-red')); ?>                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_name'); ?>
                            <?php echo $form->textField($model, 'user_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_name'))); ?>
                            <?php echo $form->error($model, 'user_name', array('class' => 'text-red')); ?>
                        </div> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_email'); ?>
                            <?php echo $form->textField($model, 'user_email', array('maxlength' => 100, 'class' => 'form-control', 'disabled' => TRUE, 'placeholder' => $model->getAttributeLabel('user_email'))); ?>
                            <?php echo $form->error($model, 'user_email', array('class' => 'text-red')); ?>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            $utils = new Utils;
                            //echo $utils->passwordDecrypt($model->user_password);
                            $model->user_password = $utils->passwordDecrypt($model->user_password);
                            ?>
                            <?php echo $form->labelEx($model, 'user_password'); ?>
                            <?php echo $form->textField($model, 'user_password', array('maxlength' => 100, 'class' => 'form-control', 'readonly' => TRUE, 'placeholder' => $model->getAttributeLabel('user_password'))); ?>
                            <?php echo $form->error($model, 'user_password', array('class' => 'text-red')); ?>
                        </div>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_country_code'); ?>
                            <?php echo $form->textField($model, 'user_country_code', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_country_code'))); ?>
                            <?php echo $form->error($model, 'user_country_code', array('class' => 'text-red')); ?>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_mobile'); ?>
                            <?php echo $form->textField($model, 'user_mobile', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_mobile'))); ?>
                            <?php echo $form->error($model, 'user_mobile', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </div>

                <h3>VISA Card Information:</h3>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_payment_type'); ?>
                            <?php echo $form->textField($model, 'user_payment_type', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_payment_type'))); ?>
                            <?php echo $form->error($model, 'user_payment_type', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_type'); ?>
                            <?php echo $form->dropDownList($model, 'user_type', CreditCard::model()->getCreditCardType(), array('class' => 'form-control', 'empty' => $model->getAttributeLabel('user_type'), 'options' => array($model->user_type => array('selected' => true)))) ?>
                            <?php echo $form->error($model, 'user_type', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_credit_card'); ?>
                            <?php echo $form->textField($model, 'user_credit_card', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_credit_card'))); ?>
                            <?php echo $form->error($model, 'user_credit_card', array('class' => 'text-red')); ?>
                        </div>               
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_cardholder_name'); ?>
                            <?php echo $form->textField($model, 'user_cardholder_name', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_cardholder_name'))); ?>
                            <?php echo $form->error($model, 'user_cardholder_name', array('class' => 'text-red')); ?>
                        </div>   
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_expiry_month'); ?>
                            <?php echo $form->textField($model, 'user_expiry_month', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_expiry_month'))); ?>
                            <?php echo $form->error($model, 'user_expiry_month', array('class' => 'text-red')); ?>
                        </div>                              
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_expiry_year'); ?>
                            <?php echo $form->textField($model, 'user_expiry_year', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_expiry_year'))); ?>
                            <?php echo $form->error($model, 'user_expiry_year', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </div>

                <h3>Remark:</h3>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'user_remark'); ?>
                            <?php echo $form->textArea($model, 'user_remark', array('maxlength' => 300, 'rows' => 3, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('user_remark'))); ?>
                            <?php echo $form->error($model, 'user_remark', array('class' => 'text-red')); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add User', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update User', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>