<?php

class DashboardController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        if (isset(Yii::app()->session['admin_data']) && !empty(Yii::app()->session['admin_data'])) {
            $this->render('index');
        } else {
            $this->actionLogin();
        }
    }

    public function actionProfile() {
        if (isset(Yii::app()->session['admin_data'])) {

            $id = Yii::app()->session['admin_data']['admin_id'];
            $model = Admin::model()->findByPk($id);

            $this->performAjaxValidation($model);

            if (isset($_POST['Admin'])) {
                $model->attributes = $_POST['Admin'];

                if (isset($_POST['btnSaveProfile'])) {

                    $model->admin_name = $_POST['Admin']['admin_name'];

                    if ($model->save()) {
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Personal Information updated successfully.');
                    } else {
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
                    }
                }

                if (isset($_POST['btnSaveProfilePicture'])) {

                    $admin_image = CUploadedFile::getInstance($model, 'admin_image');
                    $random_name = rand(1111, 9999) . date('Ymdhi');

                    if (!empty($admin_image)) {

                        $extension = strtolower($admin_image->getExtensionName());
                        $filename = "{$random_name}.{$extension}";
                        $model->admin_image = $filename;
                        $admin_image->saveAs(Utils::UserImageBasePath() . $filename);
                    }

                    if ($model->save()) {
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Profile photo updated successfully.');
                    } else {
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
                    }
                }

                if (isset($_POST['btnSavePassword'])) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Password changed successfully.');
                    } else {
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
                    }
                }
            }

            $this->render('profile', array('model' => $model));
        } else {
            $this->redirect('admin');
        }
    }

    public function actionChangePassword() {

        if (isset(Yii::app()->session['admin_data'])) {
            $model = new User;
            $this->render('changepassword', array('model' => $model));
        } else {
            $this->redirect('admin');
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {

        $this->layout = '//layouts/login';

        if (isset(Yii::app()->session['admin_data'])) {
            Yii::app()->user->setFlash('msg', 'Already logged in');
            $this->redirect('index');
        } else {
            $this->layout = 'login';

            $model = new LoginForm;

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (isset($_POST['LoginForm'])) {
                $model->attributes = $_POST['LoginForm'];

                if ($model->validate() && $model->login()) {
                    $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/index'));
                } else {
                    Yii::app()->user->setFlash('msg', 'Invalid Username or Password.');
                }

                if ($model->validate()) {
                    if ($model->login()) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/index'));
                    } else {
                        Yii::app()->user->setFlash('msg', 'Invalid Username or Password.');
                    }
                } else {
                    Yii::app()->user->setFlash('msg', 'The verification code is incorrect.');
                }

                $this->refresh();
            }

            $this->render('login', array('model' => $model));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        unset(Yii::app()->session['admin_data']);
        $this->redirect('index');
    }

    /**
     * Displays the forgot password page
     */
    public function actionForgotpassword() {

        $this->layout = '//layouts/login';

        if (isset($_POST['email'])) {

            $result = User::model()->forgotpassword($_POST['email']);

            switch ($result['val']) {
                case 1:
                    Yii::app()->user->setFlash('type', 'danger');
                    Yii::app()->user->setFlash('message', 'The E-mail ID is not found in our database. Please check your E-mail ID.');
                    break;
                case 2:
                    Yii::app()->user->setFlash('type', 'success');
                    Yii::app()->user->setFlash('message', 'A Mail has been sent. Please check your Inbox for Mail. Thanks!');
                    break;
                default :
                    Yii::app()->user->setFlash('type', 'danger');
                    Yii::app()->user->setFlash('message', 'Unknown error. Please contact Site Administrator.');
                    break;
            }
        }

        $this->render('forgotpassword');
    }

    /**
     * Performs the AJAX validation.
     * @param Appinfo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'appinfo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     *  Language Translation for English and Swedish Action
     */

    public function actionLanguage() {
        $code = $_REQUEST['code'];
        Yii::app()->user->setState('lang', $code);
    }

    public function actionPrivacy() {

        $this->layout = '//layouts/login';

        $model = Pages::model()->findByPk(4);

        $this->render('pages', array(
            'model' => $model
        ));
    }

    public function actionService() {

        $this->layout = '//layouts/login';

        $model = Pages::model()->findByPk(3);

        $this->render('pages', array(
            'model' => $model
        ));
    }

    public function actionAdd_Settings() {

        if (isset(Yii::app()->session['admin_data'])) {

            $model = new Option;

            if (isset($_POST['Option'])) {
                $model->attributes = $_POST['Option'];

                if ($model->save()) {
                    Yii::app()->user->setFlash('type', 'success');
                    Yii::app()->user->setFlash('message', Yii::t('lang', 'settings') . ' ' . Yii::t('lang', 'msg_add'));
                } else {
                    Yii::app()->user->setFlash('type', 'danger');
                    Yii::app()->user->setFlash('message', Yii::t('lang', 'msg_error'));
                }
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }

            $this->render('optionCreate', array('model' => $model));
        } else {
            $this->redirect('admin');
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionSettings() {

        $model = Option::model()->findAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $flag = 0;
            foreach ($model as $m) {
                $m = Option::model()->findByPk($m->option_id);
                $m->option_value = (!empty($_POST['option_' . $m->option_id]) && $_POST['option_' . $m->option_id] > 0) ? $_POST['option_' . $m->option_id] : 0;
                $m->save();
                $flag++;
            }

            if ($flag != 0) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', Yii::t('lang', 'settings') . ' ' . Yii::t('lang', 'msg_update'));
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', Yii::t('lang', 'msg_error'));
            }
            //print_r($model->getErrors());die;
            $this->redirect(array('settings'));
        }

        $this->render('settings', array(
            'model' => $model
        ));
    }

}
