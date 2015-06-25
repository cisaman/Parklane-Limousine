<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function getId() {
        return $this->_id;
    }

    public function authenticate() {
        $utils = new Utils;
        $user = Admin::model()->findAllByAttributes(array('admin_username' => strtolower($this->username)));

        if (empty($user)) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        } elseif ($utils->passwordDecrypt($user[0]->admin_password) != ($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user[0]->admin_id;
            Yii::app()->user->name = 'admin';
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

}
