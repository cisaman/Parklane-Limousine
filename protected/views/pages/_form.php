<?php
$create_url = Yii::app()->createAbsoluteUrl('pages/create');
$update_url = Yii::app()->createAbsoluteUrl('pages/update/' . $model->pages_id);

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pages-form',
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
    'focus' => array($model, 'pages_name_en'),
        ));

$flag_1 = ($model->isNewRecord) ? 1 : 0;
?>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pages_name_en'); ?>
                    <?php echo $form->textField($model, 'pages_name_en', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('pages_name_en'))); ?>
                    <?php echo $form->error($model, 'pages_name_en', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group en">
                    <?php echo $form->labelEx($model, 'pages_desc_en'); ?>
                    <?php echo $form->textArea($model, 'pages_desc_en', array('maxlength' => 500, 'rows' => 12, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('pages_desc_en'))); ?>
                    <?php echo $form->error($model, 'pages_desc_en', array('class' => 'text-red')); ?>
                    <input type="hidden" name="description_en" id="description_en" value="<?php echo CHtml::encode($model->pages_desc_en); ?>"/>
                </div>  
                <?php if (!$model->isNewRecord) { ?>                    
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'pages_status'); ?>
                        <?php echo $form->checkBox($model, 'pages_status', array('class' => 'checkbox-inline')); ?>
                        <?php echo $form->error($model, 'pages_status', array('class' => 'text-red')); ?>
                    </div>                    
                <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'pages_name_ch'); ?>
                    <?php echo $form->textField($model, 'pages_name_ch', array('maxlength' => 100, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('pages_name_ch'))); ?>
                    <?php echo $form->error($model, 'pages_name_ch', array('class' => 'text-red')); ?>
                </div>
                <div class="form-group ch">
                    <?php echo $form->labelEx($model, 'pages_desc_ch'); ?>
                    <?php echo $form->textArea($model, 'pages_desc_ch', array('maxlength' => 500, 'rows' => 12, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('pages_desc_ch'))); ?>
                    <?php echo $form->error($model, 'pages_desc_ch', array('class' => 'text-red')); ?>
                    <input type="hidden" name="description_ch" id="description_ch" value="<?php echo CHtml::encode($model->pages_desc_ch); ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($model->isNewRecord) {
                    echo CHtml::submitButton('Add Page', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
                    echo '&nbsp;&nbsp;';
                    echo CHtml::resetButton('Reset', array('class' => 'btn btn-orange btn-square', 'id' => 'btnReset'));
                } else {
                    echo CHtml::submitButton('Update Page', array('class' => 'btn btn-green btn-square', 'id' => 'btnSave'));
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
        $('#Pages_pages_desc_en').summernote({
            name: 'Pages_pages_desc_en',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });
        $('#Pages_pages_desc_ch').summernote({
            name: 'Pages_pages_desc_ch',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });

        $('.en .note-editable').blur(function() {
            checkDescriptionEn();
        });
        $('.ch .note-editable').blur(function() {
            checkDescriptionCh();
        });

        $('.en .note-editable').keypress(function() {
            checkDescriptionEn();
        });
        $('.ch .note-editable').blur(function() {
            checkDescriptionCh();
        });

        function checkDescriptionEn() {
            var length = $('.en .note-editable').html().length;
            if (length == 0) {
                $('#Pages_pages_desc_en_em_').css('display', 'block');
                $('#Pages_pages_desc_en_em_').html('Please enter description.');
            } else {
                $('#Pages_pages_desc_en_em_').css('display', 'none');
                $('#Pages_pages_desc_en_em_').html('');
                $('#description_en').val($('.en .note-editable').html());
            }
        }
        function checkDescriptionCh() {
            var length = $('.ch .note-editable').html().length;
            if (length == 0) {
                $('#Pages_pages_desc_ch_em_').css('display', 'block');
                $('#Pages_pages_desc_ch_em_').html('Please enter description.');
            } else {
                $('#Pages_pages_desc_ch_em_').css('display', 'none');
                $('#Pages_pages_desc_ch_em_').html('');
                $('#description_ch').val($('.ch .note-editable').html());
            }
        }
    });
</script>