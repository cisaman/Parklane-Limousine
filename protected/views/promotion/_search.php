<?php
/* @var $this PromotionController */
/* @var $model Promotion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'promotion_id'); ?>
		<?php echo $form->textField($model,'promotion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'promotion_title'); ?>
		<?php echo $form->textField($model,'promotion_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'promotion_file'); ?>
		<?php echo $form->textField($model,'promotion_file',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'promotion_created'); ?>
		<?php echo $form->textField($model,'promotion_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'promotion_updated'); ?>
		<?php echo $form->textField($model,'promotion_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'promotion_status'); ?>
		<?php echo $form->textField($model,'promotion_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->