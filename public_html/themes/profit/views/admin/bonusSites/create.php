<?php
$this->breadcrumbs=array(
	'Bonus Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BonusSites','url'=>array('index')),
	array('label'=>'Manage BonusSites','url'=>array('admin')),
);
?>

<h1>Create BonusSites</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>