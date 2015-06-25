<?php

/**
 * This is the model class for table "{{countrydistrictgroup}}".
 *
 * The followings are the available columns in table '{{countrydistrictgroup}}':
 * @property integer $group_id
 * @property string $group_name
 * @property integer $group_countryID
 * @property string $group_cities
 *
 * The followings are the available model relations:
 * @property Country $groupCountry
 */
class Countrydistrictgroup extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{countrydistrictgroup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('group_name, group_countryID, group_cities', 'required'),
            array('group_cities', 'unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('group_id, group_name, group_countryID, group_cities', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'groupCountry' => array(self::BELONGS_TO, 'Country', 'group_countryID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'group_id' => 'ID',
            'group_name' => Yii::t('lang', 'group_name'),
            'group_countryID' => Yii::t('lang', 'country'),
            'group_cities' => Yii::t('lang', 'districts'),
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

        $criteria->compare('group_id', $this->group_id);
        $criteria->compare('group_name', $this->group_name, true);
        $criteria->compare('group_countryID', $this->group_countryID);
        $criteria->compare('group_cities', $this->group_cities, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'group_countryID ASC'
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
     * @return Countrydistrictgroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getDistricts($string) {
        $district_ids = explode(',', $string);

        $result = '';

        foreach ($district_ids as $district_id) {
            $district = District::model()->getDistrictName($district_id);
            $result .= $district . ' / ';
        }

        $result = rtrim($result, ' / ');

        echo $result;
    }

}
