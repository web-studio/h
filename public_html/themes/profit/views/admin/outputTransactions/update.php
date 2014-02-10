<?php
$this->breadcrumbs=array(
	'Output Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OutputTransactions','url'=>array('index')),
	array('label'=>'Create OutputTransactions','url'=>array('create')),
	array('label'=>'View OutputTransactions','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage OutputTransactions','url'=>array('admin')),
);
?>

<h1>Update OutputTransactions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>