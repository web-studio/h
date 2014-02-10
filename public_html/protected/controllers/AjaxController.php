<?php

class AjaxController extends Controller {

    public function actionIndex($referral=null)
    {
        $this->layout = '//layouts/home_column1';

        if ( Yii::app()->user->getState('referral') == null && $referral != null ) {
            Yii::app()->user->setState('referral', $referral);
            //$this->redirect('/');
        }
        /*
                Yii::import('application.extensions.mailer.EMailer');
                $mailer = new EMailer();


                $mailer->IsSMTP();
                $mailer->SMTPAuth = true;

                $mailer->Host = 'smtp.gmail.com';
                $mailer->Port = 465;

                $mailer->Username = 'yborschev';  // SMTP login
                $mailer->Password = ''; // SMTP password

                $mailer->From = 'yborschev@gmail.com';
                $mailer->FromName = 'administrator';

                $mailer->AddAddress('yborschev@gmail.com');

                $mailer->Subject = 'тест';
                $mailer->Body = 'текст';
                $mailer->IsHTML(true);

                $mailer->XMailer = ' ';
                $mailer->CharSet = 'UTF-8';

                if ($mailer->Send()){
                    echo 1;
                } else {
                    echo 0;
                }*/
        $this->render('index');
    }

    public function actionRegister() {

        if ( Yii::app()->user->id ) {
            $this->redirect(Yii::app()->createAbsoluteUrl('/private/'));
        } else {
            $register = new RegisterForm();

            if ( Yii::app()->user->getState('referral') != null ) {
                $referrer = User::model()->find(['select'=>'id, login','condition'=>'login=:referral','params'=>[':referral'=>Yii::app()->user->getState('referral')]]);
                if ( $referrer != null ) {
                    $register->referral_id = $referrer->id;
                    $register->referral = $referrer->login;
                }
            }

            if(isset($_POST['RegisterForm']))
            {
                $register->attributes=$_POST['RegisterForm'];
                if( $register->validate() && $register->register() ) {
                    Yii::app()->user->setFlash('successMessage', 'Registration was successful');
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            $this->render('register', array(
                'register' => $register,
            ));
        }
    }

    public function actionPasswordRecovery() {
        $restore = new RestoreForm();

        if(isset($_POST['RestoreForm'])) {
            $restore->attributes=$_POST['RestoreForm'];
            // validate user input and redirect to the previous page if valid
            if( $restore->validate() && $restore->restore() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('restore',array('restore'=>$restore));
    }


    public function actionLogin()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->renderPartial('login',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}