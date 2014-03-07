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
        $this->layout='//layouts/blank';
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

        $html = '<table><thead>
            <th>Time</th>
            <th>Type</th>
            <th>Batch</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Fee</th>
            <th>Payer Account</th>
            <th>Payee Account</th>
            <th>Memo</th>
        </thead>';
        // try parsing data to array
        /*if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Memo'){

            // print error message
            $html .= $lines[0];

        }else{
*/
            // do parsing
            $history=array();
            $n=count($lines);
            for($i=1; $i<$n; $i++){

                $html .= '<tr>';
                    $item=explode(",", $lines[$i], 9);
                    if(count($item)!=9) continue; // line is invalid - pass to next one
                    $html .= '<td>'.$item[0].'</td>';
                    $html .= '<td>'.$item[1].'</td>';
                    $html .= '<td>'.$item[2].'</td>';
                    $html .= '<td>'.$item[3].'</td>';
                    $html .= '<td>'.$item[4].'</td>';
                    $html .= '<td>'.$item[5].'</td>';
                    $html .= '<td>'.$item[6].'</td>';
                    $html .= '<td>'.$item[7].'</td>';
                    $html .= '<td>'.$item[8].'</td>';
                $html .= '</tr>';
            }
        $html .= '</table>';
       // }

        $this->render('history', array(
            'history'=>$html
        ));
    }
}