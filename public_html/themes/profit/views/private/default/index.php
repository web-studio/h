<?php
$this->pageTitle = 'My account';

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<div>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">Personal Information</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<table class="items table">
    <tr>
        <td>
            <h6 class="title"><strong>Full name</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->first_name .' '. $user->last_name ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Email</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->email ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Internal purse</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->internal_purse ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Perfect money account</strong></h6>
        </td>
        <td>
            <h6><?php echo $user->perfect_purse ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo CHtml::link('Edit personal data', '#') ?>
        </td>
        <td>

        </td>
    </tr>
</table>

</div>

<div>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title">Profit Information</h4>
    </div>
    <span class="divider"></span>
    <div class="clear"></div>
</div>
<table class="items table">
    <tr>
        <td>
            <h6 class="title"><strong>Current balance</strong></h6>
        </td>
        <td>
            <h6>$<?php echo User::model()->getAmount() ?> <?php echo CHtml::link('Refill Account','#modal',['style'=>'margin-left:20px','class' => 'fancy-inline']) ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Total investment</strong></h6>
        </td>
        <td>
            <h6><?php  ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Profit from investments</strong></h6>
        </td>
        <td>
            <h6><?php  ?></h6>
        </td>
    </tr>
    <tr>
        <td>
            <h6 class="title"><strong>Profit from referrals</strong></h6>
        </td>
        <td>
            <h6><?php  ?></h6>
        </td>
    </tr>
</table>
</div>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'.fancy-inline',
    'config'=>array(),
)); ?>
<div id="modal" style="display: none;">


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
            <?php echo CHtml::submitButton('Refill', ['class'=>'submit_button']); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->

</div>