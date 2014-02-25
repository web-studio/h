<?php

class PaymentDemonController extends Controller
{

    //const DEPOSIT_START_TIME = 172800;
    const DEPOSIT_START_TIME = 0;
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionDeposit($key=null) {

        if ( $key != null && $key == Yii::app()->params['CronSecretPhrase']) {
            //if ( true ) {



            $deposits = Yii::app()->db->createCommand()
                ->selectDistinct('dep.id, dep.user_id, dep.deposit_type_id, dep.deposit_amount, dep.expire, type.percent')
                ->from('{{user_deposits}} dep')
                ->join('{{deposit_types}} type', 'type.id=dep.deposit_type_id')
                ->where("dep.status=:status AND DATE_FORMAT(dep.expire, '%Y-%m-%d') >= DATE_FORMAT('". date('Y-m-d', time()) ."', '%Y-%m-%d')",[':status'=>UserDeposit::STATUS_ACTIVE])
                ->queryAll();

            $count = 0;
            foreach ( $deposits as $deposit ) {
                $count++;
                if ( date('Y-m-d', strtotime($deposit['expire'])) >= date('Y-m-d', time()) ) {

                    $percentAmount = ( $deposit['deposit_amount'] * $deposit['percent'] ) / 100;

                    $transaction = new UserTransactions();
                    $transaction->user_id = $deposit['user_id'];
                    $transaction->amount = $percentAmount;
                    $transaction->amount_type = UserTransactions::AMOUNT_TYPE_EARNINGS;
                    $transaction->reason = 'Earnings deposit';
                    $transaction->save();

                }

                if ( date('Y-m-d', strtotime($deposit['expire'])) == date('Y-m-d', time()) ) {
                    $sql = "UPDATE {{user_deposits}} SET status=" . UserDeposit::STATUS_NOACTIVE ." WHERE id=".$deposit['id'];
                    Yii::app()->db->createCommand($sql)->execute();
                }
            }


        } else {
            throw new CHttpException(404);
        }
    }

    public function actionFailWithdraw($key=null) {

        if ( $key != null && $key == Yii::app()->params['CronSecretPhrase']) {
        //if ( true ) {

            $outputTransactions = Yii::app()->db->createCommand()
                ->select('output.id, output.user_id, output.payee_account, output.payment_amount, output.payment_id')
                ->from('{{output_transactions}} output')
                ->where("output.status=:status",[':status'=>OutputTransactions::STATUS_ERROR])
                ->queryAll();

            foreach ( $outputTransactions as $outputTransaction ) {
                $user = User::model()->findByPk($outputTransactions['user_id']);

                if ( $user->status == 1 ) {

                    if ( $outputTransactions['payment_amount'] > 0 ) {

                        $amount = User::model()->getAmount($outputTransactions['user_id']);

                        //сумма вывода не больше суммы на кошельке
                        if ( $outputTransactions['payment_amount'] <= $amount ) {
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
                            $outputTransaction->user_id = $outputTransactions['user_id'];
                            $outputTransaction->save();

                            $payment_id = $outputTransaction->id .'W'. time();

                            $amount = UserTransactions::model()->replaceComma($outputTransactions['payment_amount']);

                            $f=fopen('https://perfectmoney.is/acct/confirm.asp?AccountID=' . Yii::app()->params['AccountID'] . '&PassPhrase=' . Yii::app()->params['PassPhrase'] . '&Payer_Account=' . Yii::app()->params['payee_account'] . '&Payee_Account=' . $outputTransactions['payee_account'] . '&Amount=' . $amount . '&PAY_IN=' . $amount . ' &PAYMENT_ID=' . $payment_id, 'rb');

                            if($f===false){
                                $fp = fopen(Yii::getPathOfAlias('webroot.protected.payment_log') . '/withdraw.log', 'a');
                                fwrite($fp, date("d.m.Y H:i")."; Reason: Error reading file; User ID:".$outputTransactions['user_id']."\n");
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
                            $transaction_id = strstr($outputTransactions['payment_id'], 'W', true);

                            if ( isset($reply['ERROR']) ) {

                                $oldTransaction = OutputTransactions::model()->findByPk($transaction_id);
                                $oldTransaction->status = OutputTransactions::STATUS_OVERDUE;

                                if ( $oldTransaction->save() ) {
                                    $outputTransaction->error = $reply['ERROR'];
                                    $outputTransaction->status = OutputTransactions::STATUS_ERROR;
                                    $outputTransaction->payment_amount = $amount;
                                    $outputTransaction->payment_id = $payment_id;
                                    $outputTransaction->payee_account = $outputTransactions['payee_account'];
                                    $outputTransaction->save();
                                }

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
                                fwrite($fp, date("d.m.Y H:i")."; Reason: ".$reply['ERROR']."; User ID:".$outputTransactions['user_id']."\n");
                                fclose ($fp);


                            } else {

                                $oldTransaction = OutputTransactions::model()->findByPk($transaction_id);
                                $oldTransaction->status = OutputTransactions::STATUS_SUCCESS;

                                if ( $oldTransaction->save() ) {

                                    $outputTransaction->payee_account_name = $reply['Payee_Account_Name'];
                                    $outputTransaction->payment_batch_num = $reply['PAYMENT_BATCH_NUM'];
                                    $outputTransaction->status = OutputTransactions::STATUS_SUCCESS;
                                    $outputTransaction->payment_amount = $amount;
                                    $outputTransaction->payment_id = $payment_id;
                                    $outputTransaction->payee_account = $outputTransactions['payee_account'];
                                    $outputTransaction->save();
                                }

                            }
                            //}
                        }
                    }
                }
            }

        } else {
            throw new CHttpException(404);
        }
    }
}
