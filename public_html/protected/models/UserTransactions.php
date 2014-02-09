<?php

/**
 * This is the model class for table "{{user_transactions}}".
 *
 * The followings are the available columns in table '{{user_transactions}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $amount
 * @property integer $amount_type
 * @property string $payment_id
 * @property string $reason
 * @property string $time
 * @property string $amount_after
 * @property string $amount_before
 */
class UserTransactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_transactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, amount_type', 'numerical', 'integerOnly'=>true),
			array('amount, amount_after, amount_before', 'length', 'max'=>10),
			array('payment_id, reason', 'length', 'max'=>255),
			array('time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, amount, amount_type, payment_id, reason, time, amount_after, amount_before', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'amount_type' => 'Amount Type',
			'payment_id' => 'Payment',
			'reason' => 'Reason',
			'time' => 'Time',
			'amount_after' => 'Amount After',
			'amount_before' => 'Amount Before',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('amount_type',$this->amount_type);
		$criteria->compare('payment_id',$this->payment_id,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('amount_after',$this->amount_after,true);
		$criteria->compare('amount_before',$this->amount_before,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
