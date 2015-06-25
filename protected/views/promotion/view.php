<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->promotion_id,
);

$this->menu=array(
	array('label'=>'List Promotion', 'url'=>array('index')),
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'Update Promotion', 'url'=>array('update', 'id'=>$model->promotion_id)),
	array('label'=>'Delete Promotion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->promotion_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promotion', 'url'=>array('admin')),
);
?>

<h1>View Promotion #<?php echo $model->promotion_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'promotion_id',
		'promotion_title',
		'promotion_file',
		'promotion_created',
		'promotion_updated',
		'promotion_status',
	),
)); ?>
