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

    public function actionReferral() {

    }

    public function actionInvestment() {

    }

    public function actionWithdraw() {

    }

    public function actionPaymentHistory() {

    }
}