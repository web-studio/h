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
            $this->addError('email', 'Пользователь с таким адресом не зарегистрирован');
            return false;
        }

        $user->password = substr(md5(time().uniqid()), 0, 12 );

        $mailResult = $user->sendMessage(
            'Восстановление пароля на thinktwice.ru',
            'Уважаемый пользователь! Ваш пароль изменен на ' . $user->password,
            array('email')
        );

        if ( !$mailResult ) {
            Yii::app()->user->setFlash('restore','Передача письма с новым паролем не удалась');
            return false;
        };

        $user->save();
        Yii::app()->user->setFlash('restore','Письмо с новым паролем отправлено Вам на Ваш адрес e-mail.');

        return true;

    }
}