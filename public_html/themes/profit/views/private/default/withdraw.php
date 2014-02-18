<?php $amount = User::model()->getAmount(); ?>
<?php if ( $amount > 0 ) : ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'internalTransfers-form',
        'action'=> Yii::app()->createAbsoluteUrl('/private/perfectMoney/withdraw/'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <div id="amount_alert"></div>

    <span style="font-weight: bold; font-size: 24px">Amount for withdraw: </span>
    <span style="color:#217b9d; font-weight:bold;font-size: 24px;">$</span>
    <input type="text" name="amount" value="<?php echo $amount ?>" id="amt" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 100px; background-color: transparent" />
    <div class="clear"></div>
    <?php
    $this->widget('zii.widgets.jui.CJuiSlider', array(
        'value'=>$amount,
        'id'=>'amtSlider',
        // additional javascript options for the slider plugin
        'options'=>array(
            'min'=>0,
            'max'=>($amount < 1) ? 50 : $amount,
            'slide'=>'js:function(event, ui) { $("#amt").val(ui.value).change();}'
        ),
        'htmlOptions'=>array(
            'style'=>'height:12px;width:375px;margin-bottom: 20px',
            //'class'=>'five columns'
        ),
    ));
    ?>

    <div id="transfer_alert"></div>

    <span style="font-weight: bold; font-size: 24px">Perfect money: </span>
    <input type="text" name="perfect_purse" value="<?php echo $user->perfect_purse ?>" id="internal_purse" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 150px; background-color: transparent" />


    <div class="clear"></div>
    <div class="center">
        <?php echo CHtml::submitButton('Withdraw', ['class'=>'submit_button', 'id'=>'withdraw']); ?>
    </div>
    <?php $this->endWidget(); ?>
<?php else : ?>
    <div class="form-result" style="">
        <p class="note warning">Insufficient funds to withdraw</p>
        <br>
    </div>
<?php endif; ?>