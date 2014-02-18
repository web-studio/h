<?php

/**
 * This is the model class for table "{{bonus_program}}".
 *
 * The followings are the available columns in table '{{bonus_program}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $site_id
 * @property string $link
 * @property string $date_create
 * @property string $date_update
 * @property integer $status
 */
class BonusProgram extends CActiveRecord
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 0;
    const STATUS_PENDING = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{bonus_program}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, site_id, status', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>255),
			array('date_create, date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, link, date_create, date_update, status', 'safe', 'on'=>'search'),
            array('id, user_id, link, date_create, date_update, status', 'safe', 'on'=>'bonusSearch'),
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
            'site_id' => 'Site',
			'link' => 'Link',
			'date_create' => 'Added',
			'date_update' => 'Date Update',
			'status' => 'Status',
		);
	}

    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_update',
                'setUpdateOnCreate' => true,
                'timestampExpression' => new CDbExpression('NOW()'),
            ),

        );
    }

    public static function todayWasBonus($bonusSite_id){
        $bonus = BonusProgram::model()->find(['select'=>'id', 'condition'=>"site_id=:site_id AND DATE_FORMAT(date_create, '%Y-%m-%d') = DATE_FORMAT('". date('Y-m-d', time()) ."', '%Y-%m-%d')", 'params'=>[':site_id'=>$bonusSite_id]]);
        if ( $bonus != null ) {
            return true;
        } else {
            return false;
        }
    }

    public function getStatus($status_id) {
        switch ($status_id) {
            case self::STATUS_PENDING:
                $status = 'Pending';break;
            case self::STATUS_SUCCESS:
                $status = 'Paid';break;
            case self::STATUS_FAIL:
                $status = 'Сanceled';break;
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
        $criteria->compare('site_id',$this->site_id);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function bonusSearch()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('site_id',$this->site_id);
        $criteria->compare('link',$this->link,true);
        $criteria->compare('date_create',$this->date_create,true);
        $criteria->compare('date_update',$this->date_update,true);
        $criteria->compare('status',$this->status);
        $criteria->order = 'ID DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BonusProgram the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
