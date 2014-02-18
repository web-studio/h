<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);

?>
<div style="margin-left: 20px;margin-right: 20px">
    <h3>View News - <?php echo $model->title; ?></h3>

    <span style=" text-indent: 20px;"><p><?php echo $model->text; ?></p></span>

    <span style="position: absolute; right:370px"><?php echo User::formatDate($model->created_time,true); ?></span>

</div>
