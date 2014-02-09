<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $role
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $mobile
 * @property string $first_name
 * @property string $last_name
 * @property string $city
 * @property string $country
 * @property string $street
 * @property string $activekey
 * @property string $createtime
 * @property string $last_visit
 * @property string $internal_purse
 * @property string $perfect_purse
 * @property string $secret
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role', 'numerical', 'integerOnly'=>true),
			array('login, email, password, mobile, first_name, last_name, city, country, street, activekey, internal_purse, perfect_purse, secret', 'length', 'max'=>255),
			array('createtime, last_visit', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role, login, email, password, mobile, first_name, last_name, city, country, street, activekey, createtime, last_visit, internal_purse, perfect_purse, secret', 'safe', 'on'=>'search'),
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
			'role' => 'Role',
			'login' => 'Login',
			'email' => 'Email',
			'password' => 'Password',
			'mobile' => 'Mobile',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'city' => 'City',
			'country' => 'Country',
			'street' => 'Street',
			'activekey' => 'Activekey',
			'createtime' => 'Createtime',
			'last_visit' => 'Last Visit',
			'internal_purse' => 'Internal Purse',
			'perfect_purse' => 'Perfect Purse',
			'secret' => 'Secret',
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
		$criteria->compare('role',$this->role);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('activekey',$this->activekey,true);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('last_visit',$this->last_visit,true);
		$criteria->compare('internal_purse',$this->internal_purse,true);
		$criteria->compare('perfect_purse',$this->perfect_purse,true);
		$criteria->compare('secret',$this->secret,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
