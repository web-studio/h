<?php
$this->pageTitle = 'Manage Referrals';
$this->breadcrumbs=array(
	'Referrals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Referral','url'=>array('index')),
	array('label'=>'Create Referral','url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'referral-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'ref_id',
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
