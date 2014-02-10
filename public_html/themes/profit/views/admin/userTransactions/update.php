<?php
$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserTransactions','url'=>array('index')),
	array('label'=>'Create UserTransactions','url'=>array('create')),
	array('label'=>'View UserTransactions','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserTransactions','url'=>array('admin')),
);
?>

<h1>Update UserTransactions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>