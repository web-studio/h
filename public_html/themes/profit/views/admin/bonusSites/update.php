<?php
$this->breadcrumbs=array(
	'Bonus Sites'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BonusSites','url'=>array('index')),
	array('label'=>'Create BonusSites','url'=>array('create')),
	array('label'=>'View BonusSites','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BonusSites','url'=>array('admin')),
);
?>

<h1>Update BonusSites <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>