<?php

/**
 * This is the model class for table "{{devices}}".
 *
 * The followings are the available columns in table '{{devices}}':
 * @property integer $device_id
 * @property integer $device_type
 * @property integer $device_userID
 * @property string $device_token
 *
 * The followings are the available model relations:
 * @property User $deviceUser
 */
class Devices extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{devices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('device_type, device_userID, device_token', 'required'),
			array('device_type, device_userID', 'numerical', 'integerOnly'=>true),
			array('device_token', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('device_id, device_type, device_userID, device_token', 'safe', 'on'=>'search'),
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
			'deviceUser' => array(self::BELONGS_TO, 'User', 'device_userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'device_id' => 'Device',
			'device_type' => 'Device Type',
			'device_userID' => 'Device User',
			'device_token' => 'Device Token',
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

		$criteria->compare('device_id',$this->device_id);
		$criteria->compare('device_type',$this->device_type);
		$criteria->compare('device_userID',$this->device_userID);
		$criteria->compare('device_token',$this->device_token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Devices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function ws_register($data){
		$device = new Devices();
		$device->device_type = $data['device_type'];
		$device->device_userID = $data['user_id'];
		$device->device_token = $data['device_token'];		
		
		if($device->save()) {
			return 1;
		} else {
			return 2;
		}
	}
	
	public static function ws_unregister($data){
		//$device = Devices::model()->findAllByAttributes(array('device_userID'=>$data['user_id'], 'device_token'=>$data['device_token']));		
		$device = Devices::model()->findAllByAttributes(array('device_token'=>$data['device_token']));
		
		$flag = 0;
		if(count($device) > 0) {
			foreach($device as $d) {
				$d->delete();			
				$flag = 1;
			}
		}
		
		if($flag) {
			return 1;
		} else {
			return 2;
		}		
	}
}
