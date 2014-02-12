<?php

class DefaultController extends PrivateController
{
	public function actionIndex()
	{
        $user = User::model()->findByPk(Yii::app()->user->id);


		$this->render('index', [
            'user'=>$user
        ]);
	}

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

    public function actionInvestment() {

        //$user = User::model()->findByPk(Yii::app()->user->id);

        if ( isset($_POST['deposit']) && isset($_POST['amount']) ) {
            $depositType = DepositType::model()->findByPk((int)$_POST['deposit']);
            $amount = (int)$_POST['amount'];
            if ( $amount <= User::model()->getAmount() ) {
                if ( $amount >= $depositType->min_amount && $amount <= $depositType->max_amount ) {
                    $transaction = new UserTransactions();
                    $transaction->user_id = Yii::app()->user->id;
                    $transaction->amount = -$amount;
                    $transaction->amount_type = UserTransactions::AMOUNT_TYPE_INVESTMENT;
                    $transaction->reason = 'Investment';

                    if ( $transaction->save() ) {
                        $deposit = new UserDeposit();
                        //$deposit->attributes = $_POST['Deposit'];
                        $deposit->deposit_amount = $amount;
                        $deposit->deposit_type_id = $depositType->id;
                        $deposit->expire = BankDay::getEndDate('now', $depositType->days, 'Y-m-d H:i:s');
                        $deposit->user_id = Yii::app()->user->id;
                        $deposit->status = 1;
                        $deposit->reinvest = 0;
                        $deposit->save();

                        Yii::app()->user->setFlash('successMessage', 'Investing successful');
                    } else {
                        Yii::app()->user->setFlash('failMessage', 'Error investing');
                    }
                } else {
                    Yii::app()->user->setFlash('failMessage', 'Incorrectly specified amount');
                }
            } else {
                // оплата недостающей суммы перфектами
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
        if ( isset($_POST['internal_purse']) && isset($_POST['amount']) ) {
            $user = User::model()->findByAttributes(['internal_purse'=>$_POST['internal_purse']]);
            if ( $_POST['amount'] > 0 && $user != null){
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
                    if ( $transaction_sender->save() ){
                        echo Yii::app()->user->setFlash('successMessage', 'Operation successful');
                    }
                }
            }else {
                echo 'Incorrect amount or internal purse';
            }


        }
        $this->render('internalTransfers', [
            'transaction'=>$transaction
        ]);
    }

    public function actionWithdraw() {
        $this->render('withdraw', [
            //'user'=>$user
        ]);
    }

    public function actionTransactions() {
        $this->render('transactions', [
            //'user'=>$user
        ]);
    }
}