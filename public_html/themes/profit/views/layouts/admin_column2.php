<?php $this->beginContent('//layouts/main') ?>

<div class="twelve columns">
    <?php echo $content ?>
</div>
<div class="four columns">
    <div class="sidebar">
        <div class="sideborder"></div>
        <h5>Admin menu</h5>
        <?php// $this->widget('PageTree') ?>
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items'=> array(

                array('label'=>'Users','url'=>array('/admin/user')),
                array('label'=>'Referrals','url'=>array('/admin/referral')),
                array('label'=>'User deposits','url'=>array('/admin/userDeposit')),
                array('label'=>'Transactions','url'=>'#', 'items'=>[
                    array('label'=>'Input','url'=>array('/admin/userTransactions')),
                    array('label'=>'Output','url'=>array('/admin/OutputTransactions')),
                    array('label'=>'Unsuccessful','url'=>array('/admin/UserTransactionsIncomplete')),
                ]),
                array('label'=>'Settings','url'=>'#', 'items'=>[
                    array('label'=>'Deposit types','url'=>array('/admin/depositType')),
                    array('label'=>'User role','url'=>array('/admin/userRole')),
                ]),
                array('label'=>'Pages','url'=>array('/admin/pages')),
                array('label'=>'News','url'=>array('/admin/news')),
                array('label'=>'Messages','url'=>array('/admin/messages')),
        )));
        ?>
    </div>
</div>
<div class="clear"></div>

<?php $this->endContent() ?>

