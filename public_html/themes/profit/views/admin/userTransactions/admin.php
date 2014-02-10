<?php
$this->pageTitle = 'Manage User Transactions';
$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserTransactions','url'=>array('index')),
	array('label'=>'Create UserTransactions','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-transactions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'amount',
		'amount_type',
		'payment_id',
		'reason',
		/*
		'time',
		'amount_after',
		'amount_before',
		*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
