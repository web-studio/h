<?php

class PerfectMoneyController extends Controller
{


    public function actionStatus() {
        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/login_attempt.log', 'a');
        fwrite($fp, date("d.m.Y H:i")."; IP: ".Yii::app()->request->userHostAddress."; URL:".Yii::app()->getRequest()->getPathInfo().";time: date('H:i:s')\n");
        fclose ($fp);
        die;
        if ( isset($_POST['PAYMENT_ID']) && isset($_POST['PAYEE_ACCOUNT']) && isset($_POST['PAYMENT_AMOUNT']) &&
            isset($_POST['PAYMENT_UNITS']) && isset($_POST['PAYMENT_BATCH_NUM']) && isset($_POST['PAYER_ACCOUNT']) &&
            isset($_POST['TIMESTAMPGMT'])) {

            $transactionInComplete = UserTransactionsIncomplete::model()->findByAttributes(array('payment_id' => $_POST['PAYMENT_ID']));

            //if ( $transactionInComplete != null ) {

                $alternate = strtoupper(md5(Yii::app()->params['PassPhrase']));

                $string=
                    $transactionInComplete->payment_id.':'.Yii::app()->params['payee_account'].':'.
                    $transactionInComplete->amount.':'.Yii::app()->params['payment_units'].':'.
                    $transactionInComplete->batch_num.':'.
                    $transactionInComplete->payer.':'. $alternate .':'.
                    $transactionInComplete->time;

                $hash=strtoupper(md5($string));

                if($hash==$_POST['V2_HASH']){ // proccessing payment if only hash is valid
                    /* In section below you must implement comparing of data you recieved
                    with data you sent. This means to check if $_POST['PAYMENT_AMOUNT'] is
                    particular amount you billed to client and so on. */
                    if($_POST['PAYMENT_AMOUNT']==$transactionInComplete->amount && $_POST['PAYEE_ACCOUNT']==Yii::app()->params['payee_account'] && $_POST['PAYMENT_UNITS']==Yii::app()->params['payment_units']){

                        $transaction = new UserTransactions();
                        $transaction->amount = $transactionInComplete->amount;
                        $transaction->user_id = $transactionInComplete->user_id;
                        $transaction->payment_id = $transactionInComplete->payment_id;
                        $transaction->reason = 'Add balance';
                        $transaction->amount_type = UserTransactions::AMOUNT_TYPE_RECHARGE;
                        $transaction->save();

                        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/good_payment.log', 'ab+');
                        fwrite($fp, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                        fclose ($fp);

                    }else{ // you can also save invalid payments for debug purposes
                        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/fail_payment.log', 'a');
                        fwrite($fp, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                        fclose ($fp);
                    }
                }
            /*} else {
                $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/fail_payment.log', 'a');
                fwrite($fp, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; ". $_POST['PAYMENT_ID']);
                fclose ($fp);
            }*/

        } else {
            $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/login_attempt.log', 'a');
            fwrite($fp, date("d.m.Y H:i")."; IP: ".Yii::app()->request->userHostAddress."; URL:".Yii::app()->getRequest()->getPathInfo()."\n");
            fclose ($fp);
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
    }

    public function actionSuccess() {
        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/login_attempt.log', 'a');
        fwrite($fp, date("d.m.Y H:i")."; IP: ".Yii::app()->request->userHostAddress."; URL:".Yii::app()->getRequest()->getPathInfo().";time: date('H:i:s')\n");
        fclose ($fp);
        die;
        $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        if ( !empty($_POST['PAYMENT_AMOUNT']) && !empty($_POST['PAYER_ACCOUNT']) && !empty($_POST['V2_HASH']) && !empty($_POST['PAYMENT_ID']) ) {
            //var_dump($_POST['V2_HASH']);die;
            $transaction = new UserTransactionsIncomplete();
            $transaction->amount = $_POST['PAYMENT_AMOUNT'];
            $transaction->payer = $_POST['PAYER_ACCOUNT'];
            $transaction->hash = $_POST['V2_HASH'];
            $transaction->user_id = Yii::app()->user->id;
            $transaction->payment_id = $_POST['PAYMENT_ID'];
            $transaction->batch_num = $_POST['PAYMENT_BATCH_NUM'];
            $transaction->time = $_POST['TIMESTAMPGMT'];

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

            $this->redirect($this->createUrl('/private'));
        } else {
            $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/login_attempt.log', 'a');
            fwrite($fp, date("d.m.Y H:i")."; IP: ".Yii::app()->request->userHostAddress."; URL:".Yii::app()->getRequest()->getPathInfo()."\n");
            fclose ($fp);
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
    }

    public function actionFail() {
        Yii::app()->user->setFlash('failMessage', 'Payment has not been completed or an error in the payment process.');
        $this->redirect($this->createUrl('/private'));
    }
}