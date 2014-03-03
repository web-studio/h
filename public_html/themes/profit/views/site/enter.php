
<div class="seven columns">
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">Login</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>

    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div>
            <?php echo $form->textField($loginForm,'email', ['placeholder'=>'Email*']); ?>
            <?php echo $form->error($loginForm,'email'); ?>
        </div>

        <div>
            <?php echo $form->passwordField($loginForm,'password', ['placeholder'=>'Password*']); ?>
            <?php echo $form->error($loginForm,'password'); ?>
        </div>

        <div class="rememberMe">
            <?php echo $form->checkBox($loginForm,'rememberMe'); ?>
            <?php echo $form->label($loginForm,'rememberMe'); ?>
            <?php echo $form->error($loginForm,'rememberMe'); ?>
        </div>

        <div>
            <?php echo CHtml::submitButton('Login', ['class'=>'submit_button']); ?>
        </div>
        <div>
            <?php //echo CHtml::link('LOST PASSWORD?', Yii::app()->createAbsoluteUrl('/site/passwordRecovery')); ?>

            <?php echo CHtml::link('LOST PASSWORD?', '#modal', array('class' => 'fancy-inline')); ?>

        </div>
        <?php $this->endWidget(); ?>
        <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
            'target'=>'.fancy-inline',
            'config'=>array(),
        )); ?>
        <div id="modal" style="display: none;">


                    <h4 class="title">Reset Your Password</h4>


            <div class="form">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'restore-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>

                <div>
                    <?php echo $form->textField($restore,'email', ['placeholder'=>'Email*']); ?>
                    <?php echo $form->error($restore,'email'); ?>
                </div>

                <div class="row buttons">
                    <?php echo CHtml::submitButton('Restore', ['class'=>'submit_button']); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div><!-- form -->

        </div>
    </div><!-- form -->
</div>
<div class="nine columns">
    <div class="title-wrapper">
        <div class="section-title">
            <h4 class="title">Register</h4>
        </div>
        <span class="divider"></span>
        <div class="clear"></div>
    </div>

    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'register-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="four columns">
            <div>
                <?php echo $form->textField($register,'first_name', ['placeholder'=>'First name*']); ?>
                <?php echo $form->error($register,'first_name'); ?>
            </div>
            <div>
                <?php echo $form->textField($register,'last_name', ['placeholder'=>'Last name*']); ?>
                <?php echo $form->error($register,'last_name'); ?>
            </div>
            <div>
                <?php echo $form->textField($register,'email', ['placeholder'=>'Email*', 'class'=>'span']); ?>
                <?php echo $form->error($register,'email'); ?>
            </div>
            <div>
                <?php echo $form->passwordField($register,'password', ['placeholder'=>'Password*']); ?>
                <?php echo $form->error($register,'password'); ?>
            </div>
            <div>
                <?php echo $form->passwordField($register,'password_repeat', ['placeholder'=>'Confirm password*']); ?>
                <?php echo $form->error($register,'password_repeat'); ?>
            </div>
        </div>
        <div class="four columns">
            <div>
                <?php echo $form->textField($register,'country', ['placeholder'=>'Country']); ?>
                <?php echo $form->error($register,'country'); ?>
            </div>
            <div>
                <?php echo $form->textField($register,'city', ['placeholder'=>'City']); ?>
                <?php echo $form->error($register,'city'); ?>
            </div>
            <div>
                <?php echo $form->textField($register,'street', ['placeholder'=>'Street']); ?>
                <?php echo $form->error($register,'street'); ?>
            </div>
        </div>
        <div class="clear"></div>


        <div>
            <?php echo CHtml::submitButton('Register', ['class'=>'submit_button']); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>