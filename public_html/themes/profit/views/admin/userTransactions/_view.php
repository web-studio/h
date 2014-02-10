<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_type')); ?>:</b>
	<?php echo CHtml::encode($data->amount_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_after')); ?>:</b>
	<?php echo CHtml::encode($data->amount_after); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_before')); ?>:</b>
	<?php echo CHtml::encode($data->amount_before); ?>
	<br />

	*/ ?>

</div>