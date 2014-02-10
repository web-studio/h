<?php
$this->pageTitle = 'Manage News';

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List News','url'=>array('index')),
	array('label'=>'Create News','url'=>array('create')),
);


?>
<div class="btn-toolbar">
    <?php echo CHtml::link('Create news', array('create'), array('class' => 'btn')) ?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		'text',
		'image',
		'status',
		/*
		'created_time',
		'update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
