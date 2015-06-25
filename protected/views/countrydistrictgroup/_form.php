<?php
$create_url = Yii::app()->createAbsoluteUrl('countrydistrictgroup/create');
$update_url = Yii::app()->createAbsoluteUrl('countrydistrictgroup/update/' . $model->group_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'countrydistrictgroup-form',
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
    'focus' => array($model, 'group_name'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'group_name'); ?>
                    <?php echo $form->textField($model, 'group_name', array('maxlength' => 100, 'class' => 'form-control', 'readonly' => TRUE, 'placeholder' => $model->getAttributeLabel('group_name'))); ?>
                    <?php echo $form->error($model, 'group_name', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'group_countryID'); ?>
                    <?php echo $form->dropDownList($model, 'group_countryID', Country::model()->getCountryList(), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('group_countryID'))); ?>
                    <?php echo $form->error($model, 'group_countryID', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group" id="populateDistricts">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'country_district_group'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'country_district_group'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('#Countrydistrictgroup_group_countryID').change(function() {
            var country_id = $(this).val();

            var data = '';
            var state = 'add';

            if (country_id != '') {
                $.ajax({
                    url: '<?php echo Utils::getBaseUrl(); ?>/district/getAllDistrictsByCountryID',
                    data: {country_id: country_id, state: state},
                    type: 'POST',
                    success: function(response) {
                        response = JSON.parse(response);
                        $('#Countrydistrictgroup_group_name').val(response.groupname);
                        $('#populateDistricts').html(response.districts);
                    }
                });
            } else {
                $('#Countrydistrictgroup_group_name').val('');
                $('#populateDistricts').html('');
            }
        });

<?php if (!$model->isNewRecord) { ?>
            var country_id = $('#Countrydistrictgroup_group_countryID').val();

            var data = '';
            var state = 'update';

            if (country_id != '') {
                $.ajax({
                    url: '<?php echo Utils::getBaseUrl(); ?>/district/getAllDistrictsByCountryID',
                    data: {country_id: country_id, state: state},
                    type: 'POST',
                    success: function(response) {
                        response = JSON.parse(response);
                        //$('#Countrydistrictgroup_group_name').val(response.groupname);
                        $('#populateDistricts').html(response.districts);
                    }
                });
            } else {
                //$('#Countrydistrictgroup_group_name').val('');
                $('#populateDistricts').html('');
            }

<?php } ?>

    });
</script>