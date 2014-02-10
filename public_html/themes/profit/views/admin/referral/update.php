<?php
$this->breadcrumbs=array(
	'Referrals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Referral','url'=>array('index')),
	array('label'=>'Create Referral','url'=>array('create')),
	array('label'=>'View Referral','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Referral','url'=>array('admin')),
);
?>

<h1>Update Referral <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>