<?php
$this->breadcrumbs=array(
	'Output Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OutputTransactions','url'=>array('index')),
	array('label'=>'Manage OutputTransactions','url'=>array('admin')),
);
?>

<h1>Create OutputTransactions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>