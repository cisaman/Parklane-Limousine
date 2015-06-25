<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public function init() {
        if (!in_array(Yii::app()->controller->id, array('dashboard', 'webservice'))) {
            if (!isset(Yii::app()->session['admin_data'])) {
                $this->redirect(array('dashboard/login'));
            }
        }
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {

            $this->layout = '//layouts/error';

            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    function replace($array, $str) {
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
        $mail->SetFrom('admin@parklanelimousine.com', 'Parklane Limousine');
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

}
