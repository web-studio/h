<?php
$this->pageTitle = 'Create DepositType';
$this->breadcrumbs=array(
	'Deposit Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DepositType','url'=>array('index')),
	array('label'=>'Manage DepositType','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>