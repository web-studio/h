<?php
$this->pageTitle = 'Update UserRole' .$model->id;
$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserRole','url'=>array('index')),
	array('label'=>'Create UserRole','url'=>array('create')),
	array('label'=>'View UserRole','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserRole','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>