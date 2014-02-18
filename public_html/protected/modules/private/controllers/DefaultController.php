<?php

class DefaultController extends PrivateController
{
	public function actionIndex()
	{

        $user = User::model()->findByPk(Yii::app()->user->id);
/*
        $refill = new RefillAccountForm();

        $refill->PAYEE_ACCOUNT = Yii::app()->params['payee_account'];
        $refill->PAYEE_NAME = Yii::app()->name;
        $refill->PAYMENT_ID = Yii::app()->user->id .'P'. time();
        $refill->PAYMENT_UNITS = Yii::app()->params['payment_units'];
        $refill->PAYMENT_AMOUNT = DepositType::model()->getMinDepositAmount();
        $refill->STATUS_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/status');
        $refill->PAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/success');
        $refill->PAYMENT_URL_METHOD = 'POST';
        $refill->NOPAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/fail');
        $refill->PAYMENT_URL_METHOD = 'POST';
*/
		$this->render('index', [
            'user'=>$user,
            //'refill'=>$refill
        ]);
	}
    // Реферальная программа
    public function actionReferrals() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        /*$referrals = new Referral('referralSearch');
        if(isset($_GET['Referral'])) {
            $referrals->attributes=$_GET['Referral'];
        }*/

        $referrals = Yii::app()->db->createCommand()
            ->select('ref_id')
            ->from(Referral::model()->tableName())
            ->where('user_id=:user_id', array(':user_id'=>Yii::app()->user->id))
            ->queryAll();


