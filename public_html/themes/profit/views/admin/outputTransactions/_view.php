<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payee_account_name')); ?>:</b>
	<?php echo CHtml::encode($data->payee_account_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payee_account')); ?>:</b>
	<?php echo CHtml::encode($data->payee_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_amount')); ?>:</b>
	<?php echo CHtml::encode($data->payment_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_batch_num')); ?>:</b>
	<?php echo CHtml::encode($data->payment_batch_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_id')); ?>:</b>
	<?php echo CHtml::encode($data->payment_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('error')); ?>:</b>
	<?php echo CHtml::encode($data->error); ?>
	<br />

	*/ ?>

</div>