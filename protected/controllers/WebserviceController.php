<?php

class WebserviceController extends Controller {
    /*
     * Error Function
     */

    public function actionError() {
        $error = array('error' => "true");
        $this->response(401, $error);
    }

    /*
     * User Email Check Function
     */

    public function actionEmailCheck() {
        //$post = file_get_contents("php://input");
        //$data = CJSON::decode($post, true);

        if (empty($_POST['user_email'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '23'));
        } else {
            $e = $_POST['user_email'];

            $result = User::model()->ws_emailcheck($e);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '24'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '25'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '26'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * User Registration Function
     */

    public function actionRegister() {
        //$post = file_get_contents("php://input");
        //$data = CJSON::decode($post, true);
        //user_initial, user_name, user_email, user_password, user_country_code, user_mobile
        //user_card_type, user_card_no, user_cardholder_name, user_expiry_month, user_expiry_year

        if (in_array('', $_POST) || (count($_POST) < 11)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '11'));
        } else {
            $result = User::model()->ws_register($_POST);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '12',
                        'response' => array(
                            'user' => $result['user']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '13'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '14'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * User Login Function
     */

    public function actionLogin() {
        //$post = file_get_contents("php://input");
        //$data = CJSON::decode($post, true);
        //if (empty($_POST['user_email']) || empty($_POST['user_password'])) {        

        if (in_array('', $_POST) || (count($_POST) < 2)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '1'));
        } else {
            $e = $_POST['user_email'];
            $p = $_POST['user_password'];

            $result = User::model()->ws_login($e, $p);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '2'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '3'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 3:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '4',
                        'response' => array(
                            'user' => $result['user']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 4:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '5'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '6'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * User Forgot Password Function
     */

    public function actionForgotpassword() {
        //$post = file_get_contents("php://input");
        //$data = CJSON::decode($post, true);

        if (empty($_POST['user_email'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '7'));
        } else {
            $e = $_POST['user_email'];

            $result = User::model()->ws_forgotpassword($e);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '8'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '9'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '10'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * User Reset Password Function
     */
    public function actionResetPassword() {

        if (in_array('', $_POST) || (count($_POST) < 3)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '46'));
        } else {
            $user_id = $_POST['user_id'];
            $old_pwd = $_POST['user_old'];
            $new_pwd = $_POST['user_new'];

            $result = User::model()->ws_resetpassword($user_id, $old_pwd, $new_pwd);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '47'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '48'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 3:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '49'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 4:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '50'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '51'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * List of all Vehicles Function
     */
    public function actionAllVehicles() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {

            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '15'));
        } else {

            $page = isset($_POST['page']) ? trim($_POST['page']) : 1;
            $limit = isset($_POST['limit']) ? trim($_POST['limit']) : 5;

            $vehicle = new Vehicle();

            $sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "created_date";
            $order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "ASC";
            $offset = ($page - 1) * $limit;

            $result = $vehicle->ws_AllVehicle("vehicle_" . $sort_by, $order_by, $limit, $offset);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '16',
                        'response' => array(
                            'vehicles' => $result['vehicles']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '17'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '18'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Get Single Vehicle Function
     */
    public function actionVehicle() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '19'));
        } else {
            $vehicle_id = $_POST['vehicle_id'];
            $result = Vehicle::model()->ws_SingleVehicle($vehicle_id);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '20',
                        'response' => array(
                            'vehicle' => $result['vehicle']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '21'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '22'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * List of all Country Function
     */
    public function actionCountry() {

        if (in_array('', $_POST) || (count($_POST) < 3)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '72'));
        } else {
            $flag = $_POST['flag'];
            $user_id = $_POST['user_id'];
            $lang_id = $_POST['lang_id'];

            $country = new Country();
            $result = $country->ws_Country($flag, $user_id, $lang_id);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '27',
                        'response' => array(
                            'country' => $result['countries']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '28'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '29'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Get District List by Country ID Function
     */
    public function actionDistrict() {

        if (in_array('', $_POST) || (count($_POST) < 2)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '30'));
        } else {
            $country_id = $_POST['country_id'];
            $lang_id = $_POST['lang_id'];

            $result = District::model()->ws_District($country_id, $lang_id);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '31',
                        'response' => array(
                            'district' => $result['districts']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '32'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '33'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Booking Function
     * Service 1-Airport Transfer, 2-Adhoc
     * Type 1-Arrival, 2-Departure, 3-None
     */
    public function actionBooking() {
        //booking_service, booking_type, booking_model
        //booking_initials, booking_passenger_name, booking_flight_no, booking_eta, 
        //booking_countryID, booking_districtID, booking_location, booking_contact_no
        //booking_email, booking_no_of_passenger, booking_no_of_luggage, booking_userID

        if ($_POST['booking_type'] == 1) {
            $num = 18;
        } else if ($_POST['booking_type'] == 2) {
            $num = 17;
        }

        if (in_array('', $_POST) || (count($_POST) < $num)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '34'));
        } else {
            $result = Booking::model()->ws_booking($_POST);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '35',
                        'response' => array(
                            'message' => $result['msg']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '36'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '37'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * List of all Booking Records Function
     */
    public function actionAllBookings() {

        if (!isset($_POST['user_id']) && empty($_POST['user_id']) && !isset($_POST['service_id']) && empty($_POST['service_id'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '38'));
        } else {

            $user_id = $_POST['user_id'];
            $service_id = $_POST['service_id'];

            $page = isset($_POST['page']) ? trim($_POST['page']) : 1;
            $limit = isset($_POST['limit']) ? trim($_POST['limit']) : 5;

            switch ($service_id) {
                case 1:
                    $booking = new Booking();

                    //$sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "created";
                    //$order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "DESC";
                    $sort_by = "created";
                    $order_by = "DESC";
                    $offset = ($page - 1) * $limit;

                    $result = $booking->ws_AllBookings($user_id, "booking_" . $sort_by, $order_by, $limit, $offset);
                    break;
                case 2:
                    $booking = new Hourlyonhire();

                    //$sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "created_date";
                    //$order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "DESC";
                    $sort_by = "created_date";
                    $order_by = "DESC";
                    $offset = ($page - 1) * $limit;

                    $result = $booking->ws_AllBookings($user_id, "hourlyonhire_" . $sort_by, $order_by, $limit, $offset);
                    break;
                case 3:
                    $booking = new Adhocptop();

                    //$sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "createddate";
                    //$order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "DESC";
                    $sort_by = "createddate";
                    $order_by = "DESC";
                    $offset = ($page - 1) * $limit;

                    $result = $booking->ws_AllBookings($user_id, "adhocptop_" . $sort_by, $order_by, $limit, $offset);
                    break;
                default:
                    $booking = new Booking();

                    //$sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "created";
                    //$order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "DESC";
                    $sort_by = "created";
                    $order_by = "DESC";
                    $offset = ($page - 1) * $limit;

                    $result = $booking->ws_AllBookings($user_id, "booking_" . $sort_by, $order_by, $limit, $offset);
            }

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '39',
                        'response' => array(
                            'bookings' => $result['bookings']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '40'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '41'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Get Single Booking Details Function
     */
    public function actionSingleBooking() {

        if (in_array('', $_POST) || (count($_POST) < 2)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '42'));
        } else {

            $service_id = $_POST['service_id'];
            $booking_id = $_POST['booking_id'];

            switch ($service_id) {
                case 1:
                    $result = Booking::model()->ws_SingleBooking($booking_id);
                    break;
                case 2:
                    $result = Hourlyonhire::model()->ws_SingleBooking($booking_id);
                    break;
                case 3:
                    $result = Adhocptop::model()->ws_SingleBooking($booking_id);
                    break;
                default:
                    $result = Booking::model()->ws_SingleBooking($booking_id);
            }

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '43',
                        'response' => array(
                            'booking' => $result['booking']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '44'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '45'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Get Privacy Policy Content Function
     */
    public function actionPrivacy() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '42'));
        } else {

            $lang_id = $_POST['lang_id'];

            $result = Pages::model()->findByPk(4);

            if ($lang_id == 1) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            } else if ($lang_id == 2) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                }
                $result = array('pages_name' => $result->pages_name_ch, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            } else {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            }

            if (count($result)) {

                $result = array(
                    'status' => TRUE,
                    'status_code' => '52',
                    'response' => array(
                        'privacy' => $result['pages_desc']
                    )
                );
                $this->response(200, $arrayName = $result);
            } else {
                $result = array(
                    'status' => FALSE,
                    'status_code' => '53'
                );
                $this->response(200, $arrayName = $result);
            }
        }
    }

    /*
     * Get Terms of Service Content Function
     */
    public function actionService() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '42'));
        } else {

            $lang_id = $_POST['lang_id'];

            $result = Pages::model()->findByPk(3);

            if ($lang_id == 1) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            } else if ($lang_id == 2) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                }
                $result = array('pages_name' => $result->pages_name_ch, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            } else {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#000">' . $string . '</font>');
            }

            if (count($result)) {

                $result = array(
                    'status' => TRUE,
                    'status_code' => '54',
                    'response' => array(
                        'service' => $result['pages_desc']
                    )
                );
                $this->response(200, $arrayName = $result);
            } else {
                $result = array(
                    'status' => FALSE,
                    'status_code' => '55'
                );
                $this->response(200, $arrayName = $result);
            }
        }
    }

