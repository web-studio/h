<?php
$this->breadcrumbs=array(
	'Bonus Programs',
);

$this->menu=array(
	array('label'=>'Create BonusProgram','url'=>array('create')),
	array('label'=>'Manage BonusProgram','url'=>array('admin')),
);
?>

<h1>Bonus Programs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
