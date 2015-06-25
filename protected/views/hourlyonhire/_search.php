<?php
/* @var $this HourlyonhireController */
/* @var $model Hourlyonhire */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_id'); ?>
		<?php echo $form->textField($model,'hourlyonhire_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_model'); ?>
		<?php echo $form->textField($model,'hourlyonhire_model'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_initials'); ?>
		<?php echo $form->textField($model,'hourlyonhire_initials',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_passengername'); ?>
		<?php echo $form->textField($model,'hourlyonhire_passengername',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_pickupdatetime'); ?>
		<?php echo $form->textField($model,'hourlyonhire_pickupdatetime',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_pickuppoint'); ?>
		<?php echo $form->textField($model,'hourlyonhire_pickuppoint',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_noofhours'); ?>
		<?php echo $form->textField($model,'hourlyonhire_noofhours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_contactno'); ?>
		<?php echo $form->textField($model,'hourlyonhire_contactno',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_email'); ?>
		<?php echo $form->textField($model,'hourlyonhire_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_noofpassengers'); ?>
		<?php echo $form->textField($model,'hourlyonhire_noofpassengers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_noofluggages'); ?>
		<?php echo $form->textField($model,'hourlyonhire_noofluggages'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_amount'); ?>
		<?php echo $form->textField($model,'hourlyonhire_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_created_date'); ?>
		<?php echo $form->textField($model,'hourlyonhire_created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_updated_date'); ?>
		<?php echo $form->textField($model,'hourlyonhire_updated_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourlyonhire_status'); ?>
		<?php echo $form->textField($model,'hourlyonhire_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->