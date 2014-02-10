<?php
$this->pageTitle = 'Manage Output Transactions';
$this->breadcrumbs=array(
	'Output Transactions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OutputTransactions','url'=>array('index')),
	array('label'=>'Create OutputTransactions','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'output-transactions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'payee_account_name',
		'payee_account',
		'payment_amount',
		'payment_batch_num',
		/*
		'payment_id',
		'created_time',
		'status',
		'error',
		*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
