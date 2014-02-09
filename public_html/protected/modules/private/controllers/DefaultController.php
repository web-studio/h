<?php

class DefaultController extends PrivateController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}