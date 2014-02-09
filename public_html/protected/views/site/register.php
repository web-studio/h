<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<h1>Register</h1>


<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'register-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($register,'first_name'); ?>
        <?php echo $form->textField($register,'first_name'); ?>
        <?php echo $form->error($register,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'last_name'); ?>
        <?php echo $form->textField($register,'last_name'); ?>
        <?php echo $form->error($register,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'login'); ?>
        <?php echo $form->textField($register,'login'); ?>
        <?php echo $form->error($register,'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'email'); ?>
        <?php echo $form->textField($register,'email'); ?>
        <?php echo $form->error($register,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'password'); ?>
        <?php echo $form->passwordField($register,'password'); ?>
        <?php echo $form->error($register,'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'password_repeat'); ?>
        <?php echo $form->passwordField($register,'password_repeat'); ?>
        <?php echo $form->error($register,'password_repeat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'mobile'); ?>
        <?php
        $this->widget('CMaskedTextField', array(
            'model' => $register,
            'attribute' => 'mobile',
            'mask' => '+9-999-999-9999',
            'placeholder' => '_',
            'completed' => 'function(){console.log("ok");}',
        ));
        ?>
        <?php echo $form->error($register,'mobile'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'country'); ?>
        <?php echo $form->textField($register,'country'); ?>
        <?php echo $form->error($register,'country'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'city'); ?>
        <?php echo $form->textField($register,'city'); ?>
        <?php echo $form->error($register,'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($register,'street'); ?>
        <?php echo $form->textField($register,'street'); ?>
        <?php echo $form->error($register,'street'); ?>
    </div>

    <?php if ( $register->referral != null ) : ?>
        <div class="row">
            <?php echo $form->labelEx($register,'referral'); ?>
            <?php echo $form->textField($register,'referral',['disabled'=>'disabled']); ?>
            <?php echo $form->error($register,'referral'); ?>
        </div>
        <div class="row">
            <?php echo $form->hiddenField($register,'referral_id'); ?>
        </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
