<?php

class AjaxController extends PrivateController
{
    public function actionRefillTransaction() {
        $transactionInComplete = new UserTransactionsIncomplete();

        $transactionInComplete->user_id = Yii::app()->user->id;
        $transactionInComplete->payment_id = $_POST['payment_id'];
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
}