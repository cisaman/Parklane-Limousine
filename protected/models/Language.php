<?php

/**
 * This is the model class for table "{{language}}".
 *
 * The followings are the available columns in table '{{language}}':
 * @property integer $language_id
 * @property string $language_name
 * @property string $language_code
 */
class Language extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{language}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('language_name, language_code', 'required'),
            array('language_name, language_code', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'language_id, language_name, language_code', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'language_id' => 'Language',
            'language_name' => 'Language Name',
            'language_code' => 'Language Code',
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

        $criteria->compare('language_id', $this->language_id);
        $criteria->compare('language_name', $this->language_name, true);
        $criteria->compare('language_code', $this->language_code, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Language the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getLanguageNameByCode($code) {
        $result = Language::model()->findByAttributes(array('language_code' => $code));
        return $result->language_name;
    }

}
