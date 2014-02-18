<?php
$this->pageTitle = $model->title;

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);

?>
<div style="margin-left: 20px;margin-right: 20px">

    <span><p><?php echo $model->text; ?></p></span>

    <span style="position: absolute; right:370px"><?php echo User::formatDate($model->created_time,true); ?>

</div>
