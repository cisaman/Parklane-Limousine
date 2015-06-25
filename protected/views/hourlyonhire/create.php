<?php
/* @var $this HourlyonhireController */
/* @var $model Hourlyonhire */

$this->breadcrumbs=array(
	'Hourlyonhires'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hourlyonhire', 'url'=>array('index')),
	array('label'=>'Manage Hourlyonhire', 'url'=>array('admin')),
);
?>

<h1>Create Hourlyonhire</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>