        $this->render('referrals', [
            'user'=>$user,
            'referrals'=>$referrals
        ]);
    }

    // рекламные материалы
    public function actionPromotionalMaterials() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        $this->render('promotional_materials', [
            'user'=>$user,
        ]);
    }

    // Инвестирование
    public function actionInvestment() {

        if ( isset($_POST['deposit']) && isset($_POST['amount']) ) {
            $depositType = DepositType::model()->findByPk((int)$_POST['deposit']);
            $amount = (int)$_POST['amount'];
            if ( $amount <= User::model()->getAmount() ) {
                if ( $amount >= $depositType->min_amount && $amount <= $depositType->max_amount ) {
                    $expireDate = BankDay::getEndDate('now', $depositType->days, 'Y-m-d H:i:s');
                    $transaction = new UserTransactions();
                    $transaction->user_id = Yii::app()->user->id;
                    $transaction->amount = -$amount;
                    $transaction->amount_type = UserTransactions::AMOUNT_TYPE_INVESTMENT;
                    $transaction->reason = 'Investment to "' . DepositType::model()->getNameById($depositType->id) . '". Refund of deposit '. User::formatDate($expireDate);

                    if ( $transaction->save() ) {
                        $deposit = new UserDeposit();
                        //$deposit->attributes = $_POST['Deposit'];
                        $deposit->deposit_amount = $amount;
                        $deposit->deposit_type_id = $depositType->id;
                        $deposit->expire = $expireDate;
                        $deposit->user_id = Yii::app()->user->id;
                        $deposit->status = 1;
                        $deposit->reinvest = 0;

                        $deposit->save();



                        if (  UserDeposit::model()->getCountDeposit() == 1 ) {
                            $referredBy = User::model()->isReferral();
                            if ( !empty($referredBy) ) {
                                if ( UserDeposit::model()->getAllAmountActiveDeposits($referredBy['user_id']) >= 1000 ) {
                                    $refAmount = $amount * Referral::REF_PERCENT_PARTNER;
                                } else {
                                    $refAmount = $amount * Referral::REF_PERCENT;
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

                        Yii::app()->user->setFlash('successMessage', 'Investing successful');
                    } else {
                        Yii::app()->user->setFlash('failMessage', 'Error investing');
                    }
                } else {
                    Yii::app()->user->setFlash('failMessage', 'Incorrectly specified amount');
                }
            } else {
                // оплата недостающей суммы перфектами
                $pm_amount = $amount - User::model()->getAmount();

                $transactionInComplete = new UserTransactionsIncomplete();
                $transactionInComplete->user_id = Yii::app()->user->id;
                $transactionInComplete->amount = $pm_amount;

                if ( $transactionInComplete->save() ) {

                    $transactionInComplete->payment_id = $transactionInComplete->id .'R'. time();
                    $transactionInComplete->save();

                    $deposit = new UserDeposit();
                    $deposit->deposit_amount = $amount;
                    $deposit->deposit_type_id = $depositType->id;
                    $deposit->expire = BankDay::getEndDate('now', $depositType->days, 'Y-m-d H:i:s');
                    $deposit->user_id = Yii::app()->user->id;
                    $deposit->status = UserDeposit::STATUS_PENDING;
                    $deposit->reinvest = 0;
                    $deposit->transaction_id = $transactionInComplete->id;
                    $deposit->save();

                    $refill = new RefillAccountForm();
                    $refill->PAYEE_ACCOUNT = Yii::app()->params['payee_account'];
                    $refill->PAYEE_NAME = Yii::app()->name;
                    $refill->PAYMENT_ID = $transactionInComplete->payment_id;
                    $refill->PAYMENT_UNITS = Yii::app()->params['payment_units'];
                    $refill->PAYMENT_AMOUNT = $pm_amount;
                    $refill->STATUS_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/status/invest/1');
                    $refill->PAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/success/invest/1');
                    $refill->PAYMENT_URL_METHOD = 'POST';
                    $refill->NOPAYMENT_URL = Yii::app()->createAbsoluteUrl('/private/perfectMoney/fail');
                    $refill->PAYMENT_URL_METHOD = 'POST';
                }

                $this->render('investment_perfect', [
                    'amount'=>$pm_amount,
                    'refill'=>$refill
                ]);
                Yii::app()->end();
            }
        }

        $depositTypes = DepositType::model()->findAll(['condition'=>'status=1']);

        $userDeposits = new UserDeposit('depositSearch');
        if(isset($_GET['UserDeposit'])) {
            $userDeposits->attributes=$_GET['UserDeposit'];
        }

        $this->render('investment', [
            'depositTypes'=>$depositTypes,
            //'user'=>$user,
            'userDeposits'=>$userDeposits,
        ]);
    }
    //перевод средств на внутренний кошелек
    public function actionInternalTransfers() {
        //Получаем полученные при переводе и переведенные средства авторизованного пользователя
        $userTransfers = new UserTransactions('transferSearch');

        if(isset($_GET['UserTransactions'])) {
            $userTransfers->attributes=$_GET['UserTransactions'];
        }
        if ( isset($_POST['internal_purse']) && isset($_POST['amount']) ) {

            $user = User::model()->findByAttributes(['internal_purse'=>$_POST['internal_purse']]);
            $amount = (int)$_POST['amount'];

            if ( $amount <= User::model()->getAmount() && $amount != 0 && $user != null ) {
                //Транзакции получателя
            $transaction_receiver = new UserTransactions();
            $transaction_receiver->user_id = $user->id;
            $transaction_receiver->amount = $_POST['amount'];
            $transaction_receiver->amount_type = UserTransactions::AMOUNT_TYPE_TRANSFER;
            $transaction_receiver->reason = 'Transfer from ' . User::getСropNameById(Yii::app()->user->id);
                if  ( $transaction_receiver->save() ) {
                    //Транзакции отправителя
                    $transaction_sender = new UserTransactions();
                    $transaction_sender->user_id = Yii::app()->user->id;
                    $transaction_sender->amount = -$_POST['amount'];
                    $transaction_sender->amount_type = UserTransactions::AMOUNT_TYPE_TRANSFER;
                    $transaction_sender->reason = 'Transfer to ' . User::getСropNameById($user->id);
                    $transaction_sender->receiver_id = $user->id;
                    if ( $transaction_sender->save() ){
                       Yii::app()->user->setFlash('successMessage', 'Operation was successful');
                    } else {
                       Yii::app()->user->setFlash('failMessage', 'Operation was not successful');

                    }
                }
            }else {
                Yii::app()->user->setFlash('failMessage', 'Incorrect amount or internal purse');
            }
        }

        $this->render('internalTransfers', [
            'userTransfers'=>$userTransfers,
        ]);
    }

    public function actionWithdraw() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        $outputTransactions = new OutputTransactions('OutputSearch');
        if(isset($_GET['OutputTransactions'])) {
            $outputTransactions->attributes=$_GET['OutputTransactions'];
        }

        $this->render('withdraw', [
            'user'=>$user,
            'outputTransactions'=>$outputTransactions
        ]);
    }

    public function actionTransactions() {
        $userTransactions = new UserTransactions('transactionSearch');
        if(isset($_GET['UserTransactions'])) {
            $userTransactions->attributes=$_GET['UserTransactions'];
        }
        $this->render('transactions', [
            'userTransactions'=>$userTransactions,
        ]);
    }

    public function actionBonus() {

        $bonusSites =  Yii::app()->db->createCommand()
            ->select('site.id, site.url')
            ->from('{{bonus_sites}} site')
            ->join('{{bonus_program}} p', 'p.site_id=site.id')
            ->where("site.status=:status AND (DATE_FORMAT(p.date_create, '%Y-%m-%d') > DATE_FORMAT('". date('Y-m-d', time()-86400) ."', '%Y-%m-%d') AND DATE_FORMAT(p.date_create, '%Y-%m-%d') <> DATE_FORMAT('". date('Y-m-d', time()) ."', '%Y-%m-%d'))",[':status'=>BonusSites::STATUS_ACTIVE])
            ->queryAll();
        var_dump($bonusSites);die;
        $this->render('bonus', [
            'bonusSites'=>$bonusSites,
        ]);
    }
}