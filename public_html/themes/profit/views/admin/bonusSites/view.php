<?php
$this->breadcrumbs=array(
	'Bonus Sites'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BonusSites','url'=>array('index')),
	array('label'=>'Create BonusSites','url'=>array('create')),
	array('label'=>'Update BonusSites','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BonusSites','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BonusSites','url'=>array('admin')),
);
?>

<h1>View BonusSites #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'title',
		'status',
	),
)); ?>
