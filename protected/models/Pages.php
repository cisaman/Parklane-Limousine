<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $pages_id
 * @property string $pages_name_en
 * @property string $pages_desc_en
 * @property string $pages_name_ch
 * @property string $pages_desc_ch
 * @property string $pages_created
 * @property string $pages_updated
 * @property integer $pages_status
 */
class Pages extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{pages}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pages_name_en, pages_name_ch', 'required', 'message' => 'Please enter {attribute}.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('pages_id, pages_name_en, pages_name_ch, pages_desc_en, pages_desc_ch, pages_created, pages_updated, pages_status', 'safe', 'on' => 'search'),
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
            'pages_id' => 'ID',
            'pages_name_en' => 'Page Name',
            'pages_name_ch' => Yii::t('lang', 'page_name_ch'),
            'pages_desc_en' => 'Description',
            'pages_desc_ch' => Yii::t('lang', 'page_desc_ch'),
            'pages_created' => 'Created Date',
            'pages_updated' => 'Updated Date',
            'pages_status' => 'Status',
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

        $criteria->compare('pages_id', $this->pages_id);
        $criteria->compare('pages_name_en', $this->pages_name_en, true);
        $criteria->compare('pages_desc_en', $this->pages_desc_en, true);
        $criteria->compare('pages_name_ch', $this->pages_name_ch, true);
        $criteria->compare('pages_desc_ch', $this->pages_desc_ch, true);
        $criteria->compare('pages_created', $this->pages_created, true);
        $criteria->compare('pages_updated', $this->pages_updated, true);
        $criteria->compare('pages_status', $this->pages_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'pages_name_en ASC'
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
     * @return Pages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
