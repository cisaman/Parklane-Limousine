<?php

/**
 * This is the model class for table "{{country}}".
 *
 * The followings are the available columns in table '{{country}}':
 * @property integer $country_id
 * @property string $country_name_en
 * @property string $country_name_ch
 * @property string $country_price
 * @property string $country_created
 * @property string $country_updated
 * @property integer $country_status
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property District[] $districts
 */
class Country extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{country}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_name_en, country_name_ch, country_price', 'required', 'message' => Yii::t('lang', 'please_enter') . ' {attribute}.'),
            array('country_name_en, country_name_ch', 'unique', 'message' => 'This {attribute} is already exists. Please enter a unique {attribute}.'),
            array('country_status', 'numerical', 'integerOnly' => true),
            array('country_name_en, country_name_ch', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('country_id, country_name_en, country_name_ch, country_price, country_created, country_updated, country_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bookings' => array(self::HAS_MANY, 'Booking', 'booking_countryID'),
            'districts' => array(self::HAS_MANY, 'District', 'district_countryID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'country_id' => Yii::t('lang', 'id'),
            'country_name_en' => Yii::t('lang', 'country_name') . ' English',
            'country_name_ch' => Yii::t('lang', 'country_name') . ' Chinese',
            'country_price' => Yii::t('lang', 'price'),
            'country_created' => Yii::t('lang', 'created_date'),
            'country_updated' => Yii::t('lang', 'updated_date'),
            'country_status' => Yii::t('lang', 'status'),
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

        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('country_name_en', $this->country_name_en, true);
        $criteria->compare('country_name_ch', $this->country_name_ch, true);
        $criteria->compare('country_price', $this->country_price, true);
        $criteria->compare('country_created', $this->country_created, true);
        $criteria->compare('country_updated', $this->country_updated, true);
        $criteria->compare('country_status', $this->country_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'country_created DESC'
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
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getCountryName($country_id) {
        $result = Country::model()->findByPk($country_id);

        if (Yii::app()->user->getState('lang') == 'en') {
            $name = $result->country_name_en;
        } else {
            $name = $result->country_name_ch;
        }
        return $name;
    }

    public static function getCountryList() {
        $countries = Country::model()->findAll();
        $result = array();

        foreach ($countries as $country) {
            if (Yii::app()->user->getState('lang') == 'en') {
                $result[$country->country_id] = $country->country_name_en;
            } else {
                $result[$country->country_id] = $country->country_name_ch;
            }
        }
        return $result;
    }

    public static function getCountryPrice($country_id) {
        $result = Country::model()->findByPk($country_id);
        return $result->country_price;
    }

    public function ws_Country($state, $user_id, $lang_id) {

        $countries = Country::model()->findAllByAttributes(
                array('country_status' => 1), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => 'country_id ASC')
        );


        $user_bookings = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_userID' => $user_id), 'YEAR(booking_created)=' . date('Y') . ' AND MONTH(booking_created)=' . date('m'));
        $record_count = count($user_bookings);

        $flag = 2;
        $result = array();

        if (!empty($countries)) {

            foreach ($countries as $country) {

                $price = $country->country_price;
                if ($record_count <= 2) {
                    //Give Discount
                    $option = Option::model()->findByPk(3);
                    $discount = $option->option_value;
                    if (empty($discount)) {
                        $discount = 0;
                    }
                    $price = $price - ($price * ($discount / 100));
                }

                if ($state != 0) {
                    $result[] = array(
                        'country_id' => $country->country_id,
                        'country_name' => ($lang_id == 1) ? $country->country_name_en : $country->country_name_ch,
                        'country_price' => $price
                    );
                } else {
                    if ($country->country_id != 6) {
                        $result[] = array(
                            'country_id' => $country->country_id,
                            'country_name' => ($lang_id == 1) ? $country->country_name_en : $country->country_name_ch,
                            'country_price' => $price
                        );
                    }
                }
            }
            $flag = 1;
        } else {
            $flag = 2;
        }

        $response = array('val' => $flag, 'countries' => $result);
        return $response;
    }

}
