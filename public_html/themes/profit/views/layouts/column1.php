<?php $this->beginContent('//layouts/main') ?>
<?php if (Yii::app()->user->hasFlash('successMessage')): ?>
    <div class="form-result message" style="">
        <p class="note success"><?php echo Yii::app()->user->getFlash('successMessage'); ?></p>
        <br>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('failMessage')): ?>
    <div class="form-result message" style="">
        <p class="note error"><?php echo Yii::app()->user->getFlash('failMessage'); ?></p>
        <br>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('warningMessage')): ?>
    <div class="form-result message" style="">
        <p class="note warning"><?php echo Yii::app()->user->getFlash('warningMessage'); ?></p>
        <br>
    </div>
<?php endif; ?>
<?php if (Yii::app()->user->hasFlash('infoMessage')): ?>
    <div class="form-result message" style="">
        <p class="note info"><?php echo Yii::app()->user->getFlash('infoMessage'); ?></p>
        <br>
    </div>
<?php endif; ?>

    <script>
        $(document).ready(function () {
            $('.message').delay(10000).hide(200);
        });
    </script>
<?php echo $content ?>

<?php $this->endContent() ?>