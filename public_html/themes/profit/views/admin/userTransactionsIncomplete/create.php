<?php
$this->breadcrumbs=array(
	'User Transactions Incompletes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserTransactionsIncomplete','url'=>array('index')),
	array('label'=>'Manage UserTransactionsIncomplete','url'=>array('admin')),
);
?>

<h1>Create UserTransactionsIncomplete</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>