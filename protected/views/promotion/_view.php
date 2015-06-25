<?php
/* @var $this PromotionController */
/* @var $data Promotion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->promotion_id), array('view', 'id'=>$data->promotion_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_title')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_file')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_created')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_updated')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_status')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_status); ?>
	<br />


</div>