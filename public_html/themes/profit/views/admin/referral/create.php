<?php
$this->breadcrumbs=array(
	'Referrals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Referral','url'=>array('index')),
	array('label'=>'Manage Referral','url'=>array('admin')),
);
?>

<h1>Create Referral</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>