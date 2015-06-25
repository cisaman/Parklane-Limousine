<?php

/**
 * This is the model class for table "{{booking}}".
 *
 * The followings are the available columns in table '{{booking}}':
 * @property integer $booking_id 
 * @property integer $booking_type
 * @property integer $booking_model
 * @property string $booking_initials
 * @property string $booking_passenger_name
 * @property string $booking_flight_no
 * @property string $booking_eta
 * @property integer $booking_countryID
 * @property integer $booking_districtID
 * @property string $booking_location
 * @property string $booking_contact_no
 * @property string $booking_email
 * @property integer $booking_no_of_passenger
 * @property integer $booking_no_of_luggage
 * @property integer $booking_userID
 * @property string $booking_created
 * @property string $booking_updated
 * @property integer $booking_status
 *
 * The followings are the available model relations:
 * @property District $bookingDistrict
 * @property Country $bookingCountry
 */
class Booking extends CActiveRecord {

    public $id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{booking}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('booking_model, booking_initials, booking_userID, booking_passenger_name, booking_flight_no, booking_eta, booking_countryID, booking_districtID, booking_location, booking_contact_no, booking_email, booking_no_of_passenger, booking_no_of_luggage', 'required'),
            array('booking_type, booking_model, booking_countryID, booking_districtID, booking_no_of_passenger, booking_no_of_luggage, booking_status', 'numerical', 'integerOnly' => true),
            array('booking_initials', 'length', 'max' => 50),
            array('booking_passenger_name, booking_email', 'length', 'max' => 255),
            array('booking_flight_no', 'length', 'max' => 100),
            array('booking_location', 'length', 'max' => 500),
            array('booking_contact_no', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('booking_id, booking_type, booking_model, booking_initials, booking_passenger_name, booking_flight_no, booking_eta, booking_countryID, booking_districtID, booking_location, booking_contact_no, booking_email, booking_no_of_passenger, booking_no_of_luggage, booking_created, booking_updated, booking_status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bookingDistrict' => array(self::BELONGS_TO, 'District', 'booking_districtID'),
            'bookingCountry' => array(self::BELONGS_TO, 'Country', 'booking_countryID'),
            'bookingUser' => array(self::BELONGS_TO, 'User', 'booking_userID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'booking_id' => Yii::t("lang", "id"),
            'booking_type' => Yii::t("lang", "type"),
            'booking_model' => Yii::t("lang", "car_model"),
            'booking_initials' => Yii::t("lang", "initials"),
            'booking_passenger_name' => Yii::t("lang", "passenger_name"),
            'booking_flight_no' => Yii::t("lang", "flight_no"),
            'booking_eta' => Yii::t("lang", "eta"),
            'booking_countryID' => Yii::t("lang", "country"),
            'booking_districtID' => Yii::t("lang", "district"),
            'booking_location' => Yii::t("lang", "location"),
            'booking_contact_no' => Yii::t("lang", "contactno"),
            'booking_email' => Yii::t("lang", "email_id"),
            'booking_no_of_passenger' => Yii::t("lang", "no_of_passengers"),
            'booking_no_of_luggage' => Yii::t("lang", "no_of_luggages"),
            'booking_userID' => Yii::t("lang", "username"),
            'booking_created' => Yii::t("lang", "created_date"),
            'booking_updated' => Yii::t("lang", "updated_date"),
            'booking_status' => Yii::t("lang", "status"),
            'booking_paidamount' => Yii::t("lang", "total_amount"),
            'booking_remark' => Yii::t("lang", "remark"),
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
    public function search($type_id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('booking_id', $this->booking_id);

        $this->booking_type = $type_id;
        $criteria->compare('booking_type', $this->booking_type);

        $criteria->compare('booking_model', $this->booking_model);
        $criteria->compare('booking_initials', $this->booking_initials, true);
        $criteria->compare('booking_passenger_name', $this->booking_passenger_name, true);
        $criteria->compare('booking_flight_no', $this->booking_flight_no, true);
        $criteria->compare('booking_eta', $this->booking_eta, true);
        $criteria->compare('booking_countryID', $this->booking_countryID);
        $criteria->compare('booking_districtID', $this->booking_districtID);
        $criteria->compare('booking_location', $this->booking_location, true);
        $criteria->compare('booking_contact_no', $this->booking_contact_no, true);
        $criteria->compare('booking_email', $this->booking_email, true);
        $criteria->compare('booking_no_of_passenger', $this->booking_no_of_passenger);
        $criteria->compare('booking_no_of_luggage', $this->booking_no_of_luggage);
        $criteria->compare('booking_userID', $this->booking_userID);
        $criteria->compare('booking_created', $this->booking_created, true);
        $criteria->compare('booking_updated', $this->booking_updated, true);
        $criteria->compare('booking_status', $this->booking_status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'booking_created DESC'
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
     * @return Booking the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getBookingService() {
        return array(
            '1' => 'Airport Transfer',
            '2' => 'Ad Hoc',
        );
    }

    public static function getBookingServiceByID($id) {
        if ($id == 1) {
            return 'Airport Transfer';
        } else if ($id == 2) {
            return 'Ad Hoc';
        }
    }

    public static function getBookingServiceType() {
        return array(
            '1' => 'Arrival',
            '2' => 'Departure',
            '3' => 'None',
        );
    }

    public static function getBookingServiceTypeByID($id) {
        if ($id == 1) {
            return 'Arrival';
        } else if ($id == 2) {
            return 'Departure';
        } else if ($id == 3) {
            return 'None';
        }
    }

    public static function getBookingCarModel() {
        return array(
            '1' => '4 Seaters Benz',
            '2' => '6 Seaters Toyota',
        );
    }

    public static function getBookingCarModelByID($id) {
        if ($id == 1) {
            return '4 Seaters Benz';
        } else if ($id == 2) {
            return '6 Seaters Toyota';
        }
    }

    public function ws_booking($data) {

        //print_r($data);die;

        if (isset($data['booking_flight_no']) && !empty($data['booking_flight_no'])) {
            $flight_no = $data['booking_flight_no'];
        } else {
            $flight_no = '-';
        }

        $booking = new Booking;
        $booking->booking_type = $data['booking_type'];
        $booking->booking_model = $data['booking_model'];
        $booking->booking_initials = ucwords($data['booking_initials']);
        $booking->booking_passenger_name = ucwords($data['booking_passenger_name']);
        $booking->booking_flight_no = $flight_no;
        $booking->booking_eta = date("Y-m-d H:i:s", strtotime($data['booking_eta']));
        $booking->booking_countryID = $data['booking_countryID'];
        $booking->booking_districtID = $data['booking_districtID'];
        $booking->booking_location = $data['booking_location'];
        $booking->booking_contact_no = $data['booking_contact_no'];
        $booking->booking_email = strtolower($data['booking_email']);
        $booking->booking_no_of_passenger = $data['booking_no_of_passenger'];
        $booking->booking_no_of_luggage = $data['booking_no_of_luggage'];
        $booking->booking_userID = $data['booking_userID'];
        $booking->booking_lang_id = ($data['lang_id'] == 2) ? 2 : 1;
        $booking->booking_originalamount = $data['booking_originalamount'];
        $booking->booking_paidamount = $data['booking_paidamount'];
        $booking->booking_discount = $data['booking_discount'];

        $user_bookings_2 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $data['booking_userID']), 'YEAR(booking_created)=' . date('Y'));
        $record_count_2 = count($user_bookings_2);

        $booking->booking_quota_used = 0;
        if ($record_count_2 <= 12) {
            $user_bookings_1 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $data['booking_userID']), 'YEAR(booking_created)=' . date('Y') . ' AND MONTH(booking_created)=' . date('m'));
            $record_count_1 = count($user_bookings_1);
            if ($record_count_1 < 2) {
                $booking->booking_quota_used = 1;
            }
        }

        //print_r($data);
        //print_r($booking->attributes);die;

        if ($booking->save()) {
            $flag = 1;

            $type = User::model()->findByPk($booking->booking_userID);
            $type_id = $type->user_type;

            $quota = Quota::model()->findByPk($type_id);
            $msg = $quota->quota_desc;

            $user_bookings_1 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $data['booking_userID']), 'YEAR(booking_created)=' . date('Y') . ' AND MONTH(booking_created)=' . date('m'));
            $record_count_1 = count($user_bookings_1);
            if ($record_count_1 <= 2) {
                $data['quota_remaining'] = 2 - $record_count_1;
            } else {
                $data['quota_remaining'] = 0;
            }

            $user_bookings_2 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $data['booking_userID']), 'YEAR(booking_created)=' . date('Y'));
            $record_count_2 = count($user_bookings_2);
            if ($record_count_2 <= 12) {
                $data['quotas'] = 12 - $record_count_2;
            } else {
                $data['quotas'] = 0;
            }

            $data['year_end_date'] = '31/12/' . date('Y');

            foreach ($data as $key => $value) {
                $msg = str_replace("$" . $key, $value, $msg);
            }
            $msg = $msg;
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag, 'msg' => $msg);
        return $result;
    }

    public function getPrice($data) {
        $user_id = $data['user_id'];
        $country_id = $data['country_id'];
        $original_amount = Country::model()->getCountryPrice($country_id);
        $paid_amount = 0;
        $discount = Option::model()->findByPk(3)->option_value;

        $user_bookings_2 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $user_id), 'YEAR(booking_created)=' . date('Y'));
        $record_count_2 = count($user_bookings_2);

        if ($record_count_2 <= 12) {
            $user_bookings_1 = Booking::model()->findAllByAttributes(array('booking_status' => 1, 'booking_quota_used' => 1, 'booking_userID' => $user_id), 'YEAR(booking_created)=' . date('Y') . ' AND MONTH(booking_created)=' . date('m'));
            $record_count_1 = count($user_bookings_1);
            if ($record_count_1 < 2) {
                if ($discount > 0) {
                    //Calculate Price
                    //$paid_amount = $original_amount - (($original_amount * $discount) / 100);
                    $paid_amount = $original_amount - $discount;
                } else {
                    $paid_amount = $original_amount;
                }
            } else {
                $paid_amount = $original_amount;
            }
        }
        return json_encode(array('original_amount' => $original_amount, 'paid_amount' => $paid_amount, 'discount' => $discount));
    }

    /* Function for all booking details */

    public function ws_AllBookings($user_id, $order_column, $order, $limit, $offset) {
        $bookings = Booking::model()->findAllByAttributes(
                array('booking_status' => 1, 'booking_userID' => $user_id), array(
            //'condition' => 'product_expiry_date >= :date',
            //'params' => array('date' => date('Y-m-d H:i:s')),
            'order' => $order_column . ' ' . $order, 'limit' => $limit, 'offset' => $offset)
        );

        $flag = 2;
        $result = array();

        if (!empty($bookings)) {

            foreach ($bookings as $booking) {

                $d = District::model()->findByPk($booking->booking_districtID);
                $district_name = ($booking->booking_lang_id == 1) ? $d->district_name_en : $d->district_name_ch;
                $price = Country::model()->getCountryPrice($booking->booking_countryID);

                $result[] = array(
                    'id' => $booking->booking_id,
                    'order_no' => Booking::returnOrderNoForList($booking->booking_eta, $booking->booking_id),
                    'eta' => date("d-m-Y H:i", strtotime($booking->booking_eta)),
                    'district_name' => $district_name,
                    'price' => $booking->booking_paidamount
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
        $booking = Booking::model()->findByPk($id);

        $flag = 2;

        if (!empty($booking)) {

            $d = District::model()->findByPk($booking->booking_districtID);
            $district_name = ($booking->booking_lang_id == 1) ? $d->district_name_en : $d->district_name_ch;

            $flag = 1;
            $result = array(
                'booking_id' => $booking->booking_id,
                'booking_order_no' => Booking::returnOrderNoForList($booking->booking_eta, $booking->booking_id),
                'booking_passenger_initial' => $booking->booking_initials,
                'booking_passenger_name' => $booking->booking_passenger_name,
                'booking_eta' => $booking->booking_eta,
                'booking_district' => $district_name,
                'booking_location' => $booking->booking_location,
                'booking_contact_no' => $booking->booking_contact_no,
                'booking_email' => $booking->booking_email,
                'booking_no_of_passenger' => $booking->booking_no_of_passenger,
                'booking_no_of_luggage' => $booking->booking_no_of_luggage,
                //'booking_amount' => Country::model()->getCountryPrice($booking->booking_countryID)
                'booking_amount' => $booking->booking_paidamount
            );
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag, 'booking' => $result);
        return $result;
    }

    public static function getOrderNoForList($date, $id) {
        $length = strlen($id);
        if ($length == 1) {
            $id = '00' . $id;
        } else if ($length == 2) {
            $id = '0' . $id;
        }
        echo Yii::app()->dateFormatter->format("yyyyMMdd", $date) . $id;
    }

    public static function returnOrderNoForList($date, $id) {
        $length = strlen($id);
        if ($length == 1) {
            $id = '00' . $id;
        } else if ($length == 2) {
            $id = '0' . $id;
        }
        return Yii::app()->dateFormatter->format("yyyyMMdd", $date) . $id;
    }

    public static function getETAForList($date) {
        echo Yii::app()->dateFormatter->format("yyyy-MM-dd hh:mm a", $date);
    }

    public static function getTokenForList($id) {
        echo '-';
    }

    public static function getCheckBoxForList($id, $record_id) {
        if ($id == 1) {
            echo '<input type="checkbox" class="checkAllArrivals" name="bookings[]" value="' . $record_id . '"/>';
        } else {
            echo '<input type="checkbox" class="checkAllDepartures" name="bookings[]" value="' . $record_id . '"/>';
        }
    }

}
