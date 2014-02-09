<?php

class SiteController extends Controller {

	public function actionIndex($referral=null)
	{
        if ( Yii::app()->user->getState('referral') == null && $referral != null ) {
            Yii::app()->user->setState('referral', $referral);
            //$this->redirect('/');
        }
        //var_dump(Yii::app()->user->getState('role'));die;
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
        $this->render('login',array('model'=>$model));
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