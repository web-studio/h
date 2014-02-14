<?php

class NewsWidget extends CWidget {

    public function run() {
        $news = Yii::app()->db->createCommand()
            ->from(News::model()->tableName())
            ->where('status =:status',[':status'=>News::PUBLIC_NEWS])
            ->order('created_time DESC')
            ->limit('3')
            ->queryAll();
       // var_dump($news);die;
        $this->render('newsWidget',[
            'news'=>$news
        ]);
    }
}