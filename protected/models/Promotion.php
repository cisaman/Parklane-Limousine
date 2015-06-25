<?php

/**
 * This is the model class for table "{{promotion}}".
 *
 * The followings are the available columns in table '{{promotion}}':
 * @property integer $promotion_id
 * @property string $promotion_title
 * @property string $promotion_file
 * @property string $promotion_created
 * @property string $promotion_updated
 * @property integer $promotion_status
 */
class Promotion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{promotion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('promotion_title', 'required', 'message' => 'Please enter {attribute}'),
			array('promotion_file', 'required', 'message' => 'Please select {attribute}'),
			array('promotion_status', 'numerical', 'integerOnly'=>true),
			array('promotion_title, promotion_file', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('promotion_id, promotion_title, promotion_file, promotion_created, promotion_updated, promotion_status', 'safe', 'on'=>'search'),
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
			'promotion_id' => 'ID',
			'promotion_title' => 'Title',
			'promotion_file' => 'Upload File',
			'promotion_created' => 'Created Date',
			'promotion_updated' => 'Updated Date',
			'promotion_status' => 'Status',
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

		$criteria->compare('promotion_id',$this->promotion_id);
		$criteria->compare('promotion_title',$this->promotion_title,true);
		$criteria->compare('promotion_file',$this->promotion_file,true);
		$criteria->compare('promotion_created',$this->promotion_created,true);
		$criteria->compare('promotion_updated',$this->promotion_updated,true);
		$criteria->compare('promotion_status',$this->promotion_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promotion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	/* Function for promotion list details */
    public function ws_promotionlist($user_type, $order_column, $order, $limit, $offset) {
        $promotions = Promotion::model()->findAllByAttributes(
                array('promotion_status' => 1), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => $order_column . ' ' . $order, 'limit' => $limit, 'offset' => $offset)
        );

        $flag = 2;
        $result = array();

        if (!empty($promotions)) {
            foreach ($promotions as $promotion) {
                $result[] = array(
                    'id' => $promotion->promotion_id,
                    'title' => $promotion->promotion_title,
                    'file_link' => Utils::getPromotionFilePath() . $promotion->promotion_file
                );
            }
            $flag = 1;
        } else {
            $flag = 2;
        }
		
		$quota = Quota::model()->findAll();
		$path = '';
		if(count($quota) > 0) {
			foreach($quota as $q) {
				if($q->quota_id == $user_type) {
					$path = Utils::getQuotaImagePath() . $q->quota_image;
				}
			}
		}

        $response = array('val' => $flag, 'promotions' => $result, 'path' => $path);
        return $response;
    }

}
