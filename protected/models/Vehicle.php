<?php

/**
 * This is the model class for table "{{vehicle}}".
 *
 * The followings are the available columns in table '{{vehicle}}':
 * @property integer $vehicle_id
 * @property string $vehicle_name
 * @property string $vehicle_description
 * @property integer $vehicle_seater 
 * @property string $vehicle_image
 * @property integer $vehicle_status
 * @property string $vehicle_created_date
 * @property string $vehicle_modified_date
 */
class Vehicle extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{vehicle}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vehicle_name, vehicle_seater', 'required', 'message' => 'Please enter {attribute}.'),
            array('vehicle_image', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,gif,png'),
            array('vehicle_image', 'required', 'message' => 'Please upload {attribute}.', 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('vehicle_id, vehicle_name, vehicle_description, vehicle_seater, vehicle_image, vehicle_status, vehicle_created_date, vehicle_modified_date', 'safe', 'on' => 'search'),
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
            'vehicle_id' => 'ID',
            'vehicle_name' => 'Name',
            'vehicle_description' => 'Description',
            'vehicle_seater' => 'Seaters',
            'vehicle_image' => 'Photo',
            'vehicle_status' => 'Status',
            'vehicle_created_date' => 'Created Date',
            'vehicle_modified_date' => 'Modified Date',
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

        $criteria->compare('vehicle_id', $this->vehicle_id);
        $criteria->compare('vehicle_name', $this->vehicle_name, true);
        $criteria->compare('vehicle_description', $this->vehicle_description, true);
        $criteria->compare('vehicle_seater', $this->vehicle_seater);
        $criteria->compare('vehicle_image', $this->vehicle_image, true);
        $criteria->compare('vehicle_status', $this->vehicle_status);
        $criteria->compare('vehicle_created_date', $this->vehicle_created_date, true);
        $criteria->compare('vehicle_modified_date', $this->vehicle_modified_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'vehicle_created_date desc'
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
     * @return Vehicle the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }    

    public function ws_AllVehicle($order_column, $order, $limit, $offset) {
        $vehicles = Vehicle::model()->findAllByAttributes(
                array('vehicle_status' => 1), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => $order_column . ' ' . $order, 'limit' => $limit, 'offset' => $offset)
        );

        $flag = 2;
        $result = array();

        if (!empty($vehicles)) {

            foreach ($vehicles as $vehicle) {

                $path = Utils::getNoImageAvailable();
                if (!empty($vehicle->vehicle_image)) {
                    if (file_exists(Utils::getVehicleImage() . $vehicle->vehicle_image)) {
                        $path = Utils::getVehicleImage() . $vehicle->vehicle_image;
                    }
                }

                $result[] = array(
                    'vehicle_id' => $vehicle->vehicle_id,
                    'vehicle_name' => $vehicle->vehicle_name,
                    'vehicle_description' => strip_tags($vehicle->vehicle_description),
                    'vehicle_seats' => $vehicle->vehicle_seater,
                    'vehicle_image' => $path,
                );
            }
            $flag = 1;
        } else {
            $flag = 2;
        }

        $response = array('val' => $flag, 'vehicles' => $result);
        return $response;
    }

    public function ws_SingleVehicle($id) {
        $vehicle = Vehicle::model()->findByPk($id);

        $flag = 2;

        if (!empty($vehicle)) {

            $path = Utils::getNoImageAvailable();
            if (!empty($vehicle->vehicle_image)) {
                if (file_exists(Utils::getVehicleImage() . $vehicle->vehicle_image)) {
                    $path = Utils::getVehicleImage() . $vehicle->vehicle_image;
                }
            }

            $flag = 1;
            $result = array(
                'vehicle_id' => $vehicle->vehicle_id,
                'vehicle_name' => $vehicle->vehicle_name,
                'vehicle_description' => strip_tags($vehicle->vehicle_description),
                'vehicle_seats' => $vehicle->vehicle_seater,
                'vehicle_image' => $path,
            );
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag, 'vehicle' => $result);
        return $result;
    }

}
