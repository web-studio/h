<?php
$this->pageTitle = 'News';

$this->breadcrumbs=array(
	'News',
);
?>

    <div class="title-wrapper"  style="width: 577px; margin-left: 20px">
        <div class="section-title">
            <h4 class="title">All News</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>


<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'template' => "{items}\n{pager}",
    'htmlOptions'=>array('style'=>'padding: 0px'),
)); ?>
