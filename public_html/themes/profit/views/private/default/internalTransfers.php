<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'internalTransfers-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <div id="amount_alert"></div>
<?php $amount = User::model()->getAmount(); ?>
<?php $internal_purse = '' ?>

    <span style="font-weight: bold; font-size: 24px">Transfer amount: </span>
    <span style="color:#217b9d; font-weight:bold;font-size: 24px;">$</span>
    <input type="text" name="amount" value="0" id="amt" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 100px; background-color: transparent" />
    <div class="clear"></div>
<?php
$this->widget('zii.widgets.jui.CJuiSlider', array(
    'value'=>0,
    'id'=>'amtSlider',
    // additional javascript options for the slider plugin
    'options'=>array(
        'min'=>0,
        'max'=>($amount < 1) ? 50 : $amount,
        'slide'=>'js:function(event, ui) { $("#amt").val(ui.value).change();}'
    ),
    'htmlOptions'=>array(
        'style'=>'height:12px;width:300px;margin-bottom: 20px',
        //'class'=>'five columns'
    ),
));
?>
    <span style="font-weight: bold; font-size: 24px">Internal purse: </span>

    <input type="text" name="internal_purse" value="<?php echo $internal_purse ?>" id="amt" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 150px; background-color: transparent" />

    <div class="clear"></div>
    <div class="center">
        <?php echo CHtml::submitButton('Transfer', ['class'=>'submit_button', 'id'=>'transfer', 'confirm'=>'Сonfirm operation']); ?>
    </div>
<?php $this->endWidget(); ?>
