<?php
$this->breadcrumbs=array(
	'User Deposits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserDeposit','url'=>array('index')),
	array('label'=>'Create UserDeposit','url'=>array('create')),
	array('label'=>'View UserDeposit','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserDeposit','url'=>array('admin')),
);
?>

<h1>Update UserDeposit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>