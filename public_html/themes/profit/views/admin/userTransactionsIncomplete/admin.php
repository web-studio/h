<?php
$this->pageTitle = 'Manage User Transactions Incompletes';
$this->breadcrumbs=array(
	'User Transactions Incompletes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserTransactionsIncomplete','url'=>array('index')),
	array('label'=>'Create UserTransactionsIncomplete','url'=>array('create')),
);

?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-transactions-incomplete-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'payment_id',
		'amount',
		'payer',
		'hash',
		/*
		'reason',
		'time',
		*/
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
