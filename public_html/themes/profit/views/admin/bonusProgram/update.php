<?php
$this->breadcrumbs=array(
	'Bonus Programs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BonusProgram','url'=>array('index')),
	array('label'=>'Create BonusProgram','url'=>array('create')),
	array('label'=>'View BonusProgram','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BonusProgram','url'=>array('admin')),
);
?>

<h1>Update BonusProgram <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>