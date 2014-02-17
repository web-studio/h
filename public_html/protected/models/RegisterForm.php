<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
    public $first_name;
    public $last_name;
    public $mobile;
    public $secret;

    public $email;
    public $password;
    public $password_repeat;

    public $city;
    public $country;
    public $street;

    public $referral_id;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('first_name, last_name, password, password_repeat, email', 'required'),
            array('email', 'email'),
            array('password', 'length','min'=>8, 'tooShort'=> 'Minimum 8 characters', 'tooLong'=> 'Minimum 8 characters'),
            array('password_repeat', 'compare', 'compareAttribute'=>'password'),
            array('mobile, city, country, street, referral', 'safe')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'first_name'=>'First name',
            'last_name' => 'Last name',
            'mobile' => 'Mobile number',
            'secret' => 'Codeword',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Confirm password',
            'city'=>'City',
            'country'=>'Country',
            'street'=>'Street',
            'referral'=>'Referral'
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function register()
    {

        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->mobile = $this->mobile;
        $user->mobile = User::correctMobileNumber($user->mobile);
        $user->country = $this->country;
        $user->city = $this->city;
        $user->street = $this->street;
        $user->role_id = UserRole::USER_ROLE;
        $user->activekey = md5($this->password.microtime());
        $user->status = User::STATUS_NOACTIVE;

        if ( $user->save() ) {
            if ( Yii::app()->params['activationType'] == 'sms' ) {

            }

            if (Yii::app()->params['activationType'] == 'email') {
                $activation_url = Yii::app()->createAbsoluteUrl('/activation/?activekey='. $user->activekey. '&email='. $user->email);

                $message = $user->first_name . ' ' . $user->last_name .' welcome to '. Yii::app()->name . '<br />Please activate you account go to '.
                    '<a href="'.$activation_url.'">activation link</a>';

                Email::sendMail($user->email,
                    "Welcome to " . Yii::app()->name,
                    $message
                );
            }

            if ( $this->referral_id != null ) {
                $referral = new Referral();
                $referral->user_id = $this->referral_id;
                $referral->ref_id = $user->id;
                $referral->save();
            }

            $this->_identity=new UserIdentity($this->email,$this->password);
            $this->_identity->authenticate();
            $duration= 3600*24*30; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else {
            foreach ( $user->getErrors() as $field => $errors ) {
                $this->addError($field, implode('<br />', $errors));
            }
            return false;
        }

    }
}