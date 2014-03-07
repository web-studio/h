<?php

class MoneyController extends AdminController
{
    public $date;

    public function actionIndex()
    {
        if ( isset($_POST['day']) && !empty($_POST['day'])) {
            $this->date = $_POST['day'];
        } else {
            $this->date = date('Y-m-d', time()+(7*86400));
        }

        $deps = Yii::app()->db->createCommand()
            ->select('expire, SUM(deposit_amount) as amount')
            ->from(UserDeposit::model()->tableName())
            ->group('DATE(expire)')
            ->order('expire ASC')
            ->where("status=1 AND expire>=NOW() AND DATE(expire)<=DATE('" . date('Y-m-d', strtotime($this->date) ) . "')")
            ->queryAll();

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

        $this->render('index', array(
            'deps' => $deps,
            'date' => $this->date,
            'balances' => $balances,
        ));
    }

    public function actionPerfectHistory($start_date, $end_date) {

        $startmonth = date('m', strtotime($start_date));
        $startday = date('d', strtotime($start_date));
        $startyear = date('Y', strtotime($start_date));

        $endmonth = date('m', strtotime($end_date));
        $endday = date('d', strtotime($end_date));
        $endyear = date('Y', strtotime($end_date));

        // trying to open URL
        $f=fopen('https://perfectmoney.is/acct/historycsv.asp?startmonth=' . $startmonth . '&startday=' . $startday . '&startyear=' . $startyear . '&endmonth=' . $endmonth . '&endday=' . $endday . '&endyear=' . $endyear . '&AccountID=' . Yii::app()->params['AccountID'] . '&PassPhrase=' . Yii::app()->params['PassPhrase'], 'rb');

        if($f===false){
            echo 'error openning url';
        }



        // getting data to array (line per item)
        $lines=array();
        while(!feof($f)) array_push($lines, trim(fgets($f)));

        fclose($f);

        // try parsing data to array
        if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Memo'){

            // print error message
            echo $lines[0];

        }else{

            // do parsing
            $history=array();
            $n=count($lines);
            for($i=1; $i<$n; $i++){

                $item=explode(",", $lines[$i], 9);
                if(count($item)!=9) continue; // line is invalid - pass to next one
                $item_named['Time']=$item[0];
                $item_named['Type']=$item[1];
                $item_named['Batch']=$item[2];
                $item_named['Currency']=$item[3];
                $item_named['Amount']=$item[4];
                $item_named['Fee']=$item[5];
                $item_named['Payer Account']=$item[6];
                $item_named['Payee Account']=$item[7];
                $item_named['Memo']=$item[8];
                array_push($history, $item_named);
            }

        }

        $this->render('history', array(
            'history'=>$history
        ));
    }
}