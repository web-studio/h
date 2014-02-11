<?php

class AjaxController extends PrivateController
{
    public function actionGetInvestAmount() {
        Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
        Yii::app()->clientScript->scriptMap['bootstrap-yii.css'] = false;
        Yii::app()->clientScript->scriptMap['jquery-ui.js'] = true;
        //Yii::app()->clientScript->scriptMap['jquery.js'] = true;
        //Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;
        //Yii::app()->clientScript->scriptMap['jquery.css'] = false;

        $deposit_id = (int)$_POST['deposit_id'];
        $deposit = Yii::app()->db->createCommand()
            ->select('min_amount, max_amount')
            ->from('{{deposit_types}} dep')
            ->where('dep.id=:id', [':id'=>$deposit_id])
            ->queryAll();

        $this->renderPartial('_invest_amount', [
            'deposit' => $deposit,
        ], null, true);
    }
}