<?php

class StatementsWidget extends CWidget {

    public function run() {
        $line_array = file(Yii::app()->getBasePath() . '/extensions/widgets/statements/statements.txt');
        $line_random = array_rand($line_array);
        $statement = $line_array[$line_random];

        $this->render('statementsWidget',[
            'statement'=>$statement
        ]);
    }
}