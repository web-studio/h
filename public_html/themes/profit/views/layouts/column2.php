<?php $this->beginContent('//layouts/main') ?>

<div class="two-thirds column alpha">
    <?php echo $content ?>
</div>

<div class="one-third column omega">
    <div class="sidebar">
        <div class="sideborder"></div>
        <div class="title-wrapper">
            <div class="section-title">
                <h4 class="title">Last News</h4>
            </div>
            <span class="divider"></span>
            <div class="clear"></div>
        </div>
        <?php  $this->widget('ext.widgets.news.NewsWidget');?>
    </div>
</div>
<div class="clear"></div>

<?php $this->endContent() ?>

