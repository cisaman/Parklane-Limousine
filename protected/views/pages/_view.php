<?php
/* @var $this PagesController */
/* @var $data Pages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pages_id), array('view', 'id'=>$data->pages_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_name')); ?>:</b>
	<?php echo CHtml::encode($data->pages_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_desc')); ?>:</b>
	<?php echo CHtml::encode($data->pages_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_created')); ?>:</b>
	<?php echo CHtml::encode($data->pages_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_updated')); ?>:</b>
	<?php echo CHtml::encode($data->pages_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages_status')); ?>:</b>
	<?php echo CHtml::encode($data->pages_status); ?>
	<br />


</div>