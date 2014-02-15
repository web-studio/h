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

        //if ( $key != null && $key == Yii::app()->params['CronSecretPhrase']) {
            if ( true ) {



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
                    /*Yii::app()->db->createCommand()
                        ->update('{{user_deposits}}', [
                            'status' => [':status'=>UserDeposit::STATUS_NOACTIVE],
                                ] )
                        ->where('id=:id', [':id'=>$deposit['id']]);
                        //->execute();*/
                }
            }
                echo $count;die;
                //$users = User::model()->findAll();
            foreach( $users as $user ) {
                if ( isset($user->deposit) ) {
                    $deposits = UserDeposit::model()->findAllByAttributes(array('user_id' => $user->id));
                    $summ = 0;
                    foreach( $deposits as $deposit ) {

                        if ( $deposit->status == 1 && $deposit->expire > date('Y-m-d H:i:s', time()) ) {

                            if ( $deposit->status == 1 && $deposit->date < date('Y-m-d H:i:s', time() - self::DEPOSIT_START_TIME)) {
                                $depositType = DepositType::model()->findByPk($deposit->deposit_type_id);

                                $percentAmount = ( $deposit->deposit_amount * Deposit::findTodayGeneralPercent() ) * $depositType->percent;

                                $transaction = new UserTransaction();
                                $transaction->user_id = $user->id;
                                $transaction->amount = $percentAmount;
                                $transaction->amount_type = UserTransaction::AMOUNT_TYPE_EARNINGS;
                                $transaction->reason = Yii::t('demon', 'Profit of deposits #') . $deposit->id;;
                                $transaction->save();
                                $summ += $percentAmount;

                            } else {
                                continue;
                            }
                        } else {
                            if ( $deposit->status == 1 ) {
                                $deposit->status = 0;
                                $deposit->save();

                                $transaction = new UserTransaction();
                                $transaction->user_id = $user->id;
                                $transaction->amount = $deposit->deposit_amount;
                                $transaction->amount_type = UserTransaction::AMOUNT_TYPE_BACK_INVESTMENT;
                                $transaction->reason = Yii::t('demon', 'Refund of a deposit #') . $deposit->id;
                                $transaction->save();
                            }
                        }
                    }

                    if ( $summ > 0 ) {
                        $message = 'Esteemed ' . $user->profile->first_name . '! Percents from the deposit are received on your account in sum $' . $summ;
                        Sms::send($user->phone, $message);
                    }

                } else {
                    continue;
                }
            }

        } else {
            throw new CHttpException(404);
        }
    }

    public function actionReferral($key=null) {

        if ( $key != null && $key == Yii::app()->params['CronSecretPhrase']) {

            $users = User::model()->findAll();

            foreach( $users as $user ) {
                if ( isset($user->refs) ) {
                    $countSumm = 0;
                    foreach( $user->refs as $referral ) {
                        $referral = User::model()->findByPk($referral->user->id);
                        $summ = 0;
                        if ( isset($referral->deposit) ) {
                            $result = Yii::app()->db->createCommand("
                            SELECT SUM(amount)
                            AS amount
                            FROM " . UserTransaction::model()->tableName() . "
                            WHERE user_id=". $referral->id ."
                            AND amount_type=" . UserTransaction::AMOUNT_TYPE_EARNINGS . "
                            AND time >= CURDATE()
                            ")->queryScalar();
                            $summ += $result;
                        }

                        if ( $summ > 0 ) {

                            $transaction = new UserTransaction();
                            $transaction->amount = $summ * Referral::REFERRAL_PERCENT;
                            $transaction->amount_type = UserTransaction::AMOUNT_TYPE_REFERRAL;
                            $transaction->user_id = $user->id;
                            $transaction->reason = Yii::t('demon', 'Profit referral of') . ' ' . $referral->username;
                            $transaction->save();

                        } else {
                            continue;
                        }
                        $countSumm +=$summ;
                    }

                    if ( $countSumm > 0 ) {
                        $message = 'Esteemed ' . $user->profile->first_name . '! Referral percents are received on your account in sum $' . $countSumm;
                        Sms::send($user->phone, $message);
                    }

                } else {
                    continue;
                }
            }
        } else {
            throw new CHttpException(404);
        }

    }
}
