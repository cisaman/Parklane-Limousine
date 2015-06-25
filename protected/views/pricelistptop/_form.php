<?php
$create_url = Yii::app()->createAbsoluteUrl('pricelistptop/create');
$update_url = Yii::app()->createAbsoluteUrl('pricelistptop/update/' . $model->ptop_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pricelistptop-form',
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
    'focus' => array($model, 'ptop_from_countryID'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">        
        <div class="row">
            <div class="col-md-8">                
                <div class="form-ptop">
                    <?php echo $form->labelEx($model, 'ptop_from_countryID'); ?>
                    <?php echo $form->dropDownList($model, 'ptop_from_countryID', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('ptop_from_countryID'))); ?>
                    <?php echo $form->error($model, 'ptop_from_countryID', array('class' => 'text-red')); ?>
                </div>
                <div class="form-ptop" id="populateGroupForFrom">

                </div>
                <div class="form-ptop">
                    <?php echo $form->labelEx($model, 'ptop_to_countryID'); ?>
                    <?php echo $form->dropDownList($model, 'ptop_to_countryID', CHtml::listData(Country::model()->findAll(), 'country_id', 'country_name'), array('class' => 'form-control', 'empty' =>  $model->getAttributeLabel('ptop_to_countryID'))); ?>
                    <?php echo $form->error($model, 'ptop_to_countryID', array('class' => 'text-red')); ?>
                </div>
                <div class="form-ptop" id="populateGroupForTo">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton(Yii::t('lang', 'add') . ' ' . Yii::t('lang', 'pricelistptop'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton(Yii::t('lang', 'reset'), array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton(Yii::t('lang', 'update') . ' ' . Yii::t('lang', 'pricelistptop'), array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function() {

        $('#Pricelistptop_ptop_from_countryID').change(function() {
            var country_id = $(this).val();
            
            var state = 'add';

            if (country_id != '') {
                $.ajax({
                    url: '<?php echo Utils::getBaseUrl(); ?>/district/getAllGroupsByCountryID',
                    data: {country_id: country_id, state: state},
                    type: 'POST',
                    success: function(response) {
                        response = JSON.parse(response);                        
                        $('#populateGroupForFrom').html(response.districts);
                    }
                });
            } else {                
                $('#populateGroupForFrom').html('');
            }
        });

<?php if (!$model->isNewRecord) { ?>
            var country_id = $('#Countrydistrictptop_ptop_from_countryID').val();

            var data = '';
            var state = 'update';

            if (country_id != '') {
                $.ajax({
                    url: '<?php echo Utils::getBaseUrl(); ?>/district/getAllDistrictsByCountryID',
                    data: {country_id: country_id, state: state},
                    type: 'POST',
                    success: function(response) {
                        response = JSON.parse(response);
                        //$('#Countrydistrictptop_ptop_from_countryID').val(response.ptopname);
                        $('#populateDistricts').html(response.districts);
                    }
                });
            } else {
                //$('#Countrydistrictptop_ptop_from_countryID').val('');
                $('#populateDistricts').html('');
            }

<?php } ?>

    });
</script>