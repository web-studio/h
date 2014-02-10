<?php
$this->pageTitle = 'Update News' . $model->id;
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List News','url'=>array('index')),
	array('label'=>'Create News','url'=>array('create')),
	array('label'=>'View News','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage News','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>