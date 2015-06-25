<?php

/**
 * This is the model class for table "{{quota}}".
 *
 * The followings are the available columns in table '{{quota}}':
 * @property integer $quota_id
 * @property string $quota_name
 * @property string $quota_desc
 * @property string $quota_image
 * @property string $quota_created
 * @property string $quota_updated
 * @property integer $quota_status
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property District[] $districts
 */
class Quota extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{quota}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('quota_name', 'required', 'message' => Yii::t('lang', 'please_enter') . ' {attribute}.'),
            array('quota_name', 'unique', 'message' => 'This {attribute} is already exists. Please enter a unique {attribute}.'),
            array('quota_status', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('quota_id, quota_name, quota_desc, quota_created, quota_updated, quota_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'quota_id' => Yii::t('lang', 'id'),
            'quota_name' => Yii::t('lang', 'quota_name'),
            'quota_desc' => Yii::t('lang', 'description'),
			'quota_image' => 'Banner Picture',
            'quota_created' => Yii::t('lang', 'created_date'),
            'quota_updated' => Yii::t('lang', 'updated_date'),
            'quota_status' => Yii::t('lang', 'status'),
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('quota_id', $this->quota_id);
        $criteria->compare('quota_name', $this->quota_name, true);
        $criteria->compare('quota_desc', $this->quota_desc, true);
        $criteria->compare('quota_created', $this->quota_created, true);
        $criteria->compare('quota_updated', $this->quota_updated, true);
        $criteria->compare('quota_status', $this->quota_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'quota_name ASC'
            ),
            'Pagination' => array(
                'PageSize' => 20
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Quota the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getQuotaName($quota_id) {
        $result = Quota::model()->findByPk($quota_id);
        return $result->quota_name;
    }

}
