<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'invest-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
<div class="deposits">
    <div id="deposit_alert"></div>
    <?php foreach ( $depositTypes as $depositType ) :?>
        <div class="tree columns alpha deposit" onclick="s_dep(<?php echo $depositType->id ?>, <?php echo $depositType->min_amount ?>, <?php echo $depositType->max_amount ?>)">
            <ul class="pricing">
                <li class="title"><?php echo $depositType->name ?></li>
                <li class="price">
                    <span class="rate">Total return</span><br/>
                    <span><?php echo $depositType->total_return ?></span>
                    <span class="decimal">%</span>

                </li>

                <li><strong>Amount</strong> $<?php echo $depositType->min_amount ?> - $<?php echo $depositType->max_amount ?></li>
                <li><strong>Period</strong> <?php echo $depositType->days ?> working days</li>
            </ul>
            <input type="radio" name="deposit" class="deposit_select" id="deposit<?php echo $depositType->id ?>" style="display:none" value="<?php echo $depositType->id ?>">
        </div>
    <?php endforeach; ?>
</div>

<div class="clear"></div>

<div id="amount_alert"></div>
<?php $amount = User::model()->getAmount(); ?>
<span style="font-weight: bold; font-size: 24px">Invest amount: </span>
<span style="color:#217b9d; font-weight:bold;font-size: 24px;">$</span>
<input type="text" name="amount" value="<?php echo $amount ?>" id="amt" style="padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 24px; height: 30px; width: 65px; background-color: transparent" />
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
        'style'=>'height:12px;width:300px;margin-bottom: 20px',
        //'class'=>'five columns'
    ),
));
?>
<div class="clear"></div>
<div class="center">
    <?php echo CHtml::submitButton('Invest', ['class'=>'submit_button', 'id'=>'invest']); ?>
</div>
<?php if ( UserDeposit::model()->getSumDeposits() > 0 ) : ?>
<div>
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">My deposits</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'user-deposit-grid',
        'dataProvider'=>$userDeposits->depositSearch(),
        'template' => '{items}{pager}',
        'columns'=>array(
            [
                'name'=>'deposit_type_id',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'DepositType::model()->getNameById($data->deposit_type_id)'
            ],
            [
                'name'=>'deposit_amount',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'"$".$data->deposit_amount'
            ],
            [
                'name'=>'date_create',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'User::formatDate($data->date_create)'
            ],
            [
                'name'=>'expire',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'User::formatDate($data->expire)'
            ],
            [
                'name'=>'status',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'UserDeposit::model()->getStatus($data->status)'
            ],

            /*array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
            ),*/
        ),
    )); ?>

</div>
<?php endif; ?>
<?php //echo CHtml::link('<span>Invest</span>', '#', ['class'=>'medium-button']) ?>
<?php $this->endWidget(); ?>
<script>
    function check_deposit(){
        $(".deposit_select:not(:checked)").siblings().css("border","1px solid transparent");
        $(".deposit_select:checked").siblings().css("border","1px solid #404040");
    }

    function s_dep(id, min, max) {
        $('#deposit' + id).attr('checked', 'checked');
        $('#deposit_alert').empty();
        check_deposit();

        var current_amount = <?php echo $amount ?>;

        //$("#amt").val(current_amount);

        $( "#amtSlider" ).slider( "option", "min", min );
        $( "#amtSlider" ).slider( "option", "max", max );

        if ( current_amount < min ) {
            $('#amount_alert').html('Your balance is not enough money to invest. Pay the remaining amount through Perfect Money').attr('style','color:red;margin-bottom:15px');
        } else {
            $('#amount_alert').empty();
        }

        if ( $("#amt").val() > max ) {
            $("#amt").val(max)
        } else if ( $("#amt").val() < min ) {
            $("#amt").val(min)
        }
        /*$.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("/private/ajax/getInvestAmount"); ?>',
            type: 'POST',
            data: {deposit_id: id},
            success: function(html) {
                $("#amount").html(html);
            }
        });*/
    }
    $("#amt").on('change', function(){
        var current_amount = <?php echo $amount ?>;

        if ( $(this).val() > current_amount  ) {
            $('#amount_alert').html('Your balance is not enough money to invest. Pay the remaining amount through Perfect Money').attr('style','color:red;margin-bottom:15px');
        } else {
            $('#amount_alert').empty();
        }
    })
    $("#invest").on("click", function(){
        if ( $('#invest-form input[type="radio"]').is(':checked') == false ) {
            $('#deposit_alert').html('Select an investment program').attr('style','color:red;margin-bottom:15px');
            return false;
        }
    })


</script>


