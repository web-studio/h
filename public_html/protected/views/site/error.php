<?
$this->pageTitle = "Ошибка $code";
$this->metaTitle = "Ошибка $code";
$this->breadcrumbs = array(
	$this->pageTitle,
);
?>

<p><?= CHtml::encode($message) ?></p>
