<?php
$this->pageTitle = 'Manage User Roles';
$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserRole','url'=>array('index')),
	array('label'=>'Create UserRole','url'=>array('create')),
);

?>
<div class="btn-toolbar">
    <?php echo CHtml::link('Create role', array('create'), array('class' => 'btn')) ?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-role-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'title',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
