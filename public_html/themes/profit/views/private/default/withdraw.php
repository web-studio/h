<?php
$this->pageTitle = 'Withdraw';

$this->breadcrumbs=array(
    'My account'=>array('/private'),
    $this->pageTitle
);
?>
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

    <span style="font-weight: bold; font-size: 18px">Amount for withdraw: </span>
    <span style="color:#217b9d; font-weight:bold;font-size: 18px;">$</span>
    <input type="text" name="amount" value="<?php echo $amount ?>" id="amt" style="margin-top: 3px; padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 18px; height: 20px; width: 100px; background-color: transparent" />
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
            'style'=>'height:12px;width:375px;margin-bottom: 20px;margin-top: 11px ',
            //'class'=>'five columns'
        ),
    ));
    ?>

    <div id="transfer_alert"></div>

    <span style="font-weight: bold; font-size: 18px">Perfect money: </span>
    <input type="text" name="perfect_purse" value="<?php echo $user->perfect_purse ?>" id="perfect_purse" style="margin-top: 3px;  padding-left:0;border:1px solid #d3d3d3; color:#217b9d; font-weight:bold;font-size: 18px; height: 20px; width: 150px; background-color: transparent" />


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
<?php if ( $outputTransactions->outputSearch()->itemCount > 0 ):?>
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">Pending Transactions</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'user-transfer-grid',
        'dataProvider'=>$outputTransactions->outputSearch(),
        'template' => '{items}{pager}',
        'columns'=>array(

            [
                'name'=>'created_time',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'User::formatDate($data->created_time,true)'
            ],

            [
                'name'=>'payment_amount',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'"$" . $data->payment_amount'
            ],
            [
                'name'=>'payee_account',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'$data->payee_account'
            ],
            [
                'name'=>'status',
                'headerHtmlOptions' => ['style' => 'text-align:center;'],
                'htmlOptions' => ['style' => 'text-align:center;vertical-align:middle'],
                'value'=>'OutputTransactions::model()->getStatus($data->status)'
            ],

        ),
    )); ?>
<?php endif?>
<script>
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


        var regV = /U\d{7}$/;

        $('#withdraw').on('click', function(e) {
            if ( !$('#perfect_purse').val().match(regV) ) {
                $('#transfer_alert').css({'color':'red'}).html('Incorrect Perfect Money Account');
                return false;
            }
        });
    });
</script>