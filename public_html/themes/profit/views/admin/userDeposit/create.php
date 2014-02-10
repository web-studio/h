<?php
$this->breadcrumbs=array(
	'User Deposits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserDeposit','url'=>array('index')),
	array('label'=>'Manage UserDeposit','url'=>array('admin')),
);
?>

<h1>Create UserDeposit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>