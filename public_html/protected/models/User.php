<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $role_id
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
 * @property string $updatetime
 * @property string $last_visit
 * @property string $internal_purse
 * @property string $perfect_purse
 * @property string $secret
 * @property integer $status
 */
class User extends CActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_NOACTIVE = 0;
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
			array('role_id, status', 'numerical', 'integerOnly'=>true),
			array('login, email, password, mobile, first_name, last_name, city, country, street, activekey, internal_purse, perfect_purse, secret', 'length', 'max'=>255),
			array('createtime, updatetime, last_visit, perfect_purse', 'safe'),
            array('login, email, mobile', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_id, status, login, email, password, mobile, first_name, last_name, city, country, street, activekey, createtime, updatetime, last_visit, internal_purse, perfect_purse, secret', 'safe', 'on'=>'search'),
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
            'role' => array(self::BELONGS_TO, 'UserRole', 'role_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Role',
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
            'updatetime' => 'Updatetime',
			'last_visit' => 'Last Visit',
			'internal_purse' => 'Internal Purse',
			'perfect_purse' => 'Perfect Purse',
			'secret' => 'Secret',
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'createtime',
                'updateAttribute' => 'updatetime',
                'setUpdateOnCreate' => true,
                'timestampExpression' => new CDbExpression('NOW()'),
            ),

        );
    }

    public function getRole()
    {
        return $this->role;
    }

    public static function cryptPassword($password, $salt=185023) {
        return crypt($password, $salt);
    }

    public static function correctMobileNumber($mobile) {
        return str_replace(['+','-'],'',$mobile);
    }

    protected function beforeSave() {

        if ( $this->getIsNewRecord() ) {
            $this->password = self::cryptPassword($this->password);

            $this->internal_purse = strrev(time()) + (mt_rand(10, 99) . mt_rand(10, 99));
        } else {
            $old_password = self::model()->findByPk($this->id)->password;
            if ( $old_password != $this->password ) {
                $this->password = self::cryptPassword($this->password);
            }
            $this->mobile = self::correctMobileNumber($this->mobile);
        }
        return parent::beforeSave();
    }
    // Является ли пользователь чьим-нибудь рефералом
    public function isReferral($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT user_id
                FROM " . Referral::model()->tableName() . "
                WHERE ref_id=" . $user_id . "
                ")->queryRow();

            return $result;
        } else {
            return [];
        }
    }

    public static function formatDate($date,$time=false) {
        if ( $time == false ) {
            return date("M d, Y", strtotime($date));
        } else {
            return date("H:i M d, Y", strtotime($date));
        }
    }

    public function getAmount($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT amount_after
                FROM " . UserTransactions::model()->tableName() . "
                WHERE user_id=" . $user_id . "
                ORDER BY id DESC
                LIMIT 1
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }
    // Возвращает обрезанное имя пользователя
    public static function getСropNameById($id) {
        $result = Yii::app()->db->createCommand()
            ->select('first_name, last_name')
            ->from(User::model()->tableName())
            ->where('id=:id', array(':id'=>$id))
            ->queryRow();

        if ( strlen($result['last_name']) > 1 ) {
            $delStr = -1*(strlen($result['last_name'])-1);
            $last_name = substr_replace($result['last_name'],'.', $delStr);
        } else {
            $last_name = $result['last_name'].'.';
        }

        return $result['first_name'] . ' ' . $last_name;
    }

    // Возвращает обрезанное имя пользователя
    public static function getEmailById($id) {
        $result = Yii::app()->db->createCommand()
            ->select('email')
            ->from(User::model()->tableName())
            ->where('id=:id', array(':id'=>$id))
            ->queryRow();

        return $result['email'];
    }

    public static function getHomeLink() {
        if ( Yii::app()->user->role == 'admin' ) {
            $link = Yii::app()->createAbsoluteUrl('/admin');
        } elseif ( Yii::app()->user->role == 'user' ) {
            $link = Yii::app()->createAbsoluteUrl('/private');
        } else {
            $link = Yii::app()->createAbsoluteUrl('/');
        }
        return $link;
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
		$criteria->compare('role_id',$this->role_id);
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
        $criteria->compare('updatetime',$this->updatetime,true);
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
