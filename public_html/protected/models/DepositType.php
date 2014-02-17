<?php

/**
 * This is the model class for table "{{deposit_types}}".
 *
 * The followings are the available columns in table '{{deposit_types}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $days
 * @property integer $percent
 * @property integer $min_amount
 * @property integer $max_amount
 * @property integer $status
 * @property string $total_return
 */
class DepositType extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_NOACTIVE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{deposit_types}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('days, min_amount, max_amount, status', 'numerical', 'integerOnly'=>true),
			array('name, description, total_return', 'length', 'max'=>255),
            array('percent', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, days, percent, min_amount, max_amount, status, total_return', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'days' => 'Days',
			'percent' => 'Percent',
			'min_amount' => 'Min Amount',
			'max_amount' => 'Max Amount',
			'status' => 'Status',
			'total_return' => 'Total Return',
		);
	}

    public function getNameById($id) {
        $result = Yii::app()->db->createCommand("
        SELECT name
        FROM " . self::tableName() . "
        WHERE id=" . $id . "
        ")->queryScalar();

        return $result;
    }

    public function getMinDepositAmount() {
        $minAmount = Yii::app()->db->createCommand()
            ->select('MIN(min_amount) as minAmount')
            ->from(self::tableName())
            ->where('status=:status',[':status'=>self::STATUS_ACTIVE])
            ->queryScalar();

        return $minAmount;
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('days',$this->days);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('min_amount',$this->min_amount);
		$criteria->compare('max_amount',$this->max_amount);
		$criteria->compare('status',$this->status);
		$criteria->compare('total_return',$this->total_return,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DepositType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
