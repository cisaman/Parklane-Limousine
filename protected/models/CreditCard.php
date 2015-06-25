<?php

/**
 * This is the model class for table "{{credit_card}}".
 *
 * The followings are the available columns in table '{{credit_card}}':
 * @property integer $credit_card_id
 * @property string $credit_card_bank
 * @property string $credit_card_number
 * @property string $credit_card_type
 * @property string $credit_card_created
 * @property string $credit_card_updated
 * @property integer $credit_card_status
 */
class CreditCard extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{credit_card}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('credit_card_bank, credit_card_number, credit_card_type', 'required', 'message' => Yii::t('lang', 'please_enter') . ' {attribute}.'),
            array('credit_card_bank, credit_card_number, credit_card_type', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('credit_card_id, credit_card_bank, credit_card_number, credit_card_type, credit_card_created, credit_card_updated, credit_card_status', 'safe', 'on' => 'search'),
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
            'credit_card_id' => Yii::t('lang', 'id'),
            'credit_card_bank' => Yii::t('lang', 'bank_name'),
            'credit_card_number' => Yii::t('lang', 'card_number'),
            'credit_card_type' => Yii::t('lang', 'card_type'),
            'credit_card_created' => Yii::t('lang', 'created_date'),
            'credit_card_updated' => Yii::t('lang', 'updated_date'),
            'credit_card_status' => Yii::t('lang', 'status'),
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

        $criteria->compare('credit_card_id', $this->credit_card_id);
        $criteria->compare('credit_card_bank', $this->credit_card_bank, true);
        $criteria->compare('credit_card_number', $this->credit_card_number, true);
        $criteria->compare('credit_card_type', $this->credit_card_type, true);
        $criteria->compare('credit_card_created', $this->credit_card_created, true);
        $criteria->compare('credit_card_updated', $this->credit_card_updated, true);
        $criteria->compare('credit_card_status', $this->credit_card_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'credit_card_bank ASC'
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
     * @return CreditCard the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getCreditCardType($id = NULL) {
        $type = array(
            1 => 'I VISA Infinite Card', 2 => 'General Card'
        );

        if (!empty($id)) {
            foreach ($type as $key => $value) {
                if ($key == $id) {
                    $result = $value;
                }
            }

            return $result;
        } else {
            return $type;
        }
    }

    public function ws_creditcardcheck($cc) {

        $connection = Yii::app()->db;
        $command = $connection->createCommand('select credit_card_id, credit_card_type  from pa_credit_card WHERE SUBSTR(credit_card_number, 1, 9)=' . $cc);
        $cc = $command->queryRow();

		//print_r($cc);die;

        if (!empty($cc)) {            
			$flag = 1;
			$type = $cc['credit_card_type'];
        } else {
            $flag = 1;
            $type = 2;
        }

        $result = array('val' => $flag, 'type' => $type);
		
		//print_r($result);die;
		
        return $result;
    }

}
