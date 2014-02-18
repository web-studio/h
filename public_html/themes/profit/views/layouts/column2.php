<?php $this->beginContent('//layouts/main') ?>

<div class="two-thirds column alpha">
    <?php echo $content ?>
</div>

<div class="one-third column omega">
    <div class="sidebar">
        <div class="sideborder"></div>
        <?php  $this->widget('ext.widgets.news.NewsWidget');?>
    </div>
</div>
<div class="clear"></div>

<?php $this->endContent() ?>

