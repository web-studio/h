<?php
$this->pageTitle = 'Manage Bonus Programs';
$this->breadcrumbs=array(
	'Bonus Programs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BonusProgram','url'=>array('index')),
	array('label'=>'Create BonusProgram','url'=>array('create')),
);


?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bonus-program-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',

        [
            'name'=>'date_create',
            'value'=>'$data->date_create'
        ],
        [
            'name'=>'user_id',
            'type'=>'raw',
            'value'=>'$data->user_id'
        ],
        [
            'name'=>'link',
            'type'=>'raw',
            'value'=>'CHtml::link($data->link, $data->link )'
        ],
        [
            'name'=>'status',
            'value'=>'BonusProgram::model()->getStatus($data->status)'
        ],
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}',


        ),
	),
)); ?>
