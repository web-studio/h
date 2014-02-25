<?php
$this->breadcrumbs=array(
	'Bonus Programs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BonusProgram','url'=>array('index')),
	array('label'=>'Manage BonusProgram','url'=>array('admin')),
);
?>

<h1>Create BonusProgram</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>