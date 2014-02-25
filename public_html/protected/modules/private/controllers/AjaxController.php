<?php

class AjaxController extends PrivateController
{
    public function actionRefillAmount() {

        $transaction_id = strstr($_POST['payment_id'], 'R', true);
        $transactionInComplete = UserTransactionsIncomplete::model()->find(['condition'=>'id=:id AND user_id=:user_id', 'params'=>[':id'=>$transaction_id,':user_id'=>Yii::app()->user->id]]);

        $transactionInComplete->amount = $_POST['amount'];

        if ( $transactionInComplete->save() ) {
            $status = 1;
        } else {
            $status = 0;
        }

        echo CJSON::encode(
            array(
                'status'=> $status,
            ));

    }

    public function actionRefillTransaction() {

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
        Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
        Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;

        $transactionInComplete = new UserTransactionsIncomplete();
        $transactionInComplete->user_id = Yii::app()->user->id;

        if ( $transactionInComplete->save() ) {
            $refill = new RefillAccountForm();

            $transactionInComplete->payment_id = $transactionInComplete->id .'R'. time();
            $transactionInComplete->save();

            $refill->PAYEE_ACCOUNT = Yii::app()->params['payee_account'];
            $refill->PAYEE_NAME = Yii::app()->name;
            $refill->PAYMENT_ID = $transactionInComplete->payment_id;
            $refill->PAYMENT_UNITS = Yii::app()->params['payment_units'];
            $refill->PAYMENT_AMOUNT = DepositType::model()->getMinDepositAmount();
            $refill->STATUS_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/status');
            $refill->PAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/success');
            $refill->PAYMENT_URL_METHOD = 'POST';
            $refill->NOPAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/fail');
            $refill->PAYMENT_URL_METHOD = 'POST';
        }

        $this->renderPartial('refill',
            ['refill'=>$refill]);
    }

    public function actionEditPerfectMoneyAccount() {

        if ( isset($_POST['pm_account']) ) {
            $user = User::model()->find(['select'=>'id, perfect_purse','condition'=>'id=:user_id', 'params'=>[':user_id'=>Yii::app()->user->id]]);
            $user->perfect_purse = $_POST['pm_account'];
            if ( $user->save() ) {
                echo CJSON::encode(
                    array(
                        'pm'=> $user->perfect_purse,
                    )
                );
            }
        }
    }
}