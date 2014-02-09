<? $this->beginContent('//layouts/main') ?>
	<div class="span8">
		<?= $content ?>
	</div>
	<div class="span4">
		<? $this->widget('PageTree') ?>
	</div>
<? $this->endContent() ?>