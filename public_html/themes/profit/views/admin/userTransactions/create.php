<?php
$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserTransactions','url'=>array('index')),
	array('label'=>'Manage UserTransactions','url'=>array('admin')),
);
?>

<h1>Create UserTransactions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>