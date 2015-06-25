<?php

/**
 * This is the model class for table "{{option}}".
 *
 * The followings are the available columns in table '{{option}}':
 * @property integer $option_id
 * @property integer $option_name
 * @property string $option_value
 * @property string $option_description 
 */
class Option extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{option}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('option_name', 'required'),
            array('option_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('option_id, option_name, option_value, option_description', 'safe', 'on' => 'search'),
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
            'option_id' => 'ID',
            'option_name' => 'Name',
            'option_value' => 'Value',
            'option_description' => 'Description'
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

        $criteria->compare('option_id', $this->option_id);
        $criteria->compare('option_name', $this->option_name, TRUE);
        $criteria->compare('option_value', $this->option_value, TRUE);
        $criteria->compare('option_description', $this->option_description, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Option the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function ws_getHourlyOnHireSettings($user_type) {
        $options = Option::model()->findAll();

        $result = array();

        foreach ($options as $option) {
            if ($option->option_id == 1) {
				if($user_type ==1 ) {
					$res = array(
						'discount' => $option->option_value
					);
				} else {
					$res = array(
						'discount' => 0
					);
				}
                $result = array_merge($res, $result);
            } else if ($option->option_id == 2) {
                $res = array(
                    'priceperhour' => $option->option_value
                );
                $result = array_merge($res, $result);
            }
        }

        if (count($result) > 0) {
            $flag = 1;
        } else {
            $flag = 2;
        }
        
        $response = array('val' => $flag, 'options' => $result);
        return $response;
    }

}
