<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Messages','url'=>array('index')),
	array('label'=>'Create Messages','url'=>array('create')),
	array('label'=>'Update Messages','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Messages','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Messages','url'=>array('admin')),
);
?>

<h1>View Messages #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'from_msg',
		'to_msg',
		'subject',
		'message',
		'file',
		'send_time',
		'reading_time',
		'status',
		'trash',
	),
)); ?>
