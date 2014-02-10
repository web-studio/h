<?php
$this->pageTitle = 'Manage User Deposits';
$this->breadcrumbs=array(
	'User Deposits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserDeposit','url'=>array('index')),
	array('label'=>'Create UserDeposit','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-deposit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'deposit_type_id',
		'deposit_amount',
		'expire',
		'reinvest',
		/*
		'status',
		*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
