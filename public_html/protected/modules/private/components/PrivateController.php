<?php

class PrivateController extends Controller
{
    public $layout='//layouts/private_column2';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('user'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}