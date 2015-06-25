<?php

class Utils {
    /*
     * Random Password Functions
     */

    public static function getRandomPassword($length = 8) {

        $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    /*
     * Base Url
     */

    public static function getBaseUrl() {
        return Yii::app()->baseUrl;
    }

    /*
     * Base Path
     */

    public static function getBasePath() {
        return Yii::app()->basePath;
    }

    /*
     * Get Style Url
     */

    public static function getStyleUrl() {
        return Yii::app()->baseUrl . '/bootstrap/dashboard/';
    }

    /*
     * Password Encryption and Decryption Functions
     */

    private function Encryption_Key() {
        $string = 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282';
        return $string;
    }

    private function mc_encrypt($encrypt, $key) {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

    private function mc_decrypt($decrypt, $key) {
        $decrypt = explode('|', $decrypt . '|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

    function passwordEncrypt($password) {
        return $this->mc_encrypt($password, $this->Encryption_Key());
    }

    function passwordDecrypt($password) {
        return $this->mc_decrypt($password, $this->Encryption_Key());
    }

    /*
     * Product Images 
     */

    public static function ProductImageTempBasePath() {
        $temp_path = Yii::app()->basePath . "/../bootstrap/uploads/product/temp/";
        return $temp_path;
    }

    public static function ProductImageBasePath() {
        $product_image_path = Yii::app()->basePath . "/../bootstrap/uploads/product/";
        return $product_image_path;
    }

    public static function ProductImageThumbnailBasePath() {
        $product_image_path = Yii::app()->basePath . "/../bootstrap/uploads/product/thumbs/";
        return $product_image_path;
    }

    public static function ProductImagePath() {
        $product_image_path = Yii::app()->baseUrl . "/bootstrap/uploads/product/";
        return $product_image_path;
    }

    public static function ProductImageThumbnailPath() {
        $product_image_path = Yii::app()->baseUrl . "/bootstrap/uploads/product/thumbs/";
        return $product_image_path;
    }

    /*
     * User Images 
     */

    public static function UserImagePath() {
        $user_image_path = Yii::app()->request->baseUrl . "/bootstrap/uploads/user/";
        return $user_image_path;
    }

    public static function UserThumbnailImagePath() {
        $user_image_path = Yii::app()->request->baseUrl . "/bootstrap/uploads/user/thumbs/";
        return $user_image_path;
    }

    public static function UserImageBasePath() {
        $user_image_path = Yii::app()->basePath . "/../bootstrap/uploads/user/";
        return $user_image_path;
    }

    public static function UserThumbnailImageBasePath() {
        $user_image_path = Yii::app()->basePath . "/../bootstrap/uploads/user/thumbs/";
        return $user_image_path;
    }

    public static function UserImagePath_M() {
        $user_m = Utils::getStyleUrl() . '/img/avatar_m.png';
        return $user_m;
    }

    public static function UserImagePath_F() {
        $user_f = Utils::getStyleUrl() . '/img/avatar_f.png';
        return $user_f;
    }

    /*
     * No Vehicle Image
     */

    public static function getNoImageAvailable() {
        return Yii::app()->baseUrl . '/bootstrap/dashboard/img/default.jpeg';
    }

    /*
     * Vehicle Image
     */

    public static function getVehicleImage() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/vehicle/';
    }

    public static function getVehicleImageBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/vehicle/";
        return $path;
    }

    /*
     * Vehicle Image Thumbnail
     */

    public static function getVehicleImageThumb() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/vehicle/thumbs/';
    }

    public static function getVehicleImageThumbBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/vehicle/thumbs/";
        return $path;
    }

    /*
     * User Image
     */

    public static function getUserImage() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/user/';
    }

    public static function getUserImageBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/user/";
        return $path;
    }

    /*
     * User Image Thumbnail
     */

    public static function getUserImageThumb() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/user/thumbs/';
    }

    public static function getUserImageThumbBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/user/thumbs/";
        return $path;
    }

    public function replace($array, $str) {
        foreach ($array as $key => $value) {
            $str = str_replace("$" . $key, $value, $str);
        }
        return $str;
    }

    public function Send($to, $to_name, $subject, $message) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = 'mail.centurylinkpro.net:465';
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth = true;
        $mail->Username = 'admin@parklanelimousine.com';
        $mail->Password = 'admin123$';
        $mail->SetFrom(Yii::app()->params['adminEmail'], Yii::app()->name);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);
        $mail->AddAddress($to, $to_name);

        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Promotion File Path
     */

    public static function getPromotionFilePath() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/promotion/';
    }

    public static function getPromotionFileBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/promotion/";
        return $path;
    }

    /*
     * Quota Banner Image Path
     */

    public static function getQuotaImagePath() {
        return Yii::app()->baseUrl . '/bootstrap/uploads/quota/';
    }

    public static function getQuotaImageBasePath() {
        $path = Yii::app()->basePath . "/../bootstrap/uploads/quota/";
        return $path;
    }

    public static function getColorClass($color_code) {
        $color_class = 'yellow-row';
        switch ($color_code) {
            case 1: $color_class = 'yellow-row';
                break;
            case 2: $color_class = 'green-row';
                break;
            case 3: $color_class = 'white-row';
                break;
            default :$color_class = 'yellow-row';
                break;
        }
        return $color_class;
    }

}
