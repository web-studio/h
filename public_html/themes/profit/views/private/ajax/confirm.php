<h4 class="title">Сonfirm operation?</h4>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'transfer-form',
        'enableClientValidation'=>true,
        'action'=>Yii::app()->createAbsoluteUrl("/private/default/internalTransfers"),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <?php echo $form->hiddenField($userTransaction,'amount', array('name' => 'amount')); ?>
    <?php echo $form->hiddenField($user,'internal_purse', array('name' => 'internal_purse')); ?>



    <div>
        <?php echo CHtml::submitButton('No', ['style'=>'margin-left: 0px; margin-top:30px; margin-bottom;0px ','class'=>'submit_button']); ?>

        <?php echo CHtml::submitButton('Yes', ['style'=>'margin-left: 15px; margin-top:30px; margin-bottom;0px','class'=>'submit_button']); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
