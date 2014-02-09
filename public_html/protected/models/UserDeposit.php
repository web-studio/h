<?php

/**
 * This is the model class for table "{{user_deposits}}".
 *
 * The followings are the available columns in table '{{user_deposits}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $deposit_type_id
 * @property string $deposit_amount
 * @property string $expire
 * @property integer $reinvest
 * @property integer $status
 */
class UserDeposit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_deposits}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, reinvest, status', 'numerical', 'integerOnly'=>true),
			array('deposit_type_id', 'length', 'max'=>255),
			array('deposit_amount', 'length', 'max'=>10),
			array('expire', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, deposit_type_id, deposit_amount, expire, reinvest, status', 'safe', 'on'=>'search'),
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
			'deposit_type_id' => 'Deposit Type',
			'deposit_amount' => 'Deposit Amount',
			'expire' => 'Expire',
			'reinvest' => 'Reinvest',
			'status' => 'Status',
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
		$criteria->compare('deposit_type_id',$this->deposit_type_id,true);
		$criteria->compare('deposit_amount',$this->deposit_amount,true);
		$criteria->compare('expire',$this->expire,true);
		$criteria->compare('reinvest',$this->reinvest);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserDeposit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
