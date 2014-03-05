<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'invest-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <div class="">
        <?php echo $form->textField($supportForm,'subject', ['placeholder'=>'Subject*', 'style'=>'color:#217b9d;width:280px']); ?>
        <?php echo $form->error($supportForm,'subject'); ?>
    </div>

    <div class="">
        <?php echo $form->textArea($supportForm,'message', ['placeholder'=>'Message*', 'style'=>'color:#217b9d;width:280px;height:200px']); ?>
        <?php echo $form->error($supportForm,'message'); ?>
    </div>

    <div class="center">
        <?php echo CHtml::submitButton('Submit', ['class'=>'submit_button', 'id'=>'submit']); ?>
    </div>
<?php $this->endWidget(); ?>