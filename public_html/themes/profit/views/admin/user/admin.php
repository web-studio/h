<?php
$this->pageTitle = 'Manage Users';
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'role_id',
		'login',
		'email',
		'password',
		'mobile',
		/*
		'first_name',
		'last_name',
		'city',
		'country',
		'street',
		'activekey',
		'createtime',
		'last_visit',
		'internal_purse',
		'perfect_purse',
		'secret',
		'updatetime',
		'status',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
