<?php
/* @var $this DefaultController */
$this->pageTitle = 'Welcome to Admin panel';
$this->breadcrumbs=array(
	$this->module->id,
);
$this->menu=array(
    array('label'=>'Pages','url'=>array('/admin/pages')),
    array('label'=>'Users','url'=>array('/admin/user')),
    array('label'=>'Settings','url'=>'#', 'items'=>[
        array('label'=>'Deposit types','url'=>array('/admin/depositType')),
    ]),
);
?>

Total amount:
