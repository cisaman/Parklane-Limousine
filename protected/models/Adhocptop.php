<?php

/**
 * This is the model class for table "{{adhocptop}}".
 *
 * The followings are the available columns in table '{{adhocptop}}':
 * @property integer $adhocptop_id
 * @property integer $adhocptop_model
 * @property string $adhocptop_initials
 * @property string $adhocptop_passengername
 * @property string $adhocptop_pickupdatetime
 * @property integer $adhocptop_fromcountryID
 * @property integer $adhocptop_fromdistrictID
 * @property string $adhocptop_fromaddress
 * @property integer $adhocptop_tocountryID
 * @property integer $adhocptop_todistrictID
 * @property string $adhocptop_toaddress
 * @property string $adhocptop_contactno
 * @property integer $adhocptop_noofpassengers
 * @property integer $adhocptop_noofluggages
 * @property integer $adhocptop_originalprice
 * @property integer $adhocptop_paidamount
 * @property integer $adhocptop_discount
 * @property integer $adhocptop_userID
 * @property string $adhocptop_createddate
 * @property string $adhocptop_updateddate
 * @property integer $adhocptop_status
 * @property integer $adhocptop_licenseno
 * @property integer $adhocptop_drivername
 * @property integer $adhocptop_surcharge
 * @property integer $adhocptop_remark
 *
 * The followings are the available model relations:
 * @property User $adhocptopUser
 * @property Country $adhocptopFromcountry
 * @property District $adhocptopFromdistrict
 * @property Country $adhocptopTocountry
 * @property District $adhocptopTodistrict
 */
class Adhocptop extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{adhocptop}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('adhocptop_model, adhocptop_initials, adhocptop_passengername, adhocptop_pickupdatetime, adhocptop_fromcountryID, adhocptop_fromdistrictID, adhocptop_fromaddress, adhocptop_tocountryID, adhocptop_todistrictID, adhocptop_toaddress, adhocptop_contactno, adhocptop_noofpassengers, adhocptop_noofluggages, adhocptop_originalprice, adhocptop_paidamount, adhocptop_userID', 'required'),
            array('adhocptop_model, adhocptop_fromcountryID, adhocptop_fromdistrictID, adhocptop_tocountryID, adhocptop_todistrictID, adhocptop_noofpassengers, adhocptop_noofluggages, adhocptop_paidamount, adhocptop_userID, adhocptop_status', 'numerical', 'integerOnly' => true),
            array('adhocptop_initials', 'length', 'max' => 50),
            array('adhocptop_passengername, adhocptop_pickupdatetime, adhocptop_fromaddress, adhocptop_toaddress', 'length', 'max' => 255),
            array('adhocptop_contactno', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('adhocptop_id, adhocptop_model, adhocptop_initials, adhocptop_passengername, adhocptop_pickupdatetime, adhocptop_fromcountryID, adhocptop_fromdistrictID, adhocptop_fromaddress, adhocptop_tocountryID, adhocptop_todistrictID, adhocptop_toaddress, adhocptop_contactno, adhocptop_noofpassengers, adhocptop_noofluggages, adhocptop_originalprice, adhocptop_paidamount, adhocptop_userID, adhocptop_createddate, adhocptop_updateddate, adhocptop_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'adhocptopUser' => array(self::BELONGS_TO, 'User', 'adhocptop_userID'),
            'adhocptopFromcountry' => array(self::BELONGS_TO, 'Country', 'adhocptop_fromcountryID'),
            'adhocptopFromdistrict' => array(self::BELONGS_TO, 'District', 'adhocptop_fromdistrictID'),
            'adhocptopTocountry' => array(self::BELONGS_TO, 'Country', 'adhocptop_tocountryID'),
            'adhocptopTodistrict' => array(self::BELONGS_TO, 'District', 'adhocptop_todistrictID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'adhocptop_id' => 'ID',
            'adhocptop_model' => 'Car Model',
            'adhocptop_initials' => 'Initials',
            'adhocptop_passengername' => 'Passenger Name',
            'adhocptop_pickupdatetime' => 'Pick Up Date & Time',
            'adhocptop_fromcountryID' => 'From Area',
            'adhocptop_fromdistrictID' => 'From District',
            'adhocptop_fromaddress' => 'From Address',
            'adhocptop_tocountryID' => 'To Area',
            'adhocptop_todistrictID' => 'To District',
            'adhocptop_toaddress' => 'To Address',
            'adhocptop_contactno' => 'Contact No',
            'adhocptop_noofpassengers' => 'No of Passengers',
            'adhocptop_noofluggages' => 'No of Luggages',
            'adhocptop_originalprice' => 'Original Amount (HK$)',
            'adhocptop_paidamount' => 'Paid Amount (HK$)',
            'adhocptop_discount' => 'Discount (%)',
            'adhocptop_userID' => 'Username',
            'adhocptop_createddate' => 'Created Date',
            'adhocptop_updateddate' => 'Updated Date',
            'adhocptop_status' => 'Status',
            'adhocptop_licenseplateno' => 'License Plate Number',
            'adhocptop_drivername' => 'Driver',
            'adhocptop_surcharge' => 'Surcharge (HK$)',
            'adhocptop_remark' => 'Remark',
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

        $criteria->compare('adhocptop_id', $this->adhocptop_id);
        $criteria->compare('adhocptop_model', $this->adhocptop_model);
        $criteria->compare('adhocptop_initials', $this->adhocptop_initials, true);
        $criteria->compare('adhocptop_passengername', $this->adhocptop_passengername, true);
        $criteria->compare('adhocptop_pickupdatetime', $this->adhocptop_pickupdatetime, true);
        $criteria->compare('adhocptop_fromcountryID', $this->adhocptop_fromcountryID);
        $criteria->compare('adhocptop_fromdistrictID', $this->adhocptop_fromdistrictID);
        $criteria->compare('adhocptop_fromaddress', $this->adhocptop_fromaddress, true);
        $criteria->compare('adhocptop_tocountryID', $this->adhocptop_tocountryID);
        $criteria->compare('adhocptop_todistrictID', $this->adhocptop_todistrictID);
        $criteria->compare('adhocptop_toaddress', $this->adhocptop_toaddress, true);
        $criteria->compare('adhocptop_contactno', $this->adhocptop_contactno, true);
        $criteria->compare('adhocptop_noofpassengers', $this->adhocptop_noofpassengers);
        $criteria->compare('adhocptop_noofluggages', $this->adhocptop_noofluggages);
        $criteria->compare('adhocptop_originalprice', $this->adhocptop_originalprice);
        $criteria->compare('adhocptop_paidamount', $this->adhocptop_paidamount);
        $criteria->compare('adhocptop_userID', $this->adhocptop_userID);
        $criteria->compare('adhocptop_createddate', $this->adhocptop_createddate, true);
        $criteria->compare('adhocptop_updateddate', $this->adhocptop_updateddate, true);
        $criteria->compare('adhocptop_status', $this->adhocptop_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'adhocptop_createddate DESC'
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
     * @return Adhocptop the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //adhocptop_model
    //adhocptop_initials, adhocptop_passengername, adhocptop_pickupdatetime, 
    //adhocptop_fromcountryID, adhocptop_fromdistrictID, adhocptop_fromaddress, 
    //adhocptop_tocountryID, adhocptop_todistrictID, adhocptop_toaddress, 
    //adhocptop_contactno
    //adhocptop_noofpassengers, adhocptop_noofluggages
    //adhocptop_paidamount, adhocptop_userID  
    public function ws_adhocptop($data) {
        $booking = new Adhocptop;
        $booking->adhocptop_model = $data['adhocptop_model'];
        $booking->adhocptop_initials = ucwords($data['adhocptop_initials']);
        $booking->adhocptop_passengername = ucwords($data['adhocptop_passengername']);
        $booking->adhocptop_pickupdatetime = ucwords($data['adhocptop_pickupdatetime']);

        $booking->adhocptop_fromcountryID = $data['adhocptop_fromcountryID'];
        $booking->adhocptop_fromdistrictID = $data['adhocptop_fromdistrictID'];
        $booking->adhocptop_fromaddress = $data['adhocptop_fromaddress'];

        $booking->adhocptop_tocountryID = $data['adhocptop_tocountryID'];
        $booking->adhocptop_todistrictID = $data['adhocptop_todistrictID'];
        $booking->adhocptop_toaddress = $data['adhocptop_toaddress'];

        $booking->adhocptop_contactno = $data['adhocptop_contactno'];
        $booking->adhocptop_noofpassengers = $data['adhocptop_noofpassengers'];
        $booking->adhocptop_noofluggages = $data['adhocptop_noofluggages'];
        $booking->adhocptop_discount = $data['adhocptop_discount'];
        $booking->adhocptop_userID = $data['adhocptop_userID'];
        $booking->adhocptop_originalprice = $data['adhocptop_originalprice'];
        $booking->adhocptop_paidamount = $data['adhocptop_paidamount'];
        $booking->adhocptop_lang_id = ($data['lang_id'] == 2) ? 2 : 1;

//        print_r($data);
//        print_r($booking->attributes);die;

        if ($booking->save()) {
            $flag = 1;
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag);
        return $result;
    }

    public function ws_AllBookings($user_id, $order_column, $order, $limit, $offset) {
        $bookings = Adhocptop::model()->findAllByAttributes(
                array('adhocptop_status' => 1, 'adhocptop_userID' => $user_id), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => $order_column . ' ' . $order, 'limit' => $limit, 'offset' => $offset)
        );

        $flag = 2;
        $result = array();

        if (!empty($bookings)) {

            foreach ($bookings as $booking) {

                $d = District::model()->findByPk($booking->adhocptop_fromdistrictID);
                $district_name = ($booking->adhocptop_lang_id == 1) ? $d->district_name_en : $d->district_name_ch;

                $result[] = array(
                    'id' => $booking->adhocptop_id,
                    'order_no' => Booking::returnOrderNoForList($booking->adhocptop_pickupdatetime, $booking->adhocptop_id),
                    'eta' => date("d-m-Y H:i", strtotime($booking->adhocptop_pickupdatetime)),
                    'district_name' => $district_name,
                    'price' => $booking->adhocptop_paidamount
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
        $booking = Adhocptop::model()->findByPk($id);

        $flag = 2;

        if (!empty($booking)) {

            $d = District::model()->findByPk($booking->adhocptop_fromdistrictID);
            $frm_district_name = ($booking->adhocptop_lang_id == 1) ? $d->district_name_en : $d->district_name_ch;

            $e = District::model()->findByPk($booking->adhocptop_todistrictID);
            $to_district_name = ($booking->adhocptop_lang_id == 1) ? $e->district_name_en : $e->district_name_ch;

            $f = Country::model()->findByPk($booking->adhocptop_fromcountryID);
            $frm_country_name = ($booking->adhocptop_lang_id == 1) ? $f->country_name_en : $f->country_name_ch;

            $g = Country::model()->findByPk($booking->adhocptop_tocountryID);
            $to_country_name = ($booking->adhocptop_lang_id == 1) ? $g->country_name_en : $g->country_name_ch;


            $flag = 1;
            $result = array(
                'booking_id' => $booking->adhocptop_id,
                'booking_order_no' => Booking::returnOrderNoForList($booking->adhocptop_pickupdatetime, $booking->adhocptop_id),
                'booking_passenger_initial' => $booking->adhocptop_initials,
                'booking_passenger_name' => $booking->adhocptop_passengername,
                'booking_pickupdatetime' => $booking->adhocptop_pickupdatetime,
                'booking_from_country' => $frm_country_name,
                'booking_from_district' => $frm_district_name,
                'booking_from_address' => $booking->adhocptop_fromaddress,
                'booking_to_country' => $to_country_name,
                'booking_to_district' => $to_district_name,
                'booking_to_address' => $booking->adhocptop_toaddress,
                'booking_contact_no' => $booking->adhocptop_contactno,
                'booking_no_of_passenger' => $booking->adhocptop_noofpassengers,
                'booking_no_of_luggage' => $booking->adhocptop_noofluggages,
                'booking_price' => $booking->adhocptop_paidamount
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
