<?php
$this->breadcrumbs=array(
	'User Transactions Incompletes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserTransactionsIncomplete','url'=>array('index')),
	array('label'=>'Create UserTransactionsIncomplete','url'=>array('create')),
	array('label'=>'Update UserTransactionsIncomplete','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete UserTransactionsIncomplete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserTransactionsIncomplete','url'=>array('admin')),
);
?>

<h1>View UserTransactionsIncomplete #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'payment_id',
		'amount',
		'payer',
		'hash',
		'reason',
		'time',
	),
)); ?>
