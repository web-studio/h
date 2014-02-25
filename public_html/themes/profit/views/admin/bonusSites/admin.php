<?php
$this->pageTitle = 'Manage Bonus Sites';
$this->breadcrumbs=array(
	'Bonus Sites'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BonusSites','url'=>array('index')),
	array('label'=>'Create BonusSites','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bonus-sites-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'url',
		'title',
		'status',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
