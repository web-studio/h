<?php

class SiteController extends Controller {


    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'testLimit'=>2, //сколько раз капча не меняется
                'transparent'=>false,
                'foreColor'=>0x333333, //цвет символов
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

	public function actionIndex($partner=null)
	{
        $this->layout = '//layouts/home_column1';

        if ( Yii::app()->user->getState('partner') == null && $partner != null ) {
            Yii::app()->user->setState('partner', (int)$partner);
            //$this->redirect('/');
        }
       /* $mailer = new EMailer();


        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;

        $mailer->Host = 'smtp.yandex.ru';
        $mailer->Port = 25;

        $mailer->Username = 'rangeweb';  // SMTP login
        $mailer->Password = '82zczrnhw'; // SMTP password

        $mailer->From = 'rangeweb@yandex.ru';
        $mailer->FromName = 'administrator';

        $mailer->AddAddress('yborschev@gmail.com');

        $mailer->Subject = 'тест';
        $mailer->Body = 'тест';
        $mailer->IsHTML(true);

        $mailer->XMailer = ' ';
        $mailer->CharSet = 'UTF-8';

        $mailer->Send();*/
		$this->render('index');
	}



    public function actionEnter() {
        $this->layout = '//layouts/column1';
        if ( Yii::app()->user->id ) {
            $this->redirect(Yii::app()->createAbsoluteUrl('/private/'));
        } else {
            $loginForm=new LoginForm;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                echo CActiveForm::validate($loginForm);
                Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST['LoginForm']))
            {
                $loginForm->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($loginForm->validate() && $loginForm->login())
                    $this->redirect(User::getHomeLink());
            }

            $register = new RegisterForm();

            if ( Yii::app()->user->getState('partner') > 0 ) {
                $referrer = User::model()->find(['select'=>'id, login','condition'=>'id=:referral','params'=>[':referral'=>Yii::app()->user->getState('partner')]]);
                if ( $referrer != null ) {
                    $register->referral_id = $referrer->id;
                }
            }

            if(isset($_POST['RegisterForm']))
            {
                $register->attributes=$_POST['RegisterForm'];
                if( $register->validate() && $register->register() ) {
                    Yii::app()->user->setFlash('successMessage', 'Thank you for registration. To proceed, check your e-mail');
                    $this->redirect(Yii::app()->createAbsoluteUrl('/site/enter'));
                }
            }

            $restore = new RestoreForm();

            if(isset($_POST['RestoreForm'])) {
                $restore->attributes=$_POST['RestoreForm'];
                // validate user input and redirect to the previous page if valid
                if( $restore->validate() && $restore->restore() ) {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            $this->render('enter', array(
                'loginForm' => $loginForm,
                'register' => $register,
                'restore' => $restore,
            ));
        }
    }

    public function actionActivation($activekey=null, $email=null) {

        if ( $activekey != null && $email != null ) {

            $user = User::model()->findByAttributes(['email'=>$email]);

            if ( $user != null && $user->activekey == $activekey ) {
                $user->activekey = md5(microtime());
                $user->status = 1;
                $user->save();
                Yii::app()->user->setFlash('successMessage', 'You account is activated.');
            } else {
                Yii::app()->user->setFlash('failMessage', 'Incorrect activation URL');
            }
        }

        $this->redirect(Yii::app()->createAbsoluteUrl('/site/enter'));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionContacts()
    {
        $this->layout = '//layouts/column1';
        $model=new ContactForm;

        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/plain; charset=UTF-8";

                $email = Yii::app()->params['adminEmail'];
                //$admin = User::model()->findByPk(1);
                //$email = $admin->email;

                mail($email,$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. In the near future we will contact you.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

	public function actionError()
	{
        $this->layout = '//layouts/column2';


        if ($error = Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}