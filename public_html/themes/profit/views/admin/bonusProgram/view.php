<?php
$this->breadcrumbs=array(
	'Bonus Programs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BonusProgram','url'=>array('index')),
	array('label'=>'Create BonusProgram','url'=>array('create')),
	array('label'=>'Update BonusProgram','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BonusProgram','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BonusProgram','url'=>array('admin')),
);
?>

<h1>View BonusProgram #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'link',
		'date_create',
		'date_update',
		'status',
	),
)); ?>
