<?php $this->beginContent('//layouts/main') ?>

<div class="twelve columns">
    <?php echo $content ?>
</div>
<div class="four columns">
    <div class="sidebar">
        <div class="sideborder"></div>
        <h5>Most Popular Posts</h5>
        <?php $this->widget('PageTree') ?>
    </div>
</div>
<div class="clear"></div>

<?php $this->endContent() ?>

