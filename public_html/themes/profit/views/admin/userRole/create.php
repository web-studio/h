<?php
$this->pageTitle = 'Create UserRole';
$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRole','url'=>array('index')),
	array('label'=>'Manage UserRole','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>