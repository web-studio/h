<?php

class PerfectMoneyController extends Controller
{

    public function actionStatus($invest=null) {

        if ( isset($_POST['PAYMENT_ID']) && isset($_POST['PAYEE_ACCOUNT']) && isset($_POST['PAYMENT_AMOUNT']) &&
            isset($_POST['PAYMENT_UNITS']) && isset($_POST['PAYMENT_BATCH_NUM']) && isset($_POST['PAYER_ACCOUNT']) &&
            isset($_POST['TIMESTAMPGMT'])) {

            $transaction_id = strstr($_POST['PAYMENT_ID'], 'R', true);
            $transactionInComplete = UserTransactionsIncomplete::model()->findByPk($transaction_id);

            if ( $transactionInComplete != null ) {

                $alternate = strtoupper(md5(Yii::app()->params['AlternateCode']));

                $string=
                    $transactionInComplete->payment_id.':'.Yii::app()->params['payee_account'].':'.
                    $_POST['PAYMENT_AMOUNT'].':'.Yii::app()->params['payment_units'].':'.
                    $_POST['PAYMENT_BATCH_NUM'].':'.
                    $_POST['PAYER_ACCOUNT'].':'. $alternate .':'.
                    $_POST['TIMESTAMPGMT'];

                $hash=strtoupper(md5($string));

                $transactionInComplete->payer = $_POST['PAYER_ACCOUNT'];
                $transactionInComplete->hash = $_POST['V2_HASH'];
                $transactionInComplete->batch_num = $_POST['PAYMENT_BATCH_NUM'];
                $transactionInComplete->time = $_POST['TIMESTAMPGMT'];
                $transactionInComplete->save();

                if($hash==$_POST['V2_HASH']){



                    if($_POST['PAYMENT_AMOUNT']==$transactionInComplete->amount && $_POST['PAYEE_ACCOUNT']==Yii::app()->params['payee_account'] && $_POST['PAYMENT_UNITS']==Yii::app()->params['payment_units']){

                        $transaction = new UserTransactions();
                        $transaction->amount = $transactionInComplete->amount;
                        $transaction->user_id = $transactionInComplete->user_id;
                        $transaction->payment_id = $transactionInComplete->payment_id;
                        $transaction->reason = 'Add balance';
                        $transaction->amount_type = UserTransactions::AMOUNT_TYPE_RECHARGE;
                        $transaction->save();

                        $user = User::model()->findByPk($transactionInComplete->user_id);

                        if ( $user->perfect_purse == null ) {
                            $user->perfect_purse = $transactionInComplete->payer;
                            $user->save();
                        }

                        if ( $invest != null ) {
                            $deposit = UserDeposit::model()->findByAttributes(['transaction_id'=>$transaction_id, 'status'=>UserDeposit::STATUS_PENDING]);

                            if ( $deposit != null ) {

                                if ( ($transactionInComplete->amount + User::model()->getAmount($transactionInComplete->user_id)) >= $deposit->deposit_amount ) {

                                    $deposit->status = 1;
                                    $deposit->save();

                                    //$expireDate = BankDay::getEndDate($deposit, $depositType->deposit_type_id, 'Y-m-d H:i:s');

                                    $transaction = new UserTransactions();
                                    $transaction->user_id = $transactionInComplete->user_id;
                                    $transaction->amount = -$deposit->deposit_amount;
                                    $transaction->amount_type = UserTransactions::AMOUNT_TYPE_INVESTMENT;
                                    $transaction->reason = 'Investment to "' . DepositType::model()->getNameById($deposit->deposit_type_id) . '". Refund of deposit '. User::formatDate($deposit->expire);
                                    $transaction->save();

                                    if (  UserDeposit::model()->getCountDeposit($transactionInComplete->user_id) == 1 ) {
                                        $referredBy = User::model()->isReferral($transactionInComplete->user_id);
                                        if ( !empty($referredBy) ) {
                                            if ( UserDeposit::model()->getAllAmountActiveDeposits($referredBy['user_id']) >= 1000 ) {
                                                $refAmount = $deposit->deposit_amount * Referral::REF_PERCENT_PARTNER;
                                            } else {
                                                $refAmount = $deposit->deposit_amount * Referral::REF_PERCENT;
                                            }

                                            $transaction = new UserTransactions();
                                            $transaction->user_id = $referredBy['user_id'];
                                            $transaction->amount = $refAmount;
                                            $transaction->amount_type = UserTransactions::AMOUNT_TYPE_REFERRAL;
                                            $transaction->reason = 'Profit referral of ' . User::getСropNameById(Yii::app()->user->id);
                                            $transaction->ref_id = Yii::app()->user->id;
                                            $transaction->save();
                                        }
                                    }
                                }
                            }
                        }

                        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/good_payment.log', 'ab+');
                        fwrite($fp, date("d.m.Y H:i")."; REASON: success payment; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                        fclose ($fp);

                    }else{
                        $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/fail_payment.log', 'a');
                        fwrite($fp, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($_POST)."; STRING: $string; HASH: $hash\n");
                        fclose ($fp);
                    }
                }
            } else {
                $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/fail_payment.log', 'a');
                fwrite($fp, date("d.m.Y H:i")."; REASON: no payment id; POST: ".serialize($_POST)."; \n");
                fclose ($fp);
            }

        } else {
            $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/login_attempt.log', 'a');
            fwrite($fp, date("d.m.Y H:i")."; IP: ".Yii::app()->request->userHostAddress."; URL:".Yii::app()->getRequest()->getPathInfo()."\n");
            fclose ($fp);
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
    }

    public function actionSuccess($invest=null) {

        if ( !empty($_POST['PAYMENT_AMOUNT']) && !empty($_POST['PAYER_ACCOUNT']) && !empty($_POST['V2_HASH']) && !empty($_POST['PAYMENT_ID']) ) {
            //var_dump($_POST['V2_HASH']);die;
            /*$transaction = new UserTransactionsIncomplete();
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

            if ( $transaction->save() ) {*/

            /*} else {
                Yii::app()->user->setFlash('failMessage', 'Error');
            }*/

            if ( $invest != null ) {
                Yii::app()->user->setFlash('successMessage', 'Investing successful');
                $this->redirect($this->createUrl('/private/investment'));
            }

            Yii::app()->user->setFlash('successMessage', 'The payment has been successfully completed');
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

    public function actionWithdraw() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        if ( $user->status == 1 ) {

            if ( !empty($_POST['amount']) && $_POST['amount'] > 0 ) {

                $amount = User::model()->getAmount();

                //сумма вывода не больше суммы на кошельке
                if ( $_POST['amount'] <= $amount ) {
                    //ограничиваем сумму максимального вывода
                    /*if (  $_POST['output_money'] > Yii::app()->params['max_amount_output'] ) {

                        $subject = 'Новая заявка на вывод!';
                        $message = 'От пользователя <strong>' . CHtml::link($user->username, $this->createAbsoluteUrl('/user/admin/view/', array('id' => $user->id))) .
                            '</strong> Поступила заявка на вывод Perfect Money<br />
                            <strong>Сумма вывода:</strong> ' . $_POST['output_money'] . '$<br />
                                <strong>Кошелек Perfect Money:</strong> ' . $user->perfect_purse;

                        mail(Yii::app()->params->adminEmail, $subject, $message);

                        User::model()->sendMessage(1, $subject, $message, Message::IMPORTANCE_1 );

                        Yii::app()->user->setFlash('profileMessage', 'To ensure safety, the withdrawal of more than ' . Yii::app()->params['max_amount_output'] . '$ is made by hand<br /><br />
                                                    Application for withdrawal successfully adopted<br />
                                                    Money will be transferred to your account within three hours');

                        $this->redirect($this->createUrl('/user/profile'));
                    } else {*/

                        $outputTransaction = new OutputTransactions();
                        $outputTransaction->user_id = Yii::app()->user->id;
                        $outputTransaction->save();

                        $payment_id = $outputTransaction->id .'W'. time();

                        $amount = UserTransactions::model()->replaceComma($_POST['amount']);

                        $perfect_purse = $_POST['perfect_purse'];

                        if ( $user->perfect_purse == null || $user->perfect_purse == '' ) {
                            $user->perfect_purse = $perfect_purse;
                            $user->save();
                        }

                        $f=fopen('https://perfectmoney.is/acct/confirm.asp?AccountID=' . Yii::app()->params['AccountID'] . '&PassPhrase=' . Yii::app()->params['PassPhrase'] . '&Payer_Account=' . Yii::app()->params['payee_account'] . '&Payee_Account=' . $perfect_purse . '&Amount=' . $amount . '&PAY_IN=' . $amount . ' &PAYMENT_ID=' . $payment_id, 'rb');

                        if($f===false){
                            $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/withdraw.log', 'a');
                            fwrite($fp, date("d.m.Y H:i")."; Reason: Error reading file; User ID:".Yii::app()->user->id."\n");
                            fclose ($fp);
                        }

                        // getting data
                        $out=array(); $out="";
                        while(!feof($f)) $out.=fgets($f);

                        fclose($f);

                        // searching for hidden fields
                        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
                            echo 'Invalid output';
                            exit;
                        }

                        $reply="";
                        foreach($result as $item){
                            $key=$item[1];
                            $reply[$key]=$item[2];
                        }

                        if ( isset($reply['ERROR']) ) {

                            $outputTransaction->error = $reply['ERROR'];
                            $outputTransaction->status = OutputTransactions::STATUS_ERROR;
                            $outputTransaction->payment_amount = $amount;
                            $outputTransaction->payment_id = $payment_id;
                            $outputTransaction->payee_account = $_POST['perfect_purse'];
                            $outputTransaction->save();

                            $transaction = new UserTransactions();
                            $transaction->amount = -$amount;
                            $transaction->user_id = $user->id;
                            $transaction->reason = 'Withdraw to Perfect Money account '. $user->perfect_purse;
                            $transaction->amount_type = UserTransactions::AMOUNT_TYPE_OUTPUT;
                            $transaction->payment_id = $payment_id;
                            $transaction->save();
                            /*$subject = 'Ошибка! Вывод PerfectMoney';
                            $message = "Ошибка: ". $reply['ERROR'] ."\r\n
                                    ID Пользователя: ". Yii::app()->user->id ."\r\n
                                    Сумма вывода: ". $amount ."\r\n
                                    ID Транзакции: ". $payment_id ."\r\n
                                    Кошелек PerfectMoney: ". $user->perfect_purse ."\r\n
                                    ";

                            mail(Yii::app()->params->adminEmail, 'Ошибка вывода на PerfectMoney', $message);

                            User::model()->sendMessage(1, $subject, $message, Message::IMPORTANCE_1 );
                            */

                            $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/withdraw.log', 'a');
                            fwrite($fp, date("d.m.Y H:i")."; Reason: ".$reply['ERROR']."; User ID:".Yii::app()->user->id."\n");
                            fclose ($fp);

                            Yii::app()->user->setFlash('failMessage', 'An unexpected error <br />
                                                    The error information sent to the site administrator<br />
                                                    The administrator will contact you shortly');

                            $this->redirect($this->createUrl('/private'));

                        } else {

                            $transaction = new UserTransactions();
                            $transaction->amount = -$amount;
                            $transaction->user_id = $user->id;
                            $transaction->reason = 'Withdraw to Perfect Money account '. $user->perfect_purse;
                            $transaction->amount_type = UserTransactions::AMOUNT_TYPE_OUTPUT;
                            $transaction->payment_id = $payment_id;
                            $transaction->save();

                            $outputTransaction->payee_account_name = $reply['Payee_Account_Name'];
                            $outputTransaction->payment_batch_num = $reply['PAYMENT_BATCH_NUM'];
                            $outputTransaction->status = OutputTransactions::STATUS_SUCCESS;
                            $outputTransaction->payment_amount = $amount;
                            $outputTransaction->payment_id = $payment_id;
                            $outputTransaction->payee_account = $_POST['perfect_purse'];
                            $outputTransaction->save();

                            Yii::app()->user->setFlash('successMessage', 'Withdrawal is successfully completed');
                        }
                    //}

                } else {
                    Yii::app()->user->setFlash('failMessage', 'Incorrectly state the amount');
                }

            }
        } else {
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
        $this->redirect(Yii::app()->createAbsoluteUrl('/private'));
    }
}