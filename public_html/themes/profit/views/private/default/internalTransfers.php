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
<div id="amount_alert"></div>
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
        'style'=>'height:12px;width:325px;margin-bottom: 20px',
        //'class'=>'five columns'
    ),
));
?>
<div id="transfer_alert"></div>

<span style="font-weight: bold; font-size: 24px">Internal purse: </span>
    <input type="text" name="internal_purse" value="<?php echo $internal_purse ?>" id="internal_purse" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 147px; background-color: transparent" />

<div class="clear"></div>
    <div class="center" style="height: 40px;margin-bottom:10px">
        <?php echo CHtml::Button('Transfer',[
            'id'=>'transfer',
            'onclick'=>'
                            $.ajax({
                                url: "'. Yii::app()->createAbsoluteUrl("/private/ajax/confirm") .'",
                                type: "POST",
                                data: {amount:$("#amt").val(), internal_purse:$("#internal_purse").val()},
                                success: function(html){
                                    $("#modal").html(html);
                                    $.fancybox.open({type: "inline", href: "#modal"})
                                }
                            });
                        ',
            'style'=>'margin-left:20px','class' => 'submit_button']) ?>
    </div>
<?php $this->endWidget(); ?>
<?php if ( $userTransfers->transferSearch()->itemCount > 0 ):?>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">My transfers</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-transfer-grid',
    'dataProvider'=>$userTransfers->transferSearch(),
    'template' => '{items}{pager}',
    'columns'=>array(

        [
            'name'=>'amount',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'( $data->amount < 0 ) ? "-$" . substr($data->amount,1) : "$" . $data->amount'
        ],
        [
            'name'=>'time',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'User::formatDate($data->time,true)'
        ],

        [
            'name'=>'amount_after',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'"$" . $data->amount_after'
        ],
        [
            'name'=>'reason',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'$data->reason'
        ],


        /*array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),*/
    ),
)); ?>
<?php endif?>
<script>
   /* $("#transfer").on("click", function(){
        if ( $('#internal_purse').val() == 0 ) {
            $('#transfer_alert').html('Enter the internal purse').attr('style','color:red;margin-bottom:15px');
            return false;
        }
    })*/

    $("#amt").on('change', function(){
        var current_amount = <?php echo $amount ?>;

        if ( $(this).val() > current_amount  ) {
            $('#amount_alert').html('Your balance is not enough money to invest. Pay the remaining amount through Perfect Money').attr('style','color:red;margin-bottom:15px');
        } else {
            $('#amount_alert').empty();
        }
    })



</script>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.fancy-inline',
    'config'=>array(),
)); ?>
<div id="modal" style="display: none;"></div>
