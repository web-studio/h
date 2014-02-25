<?php
$this->breadcrumbs=array(
	'Bonus Sites',
);

$this->menu=array(
	array('label'=>'Create BonusSites','url'=>array('create')),
	array('label'=>'Manage BonusSites','url'=>array('admin')),
);
?>

<h1>Bonus Sites</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
