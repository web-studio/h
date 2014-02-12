<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RefillAccountForm extends CFormModel
{
    public $PAYEE_ACCOUNT; //* номер нашего кошелька
    public $PAYMENT_UNITS; //* Валюта платежа. USD, EUR, OAU. Должна соответствовать выбранному аккаунту
    public $PAYEE_NAME; //* Имя, которое видит пользователь, совершающий платеж
    public $PAYMENT_ID; //Идентификатор данного платежа. Вы можете ввести сюда любое слово или текст
    public $PAYMENT_AMOUNT; //сумма платежа
    public $STATUS_URL; //Это ULR, по мерчант будет обращаться после успешного проведения платежа.
    //Вы можете ввести следующий - mailto:user@server.com для направления Ваших
    //платежей на указанный e-mail.
    public $PAYMENT_URL; //* Это URL куда пользователь будет перенаправлен после успешного проведения платежа.
    public $PAYMENT_URL_METHOD; //GET / POST / LINK
    public $NOPAYMENT_URL; //* Это URL куда пользователь будет перенаправлен после неудачной попытки провести платеж.
    public $NOPAYMENT_URL_METHOD; //GET / POST / LINK
    public $SUGGESTED_MEMO; //Дополнительные поля.

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('PAYMENT_AMOUNT', 'required'),
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

}