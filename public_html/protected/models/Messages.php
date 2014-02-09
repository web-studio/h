<?php

/**
 * This is the model class for table "{{messages}}".
 *
 * The followings are the available columns in table '{{messages}}':
 * @property integer $id
 * @property integer $from_msg
 * @property integer $to_msg
 * @property string $subject
 * @property string $message
 * @property string $file
 * @property string $send_time
 * @property string $reading_time
 * @property integer $status
 * @property integer $trash
 */
class Messages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_msg, to_msg, status, trash', 'numerical', 'integerOnly'=>true),
			array('subject, file', 'length', 'max'=>255),
			array('message, send_time, reading_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from_msg, to_msg, subject, message, file, send_time, reading_time, status, trash', 'safe', 'on'=>'search'),
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
			'from_msg' => 'From Msg',
			'to_msg' => 'To Msg',
			'subject' => 'Subject',
			'message' => 'Message',
			'file' => 'File',
			'send_time' => 'Send Time',
			'reading_time' => 'Reading Time',
			'status' => 'Status',
			'trash' => 'Trash',
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
		$criteria->compare('from_msg',$this->from_msg);
		$criteria->compare('to_msg',$this->to_msg);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('send_time',$this->send_time,true);
		$criteria->compare('reading_time',$this->reading_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('trash',$this->trash);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