    /*
     * Get About Us Content Function
     */
    public function actionAbout() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '42'));
        } else {

            $lang_id = $_POST['lang_id'];

            $result = Pages::model()->findByPk(1);

            if ($lang_id == 1) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            } else if ($lang_id == 2) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                }
                $result = array('pages_name' => $result->pages_name_ch, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            } else {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            }

            if (count($result)) {

                $result = array(
                    'status' => TRUE,
                    'status_code' => '56',
                    'response' => array(
                        'about' => $result['pages_desc']
                    )
                );
                $this->response(200, $arrayName = $result);
            } else {
                $result = array(
                    'status' => FALSE,
                    'status_code' => '57'
                );
                $this->response(200, $arrayName = $result);
            }
        }
    }

    /*
     * Get Contact Us Content Function
     */
    public function actionContact() {

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '42'));
        } else {

            $lang_id = $_POST['lang_id'];

            $result = Pages::model()->findByPk(2);

            if ($lang_id == 1) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            } else if ($lang_id == 2) {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                }
                $result = array('pages_name' => $result->pages_name_ch, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            } else {

                $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_en);
                if (empty($string)) {
                    $string = preg_replace('/(<br>)+$/', '', $result->pages_desc_ch);
                }
                $result = array('pages_name' => $result->pages_name_en, 'pages_desc' => '<font color="#fff">' . $string . '</font>');
            }

            if (count($result)) {

                $result = array(
                    'status' => TRUE,
                    'status_code' => '58',
                    'response' => array(
                        'contact' => $result['pages_desc']
                    )
                );
                $this->response(200, $arrayName = $result);
            } else {
                $result = array(
                    'status' => FALSE,
                    'status_code' => '59'
                );
                $this->response(200, $arrayName = $result);
            }
        }
    }

    /*
     * Credit Card Check Function
     */
    public function actionCreditCardCheck() {

        if (empty($_POST['user_cc'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '60'));
        } else {

            $cc = $_POST['user_cc'];

            if (strlen($cc) != 9) {

                $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '61'));
            } else {

                $result = CreditCard::model()->ws_creditcardcheck($cc);

                switch ($result['val']) {
                    case 1:
                        $result = array(
                            'status' => TRUE,
                            'status_code' => '62',
                            'card_type' => $result['type']
                        );
                        $this->response(200, $arrayName = $result);
                        break;
                    case 2:
                        $result = array(
                            'status' => TRUE,
                            'status_code' => '63'
                        );
                        $this->response(200, $arrayName = $result);
                        break;
                    default :
                        $result = array(
                            'status' => FALSE,
                            'status_code' => '64'
                        );
                        $this->response(200, $arrayName = $result);
                        break;
                }
            }
        }
    }

    /*
     * List of Settings for Calcuation of Price with discount in HourlyOnHire Service
     */
    public function actionGetHourlyOnHireSettings() {
        $option = new Option();
        $user_type = $_POST['user_type'];

        $result = $option->ws_getHourlyOnHireSettings($user_type);

        switch ($result['val']) {
            case 1:
                $result = array(
                    'status' => TRUE,
                    'status_code' => '65',
                    'response' => array(
                        'options' => $result['options']
                    )
                );
                $this->response(200, $arrayName = $result);
                break;
            case 2:
                $result = array(
                    'status' => FALSE,
                    'status_code' => '66'
                );
                $this->response(200, $arrayName = $result);
                break;
            default :
                $result = array(
                    'status' => FALSE,
                    'status_code' => '67'
                );
                $this->response(200, $arrayName = $result);
                break;
        }
    }

    /*
     * Hourly On Hire Function
     */
    public function actionHourlyOnHireService() {
        //hourlyonhire_model
        //hourlyonhire_initials, hourlyonhire_passengername, hourlyonhire_pickupdatetime, hourlyonhire_pickuppoint, 
        //hourlyonhire_noofhours, hourlyonhire_contactno, hourlyonhire_email
        //hourlyonhire_noofpassengers, hourlyonhire_noofluggages
        //hourlyonhire_originalamount, hourlyonhire_paidamount, hourlyonhire_discount, hourlyonhire_userID        

        $num = 15;

        if (in_array('', $_POST) || (count($_POST) < $num)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '68'));
        } else {
            $result = Hourlyonhire::model()->ws_hourlyonhire($_POST);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '69'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '70'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '71'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Get Price in Adhoc Point to Point Service
     */
    public function actionGetPriceForPointToPoint() {
        //from_country_id, from_district_id
        //to_country_id, to_district_id                

        if (in_array('', $_POST) || (count($_POST) < 5)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '73'));
        } else {

            $result = Pricelistptop::model()->ws_getPrice($_POST);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '74',
                        'price' => $result['price'],
                        'discount' => $result['discount']
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '75'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '76'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * Adhoc Point To Point Function
     */
    public function actionAdhocPointToPointService() {
        //adhocptop_model
        //adhocptop_initials, adhocptop_passengername, adhocptop_pickupdatetime, 
        //adhocptop_fromcountryID, adhocptop_fromdistrictID, adhocptop_fromaddress, 
        //adhocptop_tocountryID, adhocptop_todistrictID, adhocptop_toaddress, 
        //adhocptop_contactno
        //adhocptop_noofpassengers, adhocptop_noofluggages
        //adhocptop_price, adhocptop_discount, adhocptop_userID

        $num = 17;

        if (in_array('', $_POST) || (count($_POST) < $num)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '77'));
        } else {
            $result = Adhocptop::model()->ws_adhocptop($_POST);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '78'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '79'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '80'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    /*
     * List of Promotion Function
     */
    public function actionGetPromotionList() {

        if (!isset($_POST['user_type']) && empty($_POST['user_type'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '81'));
        } else {
            $user_type = $_POST['user_type'];

            $page = isset($_POST['page']) ? trim($_POST['page']) : 1;
            $limit = isset($_POST['limit']) ? trim($_POST['limit']) : 10;

            $promotion = new Promotion();
            $sort_by = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : "created";
            $order_by = isset($_POST['order_by']) ? trim($_POST['order_by']) : "ASC";
            $offset = ($page - 1) * $limit;

            $result = $promotion->ws_promotionlist($user_type, "promotion_" . $sort_by, $order_by, $limit, $offset);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '82',
                        'response' => array(
                            'promotions' => $result['promotions'],
                            'banner' => $result['path']
                        )
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '83'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '84'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }
	
	/*
     * Add Device Token Function
     */
    public function actionAddDeviceToken() {
        //user_id, device_token, device_type         

        if (in_array('', $_POST) || (count($_POST) < 3)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '85'));
        } else {
            $result = Devices::model()->ws_register($_POST);

            switch ($result) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '86',                       
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '87'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '88'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

	/*
     * Delete Device Token Function
     */
    public function actionDeleteDeviceToken() {
        //device_token

        if (in_array('', $_POST) || (count($_POST) < 1)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '89'));
        } else {
            $result = Devices::model()->ws_unregister($_POST);

            switch ($result) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '90',                       
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '91'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '92'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }
	
    public function actionSendNotification() {
        
		if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $driver_name = $_REQUEST['driver_name'];
        $license_number = $_REQUEST['license_number'];
		$contact = $_REQUEST['contact'];
        $type = $_REQUEST['type'];
		
        $token_1 = array();
        $token_2 = array();
		$from = '';
		$to = '';
		
        if ($type == "1" || $type == "2") {
            $model = Booking::model()->findByPk($id);
            $user_id = $model->booking_userID;
			$car_model = Booking::model()->getBookingCarModelByID($model->booking_model);
			$datetime = $model->booking_eta;
			
			if($type == "2") {
				$from = $model->booking_location . ', ' . District::model()->getDistrictName($model->booking_districtID);
				$to = 'Airport';				
			} else {
				$from = 'Airport';
				$to = $model->booking_location . ', ' . District::model()->getDistrictName($model->booking_districtID);
			}

            $devices = Devices::model()->findAllByAttributes(array('device_userID' => $user_id));
            foreach ($devices as $d) {
                if ($d->device_type == 1) {
                    $token_1[] = $d->device_token;
                } else {
                    $token_2[] = $d->device_token;
                }
            }
        } else if ($type == "3") {
            $model = Hourlyonhire::model()->findByPk($id);
            $user_id = $model->hourlyonhire_userID;
			$car_model = Booking::model()->getBookingCarModelByID($model->hourlyonhire_model);
			$datetime = $model->hourlyonhire_pickupdatetime;
			
			$from = $model->hourlyonhire_pickuppoint;
			$to = '';

            $devices = Devices::model()->findAllByAttributes(array('device_userID' => $user_id));
            foreach ($devices as $d) {
                if ($d->device_type == 1) {
                    $token_1[] = $d->device_token;
                } else {
                    $token_2[] = $d->device_token;
                }
            }
        } else if ($type == "4") {
            $model = Adhocptop::model()->findByPk($id);
            $user_id = $model->adhocptop_userID;
			$car_model = Booking::model()->getBookingCarModelByID($model->adhocptop_model);
			$datetime = $model->adhocptop_pickupdatetime;
			
			$from = $model->adhocptop_fromaddress . ', ' . District::model()->getDistrictName($model->adhocptop_fromdistrictID) . ', ' . Country::model()->getCountryName($model->adhocptop_fromcountryID);
			$to = $model->adhocptop_toaddress . ', ' . District::model()->getDistrictName($model->adhocptop_todistrictID) . ', ' . Country::model()->getCountryName($model->adhocptop_tocountryID);

            $devices = Devices::model()->findAllByAttributes(array('device_userID' => $user_id));
            foreach ($devices as $d) {
                if ($d->device_type == 1) {
                    $token_1[] = $d->device_token;
                } else {
                    $token_2[] = $d->device_token;
                }
            }
        }

        $message = array(
					'from' => $from,
					'to' => $to,
					'date_time' => $datetime,
					'driver_name' => $driver_name,
					'contact' => $contact,
					'license_number' => $license_number,
					'model' => $car_model
					);
		$message = json_encode($message);
		
		//print_r($message);

        //Android            
        //foreach ($token_1 as $t) {
        if(count($token_1)>0) {
            $this->actionSendNotificationAndroid($token_1, $message);
        }
        //}

        //iPhone
        
        if(count($token_2)>0) {
            foreach ($token_2 as $t) {
                $this->actionSendNotificationIphone($t, $message);
            }
        }
        
    }

    public function actionSendNotificationAndroid($token, $message) {

        $GOOGLE_API_KEY = 'AIzaSyD_elCI0g8kt2vmfIxdkn-9ajnECIedL8E';

        // Set POST variables        
        $url = 'https://android.googleapis.com/gcm/send';
        $msg = array(
            'message' => $message,
            'title' => 'Parklane Limousine',
            'subtitle' => '',
            'tickerText' => '',
            'vibrate' => 1,
            'sound' => 1
        );
        //print_r($registatoin_ids);die;
        $fields = array(
            'registration_ids' => $token,
            'data' => $msg
        );	        

        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;
        exit;
    }

    public function actionSendNotificationIphone($deviceToken, $message) {

        $path = $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/DevelopmentCertificates.pem';
      
        // Put your private key's passphrase here:
        $passphrase = '123';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        //echo 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));        

        if (!$result)
            echo 0; //echo 'Message not delivered' . PHP_EOL;
        else
            echo 1; //echo 'Message successfully delivered' . PHP_EOL;

        fclose($fp);
    }    

    public function actionSendTestIphone() {

        $deviceToken = '1d3c7ab08d47de88ca803a21f92af00983743db007a4cc3861820ff89b7451ab';
        $message = 'Hello Rahul!';

        $path = $_SERVER['DOCUMENT_ROOT'] . '/bootstrap/DevelopmentCertificates.pem';
      
        // Put your private key's passphrase here:
        $passphrase = '123';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        //echo 'Connected to APNS' . PHP_EOL;
        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));        

        if (!$result)
            echo 0; //echo 'Message not delivered' . PHP_EOL;
        else
            echo 1; //echo 'Message successfully delivered' . PHP_EOL;

        fclose($fp);
    }   

	
	public function actionGetPriceForAirportTransfer() {			
		
		if (in_array('', $_POST) || (count($_POST) < 2)) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '93'));
        } else {
            $result = json_decode(Booking::model()->getPrice($_POST));
           
			$res = array(
				'status' => TRUE,
				'status_code' => '94',
				'price' => $result->original_amount,
				'discount' => $result->discount,
				'paid_amount' => $result->paid_amount,
			);
			$this->response(200, $arrayName = $res);                    
        }
	}
	

    public function actionShowProfile() {
        if (empty($_POST['user_id'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '95'));
        } else {
            $user_id = $_POST['user_id'];

            $result = User::model()->ws_showProfile($user_id);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '96',
                        'user' => $result['user']
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '97'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '98'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }

    public function actionEditProfile() {
        if (empty($_POST['user_id']) && empty($_POST['credit_card_no'])) {
            $this->response(200, $arrayName = array('status' => FALSE, 'status_code' => '99'));
        } else {
            $user_id = $_POST['user_id'];
            $credit_card_no = $_POST['credit_card_no'];

            $result = User::model()->ws_editProfile($user_id, $credit_card_no);

            switch ($result['val']) {
                case 1:
                    $result = array(
                        'status' => TRUE,
                        'status_code' => '100',
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 2:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '101'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                case 3:
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '102'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
                default :
                    $result = array(
                        'status' => FALSE,
                        'status_code' => '103'
                    );
                    $this->response(200, $arrayName = $result);
                    break;
            }
        }
    }


    private function response($status = 200, $body = '', $content_type = 'application/json') {
        $statusHeader = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
        header($statusHeader);
        header('Content-type: ' . $content_type);
        echo CJSON:: encode($body);
        Yii::app()->end();
    }

    protected function getStatusCodeMessage($status) {
        $codes = array(
            100 => 'No E-email ID or Password found',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
