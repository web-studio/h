<?php

class BonusProgramController extends AdminController
{

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BonusProgram;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BonusProgram']))
		{
			$model->attributes=$_POST['BonusProgram'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BonusProgram']))
		{
			$model->attributes=$_POST['BonusProgram'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionConfirm($id, $confirm) {

        if($confirm=='ok') {
            $bonus = BonusProgram::model()->findByPk($id);
            $bonus->status = BonusProgram::STATUS_SUCCESS;
            $bonus->save();

            $dailyProfit = UserDeposit::model()->getDailyProfit($bonus->user_id);

            $amount = $dailyProfit * BonusProgram::BONUS_PERCENT;

            if ( $amount < 0.1 ) {
                $amount = 0.1;
            } elseif ( $amount > 10 ) {
                $amount = 10;
            }

            $transaction = new UserTransactions();
            $transaction->user_id = $bonus->user_id;
            $transaction->amount = $amount;
            $transaction->amount_type = UserTransactions::AMOUNT_TYPE_BONUS;
            $transaction->reason = 'Bonus program. ' .  BonusSites::model()->getUrlById($bonus->site_id) . ' ' . User::formatDate($bonus->date_create, true);
            $transaction->save();
        }

        if($confirm=='cancel') {
            $bonus = BonusProgram::model()->findByPk($id);
            $bonus->status = BonusProgram::STATUS_FAIL;
            $bonus->save();
        }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	public function actionIndex()
	{
		$model=new BonusProgram('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BonusProgram']))
			$model->attributes=$_GET['BonusProgram'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=BonusProgram::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bonus-program-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
