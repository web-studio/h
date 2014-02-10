<?php
$this->breadcrumbs=array(
	'Deposit Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List DepositType','url'=>array('index')),
	array('label'=>'Create DepositType','url'=>array('create')),
	array('label'=>'Update DepositType','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete DepositType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DepositType','url'=>array('admin')),
);
?>

<h1>View DepositType #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'days',
		'percent',
		'min_amount',
		'max_amount',
		'status',
		'total_return',
	),
)); ?>
