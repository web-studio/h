<?php

/**
 * This is the model class for table "{{referrals}}".
 *
 * The followings are the available columns in table '{{referrals}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $ref_id
 */
class Referral extends CActiveRecord
{

    const REF_PERCENT = 0.05;
    const REF_PERCENT_PARTNER = 0.08;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{referrals}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, ref_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, ref_id', 'safe', 'on'=>'search'),
            array('id, user_id, ref_id', 'safe', 'on'=>'referralSearch'),
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
			'ref_id' => 'Ref',
		);
	}

    public function getSumReferrals() {
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT COUNT(user_id)
                FROM " . self::tableName() . "
                WHERE user_id=" . Yii::app()->user->id ."
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getReferralProfit($ref_id) {
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT amount
                FROM " . UserTransactions::model()->tableName() . "
                WHERE user_id=" . Yii::app()->user->id ." AND ref_id=" . $ref_id . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getTotalReferralProfit() {
        if ( !$this->isNewRecord ) {
            $result = Yii::app()->db->createCommand("
                SELECT SUM(amount) as amount
                FROM " . UserTransactions::model()->tableName() . "
                WHERE user_id=" . Yii::app()->user->id ." AND amount_type=" . UserTransactions::AMOUNT_TYPE_REFERRAL . "
                ")->queryScalar();

            return $result ?: 0;
        } else {
            return 0;
        }
    }

    public function getReferralBonus() {
        if ( UserDeposit::model()->getAllAmountActiveDeposits() >= 1000 ) {
            return self::REF_PERCENT_PARTNER * 100 . '% (Partner)';
        } else {
            return self::REF_PERCENT * 100 . '% (Increased to 8% can be when the investment amount over $1000)';
        }

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
		$criteria->compare('ref_id',$this->ref_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function referralSearch()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('ref_id',$this->ref_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Referral the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
