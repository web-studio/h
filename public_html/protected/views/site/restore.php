<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<h1>Password recovery</h1>
<?php echo Yii::app()->user->getFlash('failMessage') ?>
<?php echo Yii::app()->user->getFlash('successMessage') ?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'restore-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($restore,'email'); ?>
        <?php echo $form->textField($restore,'email'); ?>
        <?php echo $form->error($restore,'email'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Restore'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
