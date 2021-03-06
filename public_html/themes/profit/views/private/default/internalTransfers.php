<?php
$this->pageTitle = 'Internal Transfers';

$this->breadcrumbs=array(
    'My account'=>array('/private'),
    $this->pageTitle

);
?>
<?php $amount = User::model()->getAmount(); ?>
<?php if ( $amount > 0 ) : ?>
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
    <span style="font-weight:bold;font-size: 18px;">Transfer amount: </span>
    <span style="color:#217b9d; font-weight:bold;font-size: 18px;">$</span>
    <input type="text" name="amount" value="0" id="amt" style="padding-left:0; margin-top: 3px; border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 18px; height: 20px; width: 100px; background-color: transparent" />
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
        'style'=>'height:12px;width:325px;margin-bottom: 5px; margin-top: 11px ',
        //'class'=>'five columns'
    ),
));
?>
</br>

<div id="transfer_alert"></div>

<span style="font-weight: bold; font-size: 18px">Internal purse: </span>
    <input type="text" name="internal_purse" value="<?php echo $internal_purse ?>" id="internal_purse" style="margin-top: 3px; padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 18px; height: 20px; width: 147px; background-color: transparent" />

<div class="clear"></div>
    <div class="center" style="height: 40px;margin-bottom:10px">
        <?php echo CHtml::Button('Transfer',[
            'id'=>'transfer',
            'style'=>'margin-left:20px','class' => 'submit_button']) ?>
    </div>
<?php $this->endWidget(); ?>
<?php else : ?>
    <div class="form-result" style="">
        <p class="note warning">Insufficient funds to internal transfers</p>
        <br>
    </div>
<?php endif; ?>
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
            'name'=>'time',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'User::formatDate($data->time,true)'
        ],
        [
            'name'=>'amount',
            'headerHtmlOptions' => ['style' => 'text-align:center;'],
            'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
            'value'=>'( $data->amount < 0 ) ? "-$" . substr($data->amount,1) : "$" . $data->amount'
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

<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.fancy-inline',
    'config'=>array(),
)); ?>
<div id="modal" style="display: none;">
    <h4 class="title">Сonfirm operation?</h4>
    <div class="form">
        <div>
            <?php echo CHtml::button('Ok', ['id'=>'ok','style'=>'margin-left: 0px; margin-top:30px; margin-bottom;0px ','class'=>'submit_button']); ?>

            <?php echo CHtml::button('Cancel', ['id'=>'cancel', 'style'=>'margin-left: 15px; margin-top:30px; margin-bottom;0px','class'=>'submit_button']); ?>
        </div>
    </div>
</div>

<script>
    /* $("#transfer").on("click", function(){
     if ( $('#internal_purse').val() == 0 ) {
     $('#transfer_alert').html('Enter the internal purse').attr('style','color:red;margin-bottom:15px');
     return false;
     }
     })*/

    $(document).ready(function(){

        var old_val = '';
        var input_regexp = /^(\d+(\.\d{0,2})?)?$/;
        $('#amt').keydown(function(e) {

            var val = $(this).val();
            if (input_regexp.test(val)) {
                old_val = $(this).val();
            }
        }).keyup(function(e) {
                var val = $(this).val();
                if (!input_regexp.test(val)) {
                    $(this).val(old_val);
                }
            });


        $('#internal_purse').bind("change keyup input click", function() {
            if ( this.value.length > 10 ) {
                $(this).val(old_val);
            } else if ( this.value.length == 10  ) {
                $(this).css({'color':'#52B496'});
                old_val = $(this).val();
            } else {
                $(this).css({'color':'#217b9d'});
                if (this.value.match(/[^0-9]/g)) {

                    this.value = this.value.replace(/[^0-9]/g, '');
                }
            }

        });
/*
        var input_regexp2 = /^\d+$/;
        old_val = '';
        $('#internal_purse').keyup(function(e) {

            var val = $(this).val();
            if ( val.length > 10 ) {
                $(this).val(old_val);
            } else if ( val.length == 10 && input_regexp2.test(val) ) {
                    $(this).css({'color':'#52B496'});
                    old_val = $(this).val();
            } else {
                if (!input_regexp2.test(val)) {
                    $(this).val(old_val);
                    $(this).css({'color':'#217b9d'});
                }
            }
        });
*/
        $("#amt").on('change', function(){
            var current_amount = <?php echo $amount ?>;

            if ( $(this).val() > current_amount  ) {
                $('#amount_alert').html('Incorrect amount').attr('style','color:red;margin-bottom:15px');
            } else {
                $('#amount_alert').empty();
            }
        })

        $("#transfer").on("click", function() {
            var amount = false;
            var purse = false;
            if ( $("#amt").val() == 0 || $("#amt").val() == '' ) {
                $("#amount_alert").html("Enter the amount to transfer").attr('style','color:red;margin-bottom:15px');
            } else if ( $("#amt").val() > <?php echo $amount ?> ) {
                $("#amount_alert").html("Incorrect amount").attr('style','color:red;margin-bottom:15px');
            } else {
                amount = true;
            }

            if ( $("#internal_purse").val().length != 10 ) {
                $("#transfer_alert").html("Enter the number of purse").attr('style','color:red;margin-bottom:15px');
            } else {
                $("#transfer_alert").html("")
                purse = true;
            }

            if ( amount == true && purse == true ) {
                $.fancybox.open({type: "inline", href: "#modal"})
            }
        });

        $("#ok").on("click", function() {
            $("#internalTransfers-form").submit();
        });

        $("#cancel").on("click", function() {
            $.fancybox.close({type: "inline", href: "#modal"})
            return false;
        });
    });
</script>