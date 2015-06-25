<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'booking_id'); ?>
		<?php echo $form->textField($model,'booking_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_service'); ?>
		<?php echo $form->textField($model,'booking_service'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_type'); ?>
		<?php echo $form->textField($model,'booking_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_model'); ?>
		<?php echo $form->textField($model,'booking_model'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_initials'); ?>
		<?php echo $form->textField($model,'booking_initials',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_passenger_name'); ?>
		<?php echo $form->textField($model,'booking_passenger_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_flight_no'); ?>
		<?php echo $form->textField($model,'booking_flight_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_eta'); ?>
		<?php echo $form->textField($model,'booking_eta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_countryID'); ?>
		<?php echo $form->textField($model,'booking_countryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_districtID'); ?>
		<?php echo $form->textField($model,'booking_districtID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_location'); ?>
		<?php echo $form->textField($model,'booking_location',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_contact_no'); ?>
		<?php echo $form->textField($model,'booking_contact_no',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_email'); ?>
		<?php echo $form->textField($model,'booking_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_no_of_passenger'); ?>
		<?php echo $form->textField($model,'booking_no_of_passenger'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_no_of_luggage'); ?>
		<?php echo $form->textField($model,'booking_no_of_luggage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_created'); ?>
		<?php echo $form->textField($model,'booking_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_updated'); ?>
		<?php echo $form->textField($model,'booking_updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'booking_status'); ?>
		<?php echo $form->textField($model,'booking_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->