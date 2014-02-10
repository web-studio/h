<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RestoreForm extends CFormModel
{
    public $email;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email', 'required'),
            array('email', 'email')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function restore()
    {

        $user = User::model()->findByAttributes(array('email' => $this->email));
        if ( null == $user ) {
            $this->addError('email', 'User with this email is not registered');
            return false;
        }

        $user->password = substr(md5(time().uniqid()), 0, 12 );

        $mailResult = Email::sendMail(
            $user->email,
            'Password recovery on ' . Yii::app()->getRequest()->getHostInfo(),
            'Dear user! Your password has been changed to ' . $user->password
        );

        if ( !$mailResult ) {
            Yii::app()->user->setFlash('failMessage','Send E-mail with a new password failed');
            return false;
        };

        $user->save();
        Yii::app()->user->setFlash('successMessage','A new password sent to you at your address e-mail.');

        return true;

    }
}