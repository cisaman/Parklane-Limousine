<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Booking', 'url'=>array('index')),
	array('label'=>'Create Booking', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bookings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'booking-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'booking_id',
		'booking_service',
		'booking_type',
		'booking_model',
		'booking_initials',
		'booking_passenger_name',
		/*
		'booking_flight_no',
		'booking_eta',
		'booking_countryID',
		'booking_districtID',
		'booking_location',
		'booking_contact_no',
		'booking_email',
		'booking_no_of_passenger',
		'booking_no_of_luggage',
		'booking_created',
		'booking_updated',
		'booking_status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
