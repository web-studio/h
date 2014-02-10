<?php
$this->breadcrumbs=array(
	'User Transactions Incompletes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserTransactionsIncomplete','url'=>array('index')),
	array('label'=>'Create UserTransactionsIncomplete','url'=>array('create')),
	array('label'=>'View UserTransactionsIncomplete','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserTransactionsIncomplete','url'=>array('admin')),
);
?>

<h1>Update UserTransactionsIncomplete <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>