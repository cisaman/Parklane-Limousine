<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $user_id
 * @property string $user_intial_name
 * @property string $user_name
 * @property string $user_email
 * @property string $user_password
 * @property string $user_country_code
 * @property integer $user_mobile
 * @property string $user_payment_type
 * @property integer $user_credit_card
 * @property string $user_cardholder_name
 * @property integer $user_expiry_month
 * @property integer $user_expiry_year
 * @property integer $user_type
 * @property integer $user_status
 * @property string $user_created_date
 * @property string $user_modified_date
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_intial_name, user_name, user_email, user_password, user_country_code, user_mobile, user_payment_type, user_credit_card, user_cardholder_name, user_expiry_month, user_expiry_year', 'required'),
            array('user_email', 'unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, user_intial_name, user_name, user_email, user_password, user_country_code, user_mobile, user_payment_type, user_credit_card, user_cardholder_name, user_expiry_month, user_expiry_year, user_type, user_status, user_created_date, user_modified_date', 'safe', 'on' => 'search'),
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
            'user_id' => 'ID',
            'user_intial_name' => 'Initials',
            'user_name' => 'Name',
            'user_email' => 'E-mail ID',
            'user_password' => 'Password',
            'user_country_code' => 'Country Code',
            'user_mobile' => 'Mobile',
            'user_payment_type' => 'Payment Type',
            'user_credit_card' => 'Credit Card',
            'user_cardholder_name' => 'Cardholder Name',
            'user_expiry_month' => 'Expiry Month',
            'user_expiry_year' => 'Expiry Year',
            'user_type' => 'Type',
            'user_status' => 'Status',
            'user_created_date' => 'Created Date',
            'user_modified_date' => 'Modified Date',
            'user_remark' => 'Remark',
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

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_intial_name', $this->user_intial_name, true);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('user_email', $this->user_email, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('user_country_code', $this->user_country_code, true);
        $criteria->compare('user_mobile', $this->user_mobile);
        $criteria->compare('user_payment_type', $this->user_payment_type, true);
        $criteria->compare('user_credit_card', $this->user_credit_card);
        $criteria->compare('user_cardholder_name', $this->user_cardholder_name, true);
        $criteria->compare('user_expiry_month', $this->user_expiry_month);
        $criteria->compare('user_expiry_year', $this->user_expiry_year);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('user_status', $this->user_status);
        $criteria->compare('user_created_date', $this->user_created_date, true);
        $criteria->compare('user_modified_date', $this->user_modified_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'user_created_date DESC'
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
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getUserName($user_id) {
        $result = User::model()->findByPk($user_id);
        return $result->user_name;
    }

    public function ws_register($data) {
        $utils = new Utils;

        $user = new User;
        $user->user_intial_name = ucwords($data['user_initial']);
        $user->user_name = ucwords($data['user_name']);
        $user->user_email = strtolower($data['user_email']);
        $user->user_password = $utils->passwordEncrypt($data['user_password']);
        $user->user_country_code = $data['user_country_code'];
        $user->user_mobile = $data['user_mobile'];
        $user->user_payment_type = strtoupper($data['user_card_type']);
        $user->user_credit_card = $data['user_card_no'];
        $user->user_cardholder_name = ucwords($data['user_cardholder_name']);
        $user->user_expiry_month = $data['user_expiry_month'];
        $user->user_expiry_year = $data['user_expiry_year'];
        $user->user_type = $data['user_type'];

        if ($user->save()) {
            $flag = 1;

            $u = User::model()->findByAttributes(array('user_email' => $user->user_email));

            $result = array(
                'user_id' => $u->user_id,
                'user_initial' => $u->user_intial_name,
                'user_name' => $u->user_name,
                'user_email' => $u->user_email
            );
        } else {
            $flag = 2;
        }

        $result = array('val' => $flag, 'user' => $result);
        return $result;
    }

    public function ws_login($email, $password) {

        //1 Mail Id doesn't exists
        //2 Password didn't match
        //3 User is Valid
        //4 User Status is 0

        $utils = new Utils;
        $user = User::model()->findByAttributes(array('user_email' => strtolower($email)));

        if (empty($user)) {
            $flag = 1;
        } elseif ($utils->passwordDecrypt($user->user_password) != ($password)) {
            $flag = 2;
        } else {
            if ($user->user_status == 1) {
                $flag = 3;

                $result = array(
                    'user_id' => $user->user_id,
                    'user_initial' => $user->user_intial_name,
                    'user_name' => $user->user_name,
                    'user_email' => $user->user_email,
					'user_type' => $user->user_type
                );
            } else {
                $flag = 4;
            }
        }

        $result = array('val' => $flag, 'user' => $result);
        return $result;
    }

    public function ws_forgotpassword($email) {

        $utils = new Utils;
        $user = User::model()->findByAttributes(array('user_email' => strtolower($email)));

        if (empty($user)) {
            $flag = 1;
        } else {
            $flag = 2;

            $password = $utils->passwordDecrypt($user->user_password);
            $email = $user->user_email;
            $user_name = ucwords($user->user_intial_name . ' ' . $user->user_name);

            $to = $email;
            $userdata['href'] = Yii::app()->params['site_url'];
            $userdata['name'] = $user_name;
            $userdata['email'] = $email;
            $userdata['password'] = $password;
            $userdata['sitename'] = Yii::app()->params['site_url'];

            $subject = '=?UTF-8?B?' . base64_encode("Forgot Password") . '?=';
            $message = file_get_contents('./bootstrap/mailtemplate/ForgotPassword.php');
            $msg = $utils->replace($userdata, $message);
            $utils->Send($to, $user_name, $subject, $msg);
        }

        $result = array('val' => $flag);
        return $result;
    }

    public function ws_emailcheck($email) {
        $user = User::model()->findByAttributes(array('user_email' => strtolower($email)));

        if (empty($user)) {
            $flag = 1; //Email Id can be used for Registration
        } else {
            $flag = 2; //Email Id already exists in DB
        }

        $result = array('val' => $flag);
        return $result;
    }

    public function ws_resetpassword($user_id, $old_pwd, $new_pwd) {

        $utils = new Utils;
        $user = User::model()->findByAttributes(array('user_id' => $user_id));

        if (empty($user)) {
            $flag = 1;
        } elseif ($utils->passwordDecrypt($user->user_password) != ($old_pwd)) {
            $flag = 2;
        } else {

            $user->user_password = $utils->passwordEncrypt($new_pwd);

            if ($user->save()) {
                $flag = 3;
            } else {
                $flag = 4;
            }
        }

        $result = array('val' => $flag);
        return $result;
    }

    public function forgotpassword($email) {

        $utils = new Utils;
        $user = Admin::model()->findByAttributes(array('admin_email' => strtolower($email)));

        if (empty($user)) {
            $flag = 1;
        } else {
            $flag = 2;

            $password = $utils->passwordDecrypt($user->admin_password);
            $username = $user->admin_username;
            $user_name = ucwords($user->admin_name);

            $to = $email;
            $userdata['href'] = Yii::app()->params['site_url'];
            $userdata['name'] = $user_name;
            $userdata['username'] = $username;
            $userdata['password'] = $password;
            $userdata['sitename'] = Yii::app()->params['site_url'];

            $subject = '=?UTF-8?B?' . base64_encode("Forgot Password") . '?=';
            $message = file_get_contents('./bootstrap/mailtemplate/ForgotPassword2.php');
            $msg = $utils->replace($userdata, $message);
            $utils->Send($to, $user_name, $subject, $msg);
        }

        $result = array('val' => $flag);
        return $result;
    }

     public function ws_showProfile($user_id) {
        $user = User::model()->findByPk($user_id);

        if(empty($user)) {
            $flag = 2;
        } else {
            $flag = 1;
            $user = array(
                    'user_id' => $user->user_id,
                    'user_initial' => $user->user_intial_name,
                    'user_name' => $user->user_name,
                    'user_email' => $user->user_email,
                    'user_country_code' => $user->user_country_code,
                    'user_mobile' => $user->user_mobile,
                    'user_payment_type' => $user->user_payment_type,
                    'user_credit_card' => $user->user_credit_card,
                    'user_cardholder_name' => $user->user_cardholder_name,
                    'user_expiry_month' => $user->user_expiry_month,
                    'user_expiry_year' => $user->user_expiry_year
                );
        }

        $result = array('val' => $flag, 'user' => $user);
        return $result;
     }

     public function ws_editProfile($user_id, $credit_card_no) {
        $user = User::model()->findByPk($user_id);

        if(empty($user)) {
            $flag = 2;
        } else {            
            $user->user_credit_card = $credit_card_no;
            
            if($user->update()) {
                $flag = 1;
            } else {
                $flag = 3;
            }
        }

        $result = array('val' => $flag);
        return $result;
     }

}
