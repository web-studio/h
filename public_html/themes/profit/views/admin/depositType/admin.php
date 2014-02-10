<?php
$this->pageTitle = 'Manage Deposit Types';
$this->breadcrumbs=array(
	'Deposit Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DepositType','url'=>array('index')),
	array('label'=>'Create DepositType','url'=>array('create')),
);

?>
<div class="btn-toolbar">
    <?php echo CHtml::link('Create deposit type', array('create'), array('class' => 'btn')) ?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'deposit-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'description',
		'days',
		'percent',
		'min_amount',
		/*
		'max_amount',
		'status',
		'total_return',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
