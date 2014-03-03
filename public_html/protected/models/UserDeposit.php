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
 * @property string $date_create
 * @property integer $transaction_id
 */
class UserDeposit extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_NOACTIVE = 0;
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
			array('user_id, reinvest, status, transaction_id', 'numerical', 'integerOnly'=>true),
			array('deposit_type_id', 'length', 'max'=>255),
			array('expire, date_create, deposit_amount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, deposit_type_id, deposit_amount, expire, date_create, reinvest, status', 'safe', 'on'=>'search'),
            array('id, user_id, deposit_type_id, deposit_amount, expire, date_create, reinvest, status', 'safe', 'on'=>'depositSearch'),
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
            'deposit' => array(self::HAS_MANY, 'UserDeposit', 'user_id'),
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
			'deposit_type_id' => 'Deposit title',
			'deposit_amount' => 'Amount',
			'expire' => 'Expire date',
            'date_create' => 'Date create',
			'reinvest' => 'Reinvest',
			'status' => 'Status',
            'transaction_id' => 'Transaction ID'
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_create',
                'setUpdateOnCreate' => true,
                'timestampExpression' => new CDbExpression('NOW()'),
            )
        );
    }

    public function getSumDeposits($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT SUM(id)
                AS id
                FROM " . UserDeposit::model()->tableName() . "
                WHERE user_id=" . $user_id . " AND status = " . self::STATUS_ACTIVE . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getAllAmountActiveDeposits($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT SUM(deposit_amount)
                AS deposit_amount
                FROM " . UserDeposit::model()->tableName() . "
                WHERE user_id=" . $user_id . " AND status = " . self::STATUS_ACTIVE . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getIsDeposit() {
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT SUM(id)
                AS id
                FROM " . UserDeposit::model()->tableName() . "
                WHERE user_id=" . Yii::app()->user->id . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }
    // возвращает кол-во депозитов
    public function getCountDeposit($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT COUNT(user_id)
                FROM " . UserDeposit::model()->tableName() . "
                WHERE user_id=" . $user_id . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getDailyProfit($user_id=null) {
        if ( $user_id == null ) {
            $user_id = Yii::app()->user->id;
        }

        $deposits = Yii::app()->db->createCommand()
            ->selectDistinct('dep.id, dep.user_id, dep.deposit_type_id, dep.deposit_amount, dep.expire, type.percent')
            ->from('{{user_deposits}} dep')
            ->join('{{deposit_types}} type', 'type.id=dep.deposit_type_id')
            ->where("dep.user_id=:user_id AND dep.status=:status AND DATE_FORMAT(dep.expire, '%Y-%m-%d') >= DATE_FORMAT('". date('Y-m-d', time()) ."', '%Y-%m-%d')",[':user_id'=>$user_id,':status'=>UserDeposit::STATUS_ACTIVE])
            ->queryAll();

        $amount = 0;
        foreach ( $deposits as $deposit ) {
            if ( date('Y-m-d', strtotime($deposit['expire'])) >= date('Y-m-d', time()) ) {

                $percentAmount = ( $deposit['deposit_amount'] * $deposit['percent'] ) / 100;
                $amount +=$percentAmount;
            }
        }

        return $amount;

    }

    // Сумма первого депозита
    public function getAmountFirstDeposit($user_id) {
        if ( !$this->isNewRecord ) {

            $result = Yii::app()->db->createCommand("
                SELECT deposit_amount
                FROM " . UserDeposit::model()->tableName() . "
                WHERE user_id=" . $user_id . "
                ORDER BY id ASC
                LIMIT 1
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }
    // Статус депозита
    public function getStatus($status) {
        switch ( $status ) {
            case self::STATUS_ACTIVE:
                $status = 'Active';break;
            case self::STATUS_PENDING:
                $status = 'Pending';break;
            case self::STATUS_NOACTIVE:
                $status = 'Not active';break;
        }
        return $status;
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
        $criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('reinvest',$this->reinvest);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function depositSearch()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('deposit_type_id',$this->deposit_type_id,true);
        $criteria->compare('deposit_amount',$this->deposit_amount,true);
        $criteria->compare('expire',$this->expire,true);
        $criteria->compare('date_create',$this->date_create,true);
        $criteria->compare('reinvest',$this->reinvest);
        $criteria->compare('status',$this->status);
        $criteria->compare('transaction_id',$this->transaction_id);
        $criteria->addCondition('user_id='. Yii::app()->user->id);
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
