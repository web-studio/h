<?
$this->pageTitle = 'Update page - ' . $model->page_title;
$this->breadcrumbs = array(
	'Статические страницы' => array('index'),
	$this->pageTitle,
);
?>

<?= $this->renderPartial('_form', array('model' => $model)) ?>