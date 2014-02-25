<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'refill-form',
        'action' => Yii::app()->params['perfectPayUrl'],
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <span style="font-weight: bold; font-size: 24px">Pay with Perfect money $<?php echo $amount ?></span>
    <?php echo $form->hiddenField($refill,'PAYEE_ACCOUNT', array('name' => 'PAYEE_ACCOUNT')); ?>
    <?php echo $form->hiddenField($refill,'PAYEE_NAME', array('name' => 'PAYEE_NAME')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_ID', array('name' => 'PAYMENT_ID')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_AMOUNT', array('name' => 'PAYMENT_AMOUNT')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_UNITS', array('name' => 'PAYMENT_UNITS')); ?>
    <?php echo $form->hiddenField($refill,'STATUS_URL', array('name' => 'STATUS_URL')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_URL', array('name' => 'PAYMENT_URL')); ?>
    <?php echo $form->hiddenField($refill,'PAYMENT_URL_METHOD', array('name' => 'PAYMENT_URL_METHOD')); ?>
    <?php echo $form->hiddenField($refill,'NOPAYMENT_URL', array('name' => 'NOPAYMENT_URL')); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Pay', ['id'=>'refill_submit', 'class'=>'submit_button']); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->