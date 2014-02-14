<?php

/**
 * This is the model class for table "{{output_transactions}}".
 *
 * The followings are the available columns in table '{{output_transactions}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $payee_account_name
 * @property string $payee_account
 * @property string $payment_amount
 * @property string $payment_batch_num
 * @property string $payment_id
 * @property string $created_time
 * @property integer $status
 * @property string $error
 */
class OutputTransactions extends CActiveRecord
{

    const STATUS_ERROR = 0;
    const STATUS_SUCCESS = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{output_transactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('payee_account_name, payee_account, payment_batch_num, payment_id, error', 'length', 'max'=>255),
			array('payment_amount', 'length', 'max'=>10),
			array('created_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, payee_account_name, payee_account, payment_amount, payment_batch_num, payment_id, created_time, status, error', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'payee_account_name' => 'Payee Account Name',
			'payee_account' => 'Payee Account',
			'payment_amount' => 'Payment Amount',
			'payment_batch_num' => 'Payment Batch Num',
			'payment_id' => 'Payment',
			'created_time' => 'Created Time',
			'status' => 'Status',
			'error' => 'Error',
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_time',
                'updateAttribute' => 'created_time',
                'setUpdateOnCreate' => true,
                'timestampExpression' => new CDbExpression('NOW()'),
            )
        );
    }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('payee_account_name',$this->payee_account_name,true);
		$criteria->compare('payee_account',$this->payee_account,true);
		$criteria->compare('payment_amount',$this->payment_amount,true);
		$criteria->compare('payment_batch_num',$this->payment_batch_num,true);
		$criteria->compare('payment_id',$this->payment_id,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('error',$this->error,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OutputTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
