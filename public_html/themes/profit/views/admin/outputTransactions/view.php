<?php
$this->breadcrumbs=array(
	'Output Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OutputTransactions','url'=>array('index')),
	array('label'=>'Create OutputTransactions','url'=>array('create')),
	array('label'=>'Update OutputTransactions','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete OutputTransactions','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OutputTransactions','url'=>array('admin')),
);
?>

<h1>View OutputTransactions #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'payee_account_name',
		'payee_account',
		'payment_amount',
		'payment_batch_num',
		'payment_id',
		'created_time',
		'status',
		'error',
	),
)); ?>
