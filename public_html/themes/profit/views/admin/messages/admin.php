<?php
$this->pageTitle = 'Manage Messages';
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Messages','url'=>array('index')),
	array('label'=>'Create Messages','url'=>array('create')),
);


?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'messages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'from_msg',
		'to_msg',
		'subject',
		'message',
		'file',
		/*
		'send_time',
		'reading_time',
		'status',
		'trash',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
