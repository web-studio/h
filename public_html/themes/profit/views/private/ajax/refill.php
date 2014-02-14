<h4 class="title">Refill Account</h4>


<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'refill-form',
        'action' => Yii::app()->params['perfectPayUrl'],
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <?php echo $form->hiddenField($refill,'PAYEE_ACCOUNT', array('name' => 'PAYEE_ACCOUNT')); ?>
    <?php echo $form->hiddenField($refill,'PAYEE_NAME', array('name' => 'PAYEE_NAME')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_ID', array('name' => 'PAYMENT_ID')); ?>
    <?php echo $form->textField($refill,'PAYMENT_AMOUNT', array('name' => 'PAYMENT_AMOUNT')); ?>
    <?php echo $form->error($refill,'PAYMENT_AMOUNT'); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_UNITS', array('name' => 'PAYMENT_UNITS')); ?>
    <?php echo $form->hiddenField($refill,'STATUS_URL', array('name' => 'STATUS_URL')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_URL', array('name' => 'PAYMENT_URL')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_URL_METHOD', array('name' => 'PAYMENT_URL_METHOD')); ?>
    <?php echo $form->hiddenField($refill,'NOPAYMENT_URL', array('name' => 'NOPAYMENT_URL')); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Refill', ['id'=>'refill_submit', 'class'=>'submit_button']); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>

    $("#refill_submit").on("click", function(evt){
        evt.preventDefault();
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("/private/ajax/refillAmount") ?>',
            type: 'POST',
            dataType: 'json',
            data: {amount:$("#PAYMENT_AMOUNT").val(), payment_id:$("#PAYMENT_ID").val()},
            success: function(data){
                if ( data.status == 1 ) {
                    $("#refill-form").submit();
                } else {
                    return false;
                }
            }
        });

    });

    function refill(){
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("/private/ajax/refillTransaction") ?>',
            type: 'POST',
            dataType: 'json',
            data: {amount:$("#PAYMENT_AMOUNT").val(), payment_id:$("#PAYMENT_ID").val()},
            success: function(data){
                if ( data.status == 1 ) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    }
</script>