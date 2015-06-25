<?php
$create_url = Yii::app()->createAbsoluteUrl('district/create');
$update_url = Yii::app()->createAbsoluteUrl('district/update/' . $model->district_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'district-form',
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
    'focus' => array($model, 'district_name_en'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'district_countryID'); ?>
                    <?php if (Yii::app()->user->getState('lang') == 'en') { ?>
                        <?php echo $form->dropDownList($model, 'district_countryID', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name_en'), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('district_countryID'))); ?>
                    <?php } else { ?>
                        <?php echo $form->dropDownList($model, 'district_countryID', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name_ch'), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('district_countryID'))); ?>
                    <?php } ?>
                    <?php echo $form->error($model, 'district_countryID', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'district_name_en'); ?>
                    <?php echo $form->textField($model, 'district_name_en', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('district_name_en'))); ?>
                    <?php echo $form->error($model, 'district_name_en', array('class' => 'text-red')); ?>
                </div>                   
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'district_name_ch'); ?>
                    <?php echo $form->textField($model, 'district_name_ch', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('district_name_ch'))); ?>
                    <?php echo $form->error($model, 'district_name_ch', array('class' => 'text-red')); ?>
                </div>                   
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'district_status'); ?>
                        <?php echo $form->checkBox($model, 'district_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'district_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'district'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'district'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>