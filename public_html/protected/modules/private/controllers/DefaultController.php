<?php

class DefaultController extends PrivateController
{
	public function actionIndex()
	{
        $user = User::model()->findByPk(Yii::app()->user->id);

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

		$this->render('index', [
            'user'=>$user,
            'refill'=>$refill
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