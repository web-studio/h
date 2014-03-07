<?php

class MoneyController extends AdminController
{
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