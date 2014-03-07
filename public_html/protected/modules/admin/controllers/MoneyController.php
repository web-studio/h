<?php

class MoneyController extends AdminController
{
    public $expirationDate = 7;

    public function actionIndex()
    {
        if ( isset($_POST['day']) && !empty($_POST['day'])) {
            $this->expirationDate = $_POST['day'];
        }

        $deps = Yii::app()->db->createCommand()
            ->select('expire, SUM(deposit_amount) as amount')
            ->from(UserDeposit::model()->tableName())
            ->group('DATE(expire)')
            ->order('expire ASC')
            ->where("status=1 AND expire>=NOW() AND expire<=DATE('" . date('Y-m-d h:i:s', time() + $this->expirationDate * 86400) . "')")
            ->queryAll();
        if ( isset($_POST) ) {
           var_dump($deps);
        }
        /*$deposits = new CActiveDataProvider('UserDeposit',
            array(
                'criteria' => array(
                    'condition' => 't.status=1',
                ),
                'pagination' => array(
                    'pageSize' => 30,
                    'pageVar' => 'page',
                ),

            ));*/

        $this->render('index', array(
            'deps' => $deps,
            //'deposits' => $deposits,
        ));
    }

    public function actionBalance() {
        // trying to open URL to process PerfectMoney Spend request
        $f=fopen('https://perfectmoney.is/acct/balance.asp?AccountID=' . Yii::app()->params['AccountID'] . '&PassPhrase=' . Yii::app()->params['PassPhrase'], 'rb');

        if($f===false){
            echo 'error openning url';
        }

        // getting data
        $out=array(); $out="";
        while(!feof($f)) $out.=fgets($f);

        fclose($f);

        // searching for hidden fields
        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
            echo 'Ivalid output';
            exit;
        }

        // putting data to array
        $balances="";
        foreach($result as $item){
            $key=$item[1];
            $balances[$key]=$item[2];
        }

        $this->render('balance', array(
            'balances' => $balances,
        ));
    }
}