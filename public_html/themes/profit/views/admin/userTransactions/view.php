<?php
$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserTransactions','url'=>array('index')),
	array('label'=>'Create UserTransactions','url'=>array('create')),
	array('label'=>'Update UserTransactions','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete UserTransactions','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserTransactions','url'=>array('admin')),
);
?>

<h1>View UserTransactions #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'amount',
		'amount_type',
		'payment_id',
		'reason',
		'time',
		'amount_after',
		'amount_before',
	),
)); ?>
