<?
$this->pageTitle = 'Welcome to ' . CHtml::encode(Yii::app()->name);
?>

<h3>Используемые сторонние решения</h3>
<ul>
	<li><a href="http://www.cniska.net/yii-bootstrap/">Yii-Bootstrap</a></li>
	<li><a href="https://github.com/yiiext/nested-set-behavior">Nested Set Behavior</a></li>
	<li><a href="https://github.com/yiiext/imperavi-redactor-widget">ImperaviRedactorWidget</a></li>
	<li><a href="http://www.yiiframework.com/extension/jtogglecolumn/">JToggleColumn</a></li>
	<li><a href="http://ludo.cubicphuse.nl/jquery-plugins/treeTable/doc/">jQuery treeTable Plugin</a></li>
	<li><a href="https://github.com/olebedev/django-urlify">django-urlify</a></li>
</ul>
<hr>
<? $this->widget('PageTree') ?>