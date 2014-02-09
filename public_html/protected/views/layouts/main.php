<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= CHtml::encode($this->metaTitle) ?></title>
	<meta name="description" content="<?= CHtml::encode($this->metaDescription) ?>">
	<meta name="keywords" content="<?= CHtml::encode($this->metaKeywords) ?>">
</head>
<body>
<? $this->widget('bootstrap.widgets.TbNavbar', array(
	'brand' => Yii::app()->name,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
				array('label' => 'Управление страницами', 'url' => array('/pages/admin/index'), 'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false),
			),
		),
	),
)) ?>
<div class="container" style="margin-top: 40px;">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h1><?= $this->pageTitle ?></h1>
			</div>
			<? $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links' => $this->breadcrumbs,
			)) ?>
			<? $this->widget('bootstrap.widgets.TbAlert', array(
				'block' => true,
				'fade' => true,
				'closeText' => '&times;',
			)) ?>
		</div>
		<?= $content ?>
	</div>
</div>
</body>
</html>
