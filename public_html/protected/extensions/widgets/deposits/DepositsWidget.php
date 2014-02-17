<?php

class DepositsWidget extends CWidget {

    public function run() {
        $depositTypes = DepositType::model()->findAll(['condition'=>'status=1']);

        $this->render('depositsWidget',[
            'depositTypes'=>$depositTypes
        ]);
    }
}