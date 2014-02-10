<?php
$this->pageTitle = 'Update DepositType' . $model->id;
$this->breadcrumbs=array(
	'Deposit Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DepositType','url'=>array('index')),
	array('label'=>'Create DepositType','url'=>array('create')),
	array('label'=>'View DepositType','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DepositType','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>