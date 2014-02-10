<?php
$this->breadcrumbs=array(
	'User Deposits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserDeposit','url'=>array('index')),
	array('label'=>'Create UserDeposit','url'=>array('create')),
	array('label'=>'Update UserDeposit','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete UserDeposit','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserDeposit','url'=>array('admin')),
);
?>

<h1>View UserDeposit #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'deposit_type_id',
		'deposit_amount',
		'expire',
		'reinvest',
		'status',
	),
)); ?>
