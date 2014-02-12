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

    <script>
        $(document).ready(function () {
            $('.message').delay(3000).hide(200);
        });
    </script>
<?php echo $content ?>

<?php $this->endContent() ?>