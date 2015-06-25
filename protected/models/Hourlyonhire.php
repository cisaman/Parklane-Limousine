<?php

/**
 * This is the model class for table "{{hourlyonhire}}".
 *
 * The followings are the available columns in table '{{hourlyonhire}}':
 * @property integer $hourlyonhire_id
 * @property integer $hourlyonhire_model
 * @property string $hourlyonhire_initials
 * @property string $hourlyonhire_passengername
 * @property string $hourlyonhire_pickupdatetime
 * @property string $hourlyonhire_pickuppoint
 * @property integer $hourlyonhire_noofhours
 * @property string $hourlyonhire_contactno
 * @property string $hourlyonhire_email
 * @property integer $hourlyonhire_noofpassengers
 * @property integer $hourlyonhire_noofluggages
 * @property double $hourlyonhire_originalamount
 * @property double $hourlyonhire_paidamount
 * @property double $hourlyonhire_discount
 * @property double $hourlyonhire_userID
 * @property string $hourlyonhire_created_date
 * @property string $hourlyonhire_updated_date
 * @property integer $hourlyonhire_status
 * @property integer $hourlyonhire_licenseplateno
 * @property integer $hourlyonhire_drivername
 * @property integer $hourlyonhire_totalhours
 * @property integer $hourlyonhire_parkingfee
 * @property integer $hourlyonhire_toll
 * @property integer $hourlyonhire_tolls
 * @property integer $hourlyonhire_surcharge
 * @property integer $hourlyonhire_remark
 */
