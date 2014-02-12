<?php $this->beginContent('//layouts/main') ?>

<div class="twelve columns">

    <?php if (Yii::app()->user->hasFlash('successMessage')): ?>
        <div class="form-result message" style="">
            <p class="note success"><?php echo Yii::app()->user->getFlash('successMessage'); ?></p>
            <br>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('failMessage')): ?>
        <div class="form-result message" style="">
            <p class="note error"><?php echo Yii::app()->user->getFlash('failMessage'); ?></p>
            <br>
        </div>
    <?php endif; ?>

    <script>
        $(document).ready(function () {
            $('.message').delay(3000).hide(200);
        });
    </script>

    <?php echo $content ?>
</div>
<div class="four columns">
    <div class="sidebar">
        <div class="sideborder"></div>

        <?php
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions'=>['class'=>'private_menu'],
            'items'=> array(
                array('label'=>'ACCOUNT INFO','url'=>array('/private'),'active'=>$this->action->id=='index'?true:false),
                array('label'=>'INTERNAL TRANSFERS','url'=>array('/private/default/internalTransfers')),
                array('label'=>'INVESTMENT','url'=>array('/private/default/investment')),
                array('label'=>'WITHDRAW','url'=>array('/private/default/withdraw')),
                array('label'=>'REFERRALS','url'=>array('/private/default/referrals')),
                array('label'=>'TRANSACTIONS','url'=>array('/private/default/transactions')),
        )));
        ?>
    </div>
</div>
<div class="clear"></div>
<script>
    $('.private_menu > li').click(function(e){
        var url = $(this).find('> a').attr("href");
        location = url;
        e.stopPropagation();
    });

</script>
<?php $this->endContent() ?>

