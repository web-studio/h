<?php

class PerfectMoneyController extends PrivateController
{
    public function actionStatus() {
        $transactionInComlete = UserTransactionsIncomplete::model()->findByAttributes(array('payment_id' => $_POST['PAYMENT_ID']));

        define('ALTERNATE_PHRASE_HASH',  Yii::app()->params['PassPhrase']);
        // Path to directory to save logs. Make sure it has write permissions.
        define('PATH_TO_LOG',  'protected/runtime/deposit/');
        $alternate = strtoupper(md5(ALTERNATE_PHRASE_HASH));
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'. $alternate .':'.
            $_POST['TIMESTAMPGMT'];
        //mail('cronojhon@gmail.com','test',$string);
        $hash=strtoupper(md5($string));

        if($hash==$_POST['V2_HASH']){ // proccessing payment if only hash is valid
            /* In section below you must implement comparing of data you recieved
            with data you sent. This means to check if $_POST['PAYMENT_AMOUNT'] is
            particular amount you billed to client and so on. */
            if($_POST['PAYMENT_AMOUNT']==$transactionInComlete->amount && $_POST['PAYEE_ACCOUNT']==Yii::app()->params['payee_account'] && $_POST['PAYMENT_UNITS']==Yii::app()->params['payment_units']){

                $transaction = new UserTransactions();
                $transaction->amount = $_POST['PAYMENT_AMOUNT'];
                $transaction->user_id = $transactionInComlete->user_id;
                $transaction->payment_id = $transactionInComlete->payment_id;
                $transaction->reason = 'Add balance';
                $transaction->amount_type = UserTransactions::AMOUNT_TYPE_RECHARGE;
                $transaction->save();

                $f=fopen(PATH_TO_LOG."good.log", "ab+");
                fwrite($f, date("d.m.Y H:i")."; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                fclose($f);

                mail(Yii::app()->params->adminEmail, 'Поступил новый платеж', $_POST['PAYMENT_AMOUNT']);

            }else{ // you can also save invalid payments for debug purposes

                $f=fopen(PATH_TO_LOG."bad.log", "a");
                fwrite($f, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                fclose($f);

            }

        }
    }

    public function actionSuccess() {
        if ( !empty($_POST['PAYMENT_AMOUNT']) && !empty($_POST['PAYER_ACCOUNT']) && !empty($_POST['V2_HASH']) && !empty($_POST['PAYMENT_ID']) ) {
            //var_dump($_POST['V2_HASH']);die;
            $transaction = new UserTransactionsIncomplete();
            $transaction->amount = $_POST['PAYMENT_AMOUNT'];
            $transaction->payer = $_POST['PAYER_ACCOUNT'];
            $transaction->hash = $_POST['V2_HASH'];
            $transaction->user_id = Yii::app()->user->id;
            $transaction->payment_id = $_POST['PAYMENT_ID'];

            $user = User::model()->findByPk(Yii::app()->user->id);

            if ( $user->perfect_purse == null ) {

                $user->perfect_purse = $transaction->payer;
                $user->save();
            }

            if ( $transaction->save() ) {
                Yii::app()->user->setFlash('successMessage', 'The payment has been successfully completed');
            } else {
                Yii::app()->user->setFlash('failMessage', 'Error');
            }
        }
        $this->redirect($this->createUrl('/private'));
    }

    public function actionFail() {
        Yii::app()->user->setFlash('failMessage', 'Payment has not been completed or an error in the payment process.');
        $this->redirect($this->createUrl('/private'));
    }
}