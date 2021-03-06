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

    public function actionEditPassword(){

        if ( isset($_POST['password']) ) {
            $user = User::model()->find(['select'=>'id, password','condition'=>'id=:user_id', 'params'=>[':user_id'=>Yii::app()->user->id]]);
            $user->password = $_POST['password'];
            $user->save();

        }
    }

    public function actionBonusLink() {

        if ( Yii::app()->request->isAjaxRequest ) {

            if ( isset($_POST['link']) && isset($_POST['site_id']) ) {
                $link = $_POST['link'];
                $site_id = $_POST['site_id'];

                $site = Yii::app()->db->createCommand()
                    ->select('site.url')
                    ->from('{{bonus_sites}} site')
                    ->where("site.id=:site_id",[':site_id'=>$site_id])
                    ->queryScalar();

                $pos = strpos($link, $site);

                if ( $pos === false ) {
                    $errors = 1;
                    $code = 'Bad link';
                } else {

                    $findLink = BonusProgram::model()->find(['select'=>'id','condition'=>'link=:link AND status=:status', 'params'=>[':link'=>$_POST['link'], 'status'=>BonusProgram::STATUS_SUCCESS]]);

                    if ( $findLink != null ) {
                        $errors = 1;
                        $code = 'Bad link';
                    } else {
                        $bonusProgram = new BonusProgram();
                        $bonusProgram->user_id = Yii::app()->user->id;
                        $bonusProgram->site_id = $site_id;
                        $bonusProgram->link = $link;
                        $bonusProgram->status = BonusProgram::STATUS_PENDING;
                        if ( $bonusProgram->validate() && $bonusProgram->save() ) {
                            $errors = 0;
                            $code = 'Ok';
                        } else {
                            $errors = 1;
                            $code = 'Bad link';
                        }
                    }
                }
            }
        }

        echo CJSON::encode([
            'errors'=>$errors,
            'code' => $code,
        ]);
    }
}