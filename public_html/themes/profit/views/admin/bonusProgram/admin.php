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

        [
            'name'=>'date_create',
            'value'=>'$data->date_create'
        ],
        [
            'name'=>'user_id',
            'type'=>'raw',
            'value'=>'CHtml::link(User::getEmailById($data->user_id), Yii::app()->createAbsoluteUrl("/admin/user/view", ["id"=>$data->user_id]), ["target"=>"_blank"] )'
        ],
        [
            'name'=>'site_id',
            'type'=>'raw',
            'value'=>'BonusSites::model()->getUrlById($data->site_id)'
        ],
        [
            'name'=>'link',
            'type'=>'raw',
            'value'=>'CHtml::link("View Link", $data->link, ["target"=>"_blank"] )'
        ],
        [
            'name'=>'status',
            'value'=>'BonusProgram::model()->getStatus($data->status)'
        ],
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{confirm}&nbsp;&nbsp;&nbsp;{cancel}',
            'buttons' => array(
                'confirm' => array(
                    'label' => 'confirm',
                    'url'=>'Yii::app()->createUrl("/admin/bonusProgram/confirm", array("id"=>$data->id, "confirm" => "ok"))',
                    'options' => array('class'=>'arrow_image_up'),
                    'visible' => '($data->status==2)?true:false;',
                    'click' => "js: function() {
                        if ( confirm('Confirm?') ) {
                            ajaxMoveRequest($(this).attr('href'), 'bonus-program-grid');
                         return false;
                        } else {
                            return false;
                        }

                    }",
                ),
                'cancel' => array(
                    'label' => 'cancel',
                    'url'=>'Yii::app()->createUrl("/admin/bonusProgram/confirm", array("id"=>$data->id, "confirm" => "cancel"))',
                    'options' => array('class'=>'arrow_image_down'),
                    'visible' => '($data->status==2)?true:false;',
                    'click' => "js: function() {
                        if ( confirm('Confirm?') ) {
                            ajaxMoveRequest($(this).attr('href'), 'bonus-program-grid');
                         return false;
                        } else {
                            return false;
                        }

                    }",
                ),
            )
        ),
	),
)); ?>
