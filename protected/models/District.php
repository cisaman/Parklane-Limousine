<?php

/**
 * This is the model class for table "{{district}}".
 *
 * The followings are the available columns in table '{{district}}':
 * @property integer $district_id
 * @property string $district_name_en
 * @property string $district_name_ch
 * @property integer $district_countryID
 * @property string $district_created
 * @property string $district_updated
 * @property integer $district_status
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property Country $districtCountry
 */
class District extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{district}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('district_name_en, district_name_ch', 'required', 'message' => Yii::t('lang', 'please_enter') . ' {attribute}.'),
            array('district_countryID', 'required', 'message' => Yii::t('lang', 'please_select') . ' {attribute}.'),
            array('district_countryID, district_status', 'numerical', 'integerOnly' => true),
            array('district_name_en, district_name_ch', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('district_id, district_name_en, district_name_ch, district_countryID, district_created, district_updated, district_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bookings' => array(self::HAS_MANY, 'Booking', 'booking_districtID'),
            'districtCountry' => array(self::BELONGS_TO, 'Country', 'district_countryID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'district_id' => Yii::t('lang', 'id'),
            'district_name_en' => Yii::t('lang', 'district_name').' English',
            'district_name_ch' => Yii::t('lang', 'district_name').' Chinese',
            'district_countryID' => Yii::t('lang', 'country_name'),
            'district_created' => Yii::t('lang', 'created_date'),
            'district_updated' => Yii::t('lang', 'updated_date'),
            'district_status' => Yii::t('lang', 'status'),
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

        $criteria->compare('district_id', $this->district_id);
        $criteria->compare('district_name_en', $this->district_name_en, true);
        $criteria->compare('district_name_ch', $this->district_name_ch, true);
        $criteria->compare('district_countryID', $this->district_countryID);
        $criteria->compare('district_created', $this->district_created, true);
        $criteria->compare('district_updated', $this->district_updated, true);
        $criteria->compare('district_status', $this->district_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'district_countryID ASC, district_name_en ASC'
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
     * @return District the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }    
    
    public static function getDistrictName($district_id) {
        $result = District::model()->findByPk($district_id);

        if (Yii::app()->user->getState('lang') == 'en') {
            $name = $result->district_name_en;
        } else {
            $name = $result->district_name_ch;
        }
        return $name;
    }
    
    public static function getDistrictList() {
        $countries = District::model()->findAll();
        $result = array();

        foreach ($countries as $country) {
            if (Yii::app()->user->getState('lang') == 'en') {
                $result[$country->district_id] = $country->district_name_en;
            } else {
                $result[$country->district_id] = $country->district_name_ch;
            }
        }
        return $result;
    }
    

    public function ws_District($country_id, $lang_id) {
        $districts = District::model()->findAllByAttributes(
                array('district_status' => 1, 'district_countryID' => $country_id), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => 'district_name_en ASC')
        );

        $flag = 2;
        $result = array();

        if (!empty($districts)) {

            foreach ($districts as $district) {

                $result[] = array(
                    'district_id' => $district->district_id,
                    'district_name' => ($lang_id == 1) ? $district->district_name_en : $district->district_name_ch
                );
            }
            $flag = 1;
        } else {
            $flag = 2;
        }

        $response = array('val' => $flag, 'districts' => $result);
        return $response;
    }

}