class Hourlyonhire extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{hourlyonhire}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hourlyonhire_model, hourlyonhire_initials, hourlyonhire_passengername, hourlyonhire_pickupdatetime, hourlyonhire_pickuppoint, hourlyonhire_noofhours, hourlyonhire_contactno, hourlyonhire_email, hourlyonhire_noofpassengers, hourlyonhire_noofluggages, hourlyonhire_originalamount, hourlyonhire_paidamount, hourlyonhire_discount, hourlyonhire_userID', 'required'),
            //array('hourlyonhire_model, hourlyonhire_noofhours, hourlyonhire_noofpassengers, hourlyonhire_noofluggages, hourlyonhire_status', 'numerical', 'integerOnly' => true),
            //array('hourlyonhire_originalamount, hourlyonhire_paidamount', 'numerical'),
            //array('hourlyonhire_initials, hourlyonhire_contactno', 'length', 'max' => 50),
            //array('hourlyonhire_passengername, hourlyonhire_email', 'length', 'max' => 255),
            //array('hourlyonhire_pickupdatetime', 'length', 'max' => 100),
            //array('hourlyonhire_pickuppoint', 'length', 'max' => 500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('hourlyonhire_id, hourlyonhire_model, hourlyonhire_initials, hourlyonhire_passengername, hourlyonhire_pickupdatetime, hourlyonhire_pickuppoint, hourlyonhire_noofhours, hourlyonhire_contactno, hourlyonhire_email, hourlyonhire_noofpassengers, hourlyonhire_noofluggages, hourlyonhire_originalamount,hourlyonhire_paidamount, hourlyonhire_discount, hourlyonhire_userID, hourlyonhire_created_date, hourlyonhire_updated_date, hourlyonhire_status', 'safe', 'on' => 'search'),
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
            'hourlyonhire_id' => 'ID',
            'hourlyonhire_model' => 'Car Model',
            'hourlyonhire_initials' => 'Initials',
            'hourlyonhire_passengername' => 'Passenger Name',
            'hourlyonhire_pickupdatetime' => 'Pickup Date & Time',
            'hourlyonhire_pickuppoint' => 'Location',
            'hourlyonhire_noofhours' => 'No. of Hours',
            'hourlyonhire_contactno' => 'Contact Number',
            'hourlyonhire_email' => 'Email',
            'hourlyonhire_noofpassengers' => 'No of Passengers',
            'hourlyonhire_noofluggages' => 'No of Luggage',
            'hourlyonhire_originalamount' => 'Original Amount (HK$)',
            'hourlyonhire_paidamount' => 'Paid Amount (HK$)',
            'hourlyonhire_discount' => 'Discount (%)',
            'hourlyonhire_userID' => 'User Name',
            'hourlyonhire_created_date' => 'Created Date',
            'hourlyonhire_updated_date' => 'Updated Date',
            'hourlyonhire_status' => 'Status',
            'hourlyonhire_licenseplateno' => 'License Plate Number',
            'hourlyonhire_drivername' => 'Driver',
            'hourlyonhire_totalhours' => 'Total Hours',
            'hourlyonhire_parkingfee' => 'Parking Fee (HK$)',
            'hourlyonhire_toll' => 'Toll (HK$)',
            'hourlyonhire_tolls' => 'Tolls (HK$)',
            'hourlyonhire_surcharge' => 'Surcharge (HK$)',
            'hourlyonhire_remark' => 'Remark',
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

        $criteria->compare('hourlyonhire_id', $this->hourlyonhire_id);
        $criteria->compare('hourlyonhire_model', $this->hourlyonhire_model);
        $criteria->compare('hourlyonhire_initials', $this->hourlyonhire_initials, true);
        $criteria->compare('hourlyonhire_passengername', $this->hourlyonhire_passengername, true);
        $criteria->compare('hourlyonhire_pickupdatetime', $this->hourlyonhire_pickupdatetime, true);
        $criteria->compare('hourlyonhire_pickuppoint', $this->hourlyonhire_pickuppoint, true);
        $criteria->compare('hourlyonhire_noofhours', $this->hourlyonhire_noofhours);
        $criteria->compare('hourlyonhire_contactno', $this->hourlyonhire_contactno, true);
        $criteria->compare('hourlyonhire_email', $this->hourlyonhire_email, true);
        $criteria->compare('hourlyonhire_noofpassengers', $this->hourlyonhire_noofpassengers);
        $criteria->compare('hourlyonhire_noofluggages', $this->hourlyonhire_noofluggages);
        $criteria->compare('hourlyonhire_originalamount', $this->hourlyonhire_originalamount);
        $criteria->compare('hourlyonhire_paidamount', $this->hourlyonhire_paidamount);
        $criteria->compare('hourlyonhire_discount', $this->hourlyonhire_discount);
        $criteria->compare('hourlyonhire_userID', $this->hourlyonhire_userID);
        $criteria->compare('hourlyonhire_created_date', $this->hourlyonhire_created_date, true);
        $criteria->compare('hourlyonhire_updated_date', $this->hourlyonhire_updated_date, true);
        $criteria->compare('hourlyonhire_status', $this->hourlyonhire_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'hourlyonhire_created_date DESC'
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
     * @return Hourlyonhire the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //hourlyonhire_model
    //hourlyonhire_initials, hourlyonhire_passengername, hourlyonhire_pickupdatetime, hourlyonhire_pickuppoint, 
    //hourlyonhire_noofhours, hourlyonhire_contactno, hourlyonhire_email
    //hourlyonhire_noofpassengers, hourlyonhire_noofluggages
    //hourlyonhire_originalamount, hourlyonhire_paidamount, hourlyonhire_discount, hourlyonhire_userID    
    public function ws_hourlyonhire($data) {
        $booking = new HourlyOnHire;
        $booking->hourlyonhire_model = $data['hourlyonhire_model'];
        $booking->hourlyonhire_initials = ucwords($data['hourlyonhire_initials']);
        $booking->hourlyonhire_passengername = ucwords($data['hourlyonhire_passengername']);
        $booking->hourlyonhire_pickupdatetime = $data['hourlyonhire_pickupdatetime'];
        $booking->hourlyonhire_pickuppoint = $data['hourlyonhire_pickuppoint'];
        $booking->hourlyonhire_noofhours = $data['hourlyonhire_noofhours'];
        $booking->hourlyonhire_contactno = $data['hourlyonhire_contactno'];
        $booking->hourlyonhire_email = strtolower($data['hourlyonhire_email']);
        $booking->hourlyonhire_noofpassengers = $data['hourlyonhire_noofpassengers'];
        $booking->hourlyonhire_noofluggages = $data['hourlyonhire_noofluggages'];
        $booking->hourlyonhire_originalamount = $data['hourlyonhire_originalamount'];
        $booking->hourlyonhire_paidamount = $data['hourlyonhire_paidamount'];
        $booking->hourlyonhire_discount = $data['hourlyonhire_discount'];
        $booking->hourlyonhire_userID = $data['hourlyonhire_userID'];
        $booking->hourlyonhire_lang_id = ($data['lang_id'] == 2) ? 2 : 1;

        //print_r($data);
        //print_r($booking->attributes);die;

        if ($booking->save()) {
            $flag = 1;
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag);
        return $result;
    }

    public function ws_AllBookings($user_id, $order_column, $order, $limit, $offset) {
        $bookings = Hourlyonhire::model()->findAllByAttributes(
                array('hourlyonhire_status' => 1, 'hourlyonhire_userID' => $user_id), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => $order_column . ' ' . $order, 'limit' => $limit, 'offset' => $offset)
        );

        $flag = 2;
        $result = array();

        if (!empty($bookings)) {

            foreach ($bookings as $booking) {
                $result[] = array(
                    'id' => $booking->hourlyonhire_id,
                    'order_no' => Booking::returnOrderNoForList($booking->hourlyonhire_pickupdatetime, $booking->hourlyonhire_id),
                    'eta' => date("d-m-Y H:i", strtotime($booking->hourlyonhire_pickupdatetime)),
                    'district_name' => $booking->hourlyonhire_pickuppoint,
                    'price' => $booking->hourlyonhire_paidamount
                );
            }
            $flag = 1;
        } else {
            $flag = 2;
        }

        $response = array('val' => $flag, 'bookings' => $result);
        return $response;
    }

    public function ws_SingleBooking($id) {
        $booking = Hourlyonhire::model()->findByPk($id);

        $flag = 2;

        if (!empty($booking)) {

            $flag = 1;
            $result = array(
                'booking_id' => $booking->hourlyonhire_id,
                'booking_order_no' => Booking::returnOrderNoForList($booking->hourlyonhire_pickupdatetime, $booking->hourlyonhire_id),
                'booking_passenger_initial' => $booking->hourlyonhire_initials,
                'booking_passenger_name' => $booking->hourlyonhire_passengername,
                'booking_pickupdatetime' => $booking->hourlyonhire_pickupdatetime,
                'booking_pickuppoint' => $booking->hourlyonhire_pickuppoint,
                'booking_noofhours' => $booking->hourlyonhire_noofhours,
                'booking_contact_no' => $booking->hourlyonhire_contactno,
                'booking_email' => $booking->hourlyonhire_email,
                'booking_no_of_passenger' => $booking->hourlyonhire_noofpassengers,
                'booking_no_of_luggage' => $booking->hourlyonhire_noofluggages,
                'booking_paidamount' => $booking->hourlyonhire_paidamount,
                'booking_discount' => $booking->hourlyonhire_discount
            );
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag, 'booking' => $result);
        return $result;
    }

    public static function getCheckBoxForList($record_id) {
        echo '<input type="checkbox" class="checkAll" name="bookings[]" value="' . $record_id . '"/>';
    }

    public static function getTokenForList($id) {
        echo '-';
    }

}
