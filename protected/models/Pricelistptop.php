<?php

/**
 * This is the model class for table "{{pricelist_ptop}}".
 *
 * The followings are the available columns in table '{{pricelist_ptop}}':
 * @property integer $ptop_id 
 * @property integer $ptop_from_groupID 
 * @property integer $ptop_to_groupID
 * @property integer $ptop_price
 *
 * The followings are the available model relations:
 * @property Countrydistrictgroup $ptopToGroup
 * @property Country $ptopFromCountry
 * @property Countrydistrictgroup $ptopFromGroup
 * @property Country $ptopToCountry
 */
class Pricelistptop extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{pricelist_ptop}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ptop_from_groupID, ptop_to_groupID, ptop_price', 'required'),
            array('ptop_from_groupID, ptop_to_groupID, ptop_price', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ptop_id, ptop_from_groupID, ptop_to_groupID, ptop_price', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ptopToGroup' => array(self::BELONGS_TO, 'Countrydistrictgroup', 'ptop_to_groupID'),
            'ptopFromGroup' => array(self::BELONGS_TO, 'Countrydistrictgroup', 'ptop_from_groupID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ptop_id' => 'Ptop',
            'ptop_from_groupID' => 'Ptop From Group',
            'ptop_to_groupID' => 'Ptop To Group',
            'ptop_price' => 'Ptop Price',
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

        $criteria->compare('ptop_id', $this->ptop_id);
        $criteria->compare('ptop_from_groupID', $this->ptop_from_groupID);
        $criteria->compare('ptop_to_groupID', $this->ptop_to_groupID);
        $criteria->compare('ptop_price', $this->ptop_price);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pricelistptop the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getPriceByFromTo($from, $to) {
        $model = Pricelistptop::model()->findByAttributes(array('ptop_from_groupID' => $from, 'ptop_to_groupID' => $to));
        $price = 0;

        if (count($model) > 0) {
            $price = $model->ptop_price;		
        }
        return $price;
    }

    public static function ws_getPrice($data) {
		$user_type = $data['user_type'];
	
        $countryid_from = $data['from_country_id'];
        $districtid_from = $data['from_district_id'];
        $groupid_from = '';
        $getgroupfrom = Countrydistrictgroup::model()->findAllByAttributes(array('group_countryID' => $countryid_from));
        foreach ($getgroupfrom as $group) {
            $districts = explode(',', $group->group_cities);
            for ($i = 0; $i < count($districts); $i++) {
                if ($districts[$i] == $districtid_from) {
                    $groupid_from = $group->group_id;
                    break;
                }
            }
        }

        $countryid_to = $data['to_country_id'];
        $districtid_to = $data['to_district_id'];
        $groupid_to = '';
        $getgroupto = Countrydistrictgroup::model()->findAllByAttributes(array('group_countryID' => $countryid_to));
        foreach ($getgroupto as $group) {
            $districts = explode(',', $group->group_cities);
            for ($i = 0; $i < count($districts); $i++) {
                if ($districts[$i] == $districtid_to) {
                    $groupid_to = $group->group_id;
                    break;
                }
            }
        }

        $price = 0;
        $flag = 0;
        if ($groupid_from != '' && $groupid_to != '') {
            $flag = 1;
            $price = Pricelistptop::model()->getPriceByFromTo($groupid_from, $groupid_to, $user_type);
        }

		if($user_type == 1) {
			$options = Option::model()->findAll();
			foreach ($options as $option) {
				if ($option->option_id == 1) {
					$discount = $option->option_value;
				}
			}
		} else {
			$discount = 0;
		}

        $response = array('val' => $flag, 'price' => $price, 'discount' => $discount);
        return $response;
    }

}
