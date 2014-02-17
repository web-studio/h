<?
$this->pageTitle = "Error $code";
$this->metaTitle = "Error $code";
$this->breadcrumbs = array(
	$this->pageTitle,
);
?>
<?php if ( $code == '404' ):?>
<h3>Page not found.</h3>
<?php else:?>
<h3><?= CHtml::encode($message) ?></h3>
<?php endif?>