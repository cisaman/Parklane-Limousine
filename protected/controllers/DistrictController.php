<?php

class DistrictController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    protected function beforeAction($event) {
        if (!isset(Yii::app()->session['admin_data'])) {
            $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/login'));
        }
        return TRUE;
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'create', 'update', 'delete', 'getAllDistrictsByCountryID'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new District;

        $this->performAjaxValidation($model);

        if (isset($_POST['District'])) {
            $model->attributes = $_POST['District'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'District added successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
            }
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['District'])) {
            $model->attributes = $_POST['District'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'District updated successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
            }
            //print_r($model->getErrors());die;
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if ($model->delete()) {

            if (!isset($_GET['ajax'])) {
                Yii::app()->user->setFlash('msg_type', 'alert-success');
                Yii::app()->user->setFlash('message', 'District deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg">District deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new District('search');
        $model->unsetAttributes();
        if (isset($_GET['District'])) {
            $model->attributes = $_GET['District'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return District the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = District::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param District $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'district-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetAllDistrictsByCountryID() {
        $country_id = $_POST['country_id'];
        $state = $_POST['state'];

        if ($state == 'add') {
            /* Get Group Name */
            $group_name = 'A';
            $model = Countrydistrictgroup::model()->findAllByAttributes(array('group_countryID' => $country_id), array('order' => 'group_name DESC', 'limit' => 1));
            if (count($model) > 0) {
                $symbol = $model[0]->group_name;
                $symbols = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H', 8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M', 13 => 'N', 14 => 'O', 15 => 'P', 16 => 'Q', 17 => 'R', 18 => 'S', 19 => 'T', 20 => 'U', 21 => 'V', 22 => 'W', 23 => 'X', 24 => 'Y', 25 => 'Z');
                $index = array_search($symbol, $symbols);
                $group_name = $symbols[$index + 1];
            }
            /* Get Group Name */
        }

        /* Get CheckBox List */
        $model = District::model()->findAll('district_countryID=' . $country_id);
        
        if (Yii::app()->user->getState('lang') == 'en') {
            $districtData = CHtml::listData($model, 'district_id', 'district_name_en');
        } else {
            $districtData = CHtml::listData($model, 'district_id', 'district_name_ch');
        }

        asort($districtData);

        //if ($state == 'update') {
        $selectedDistrict = Countrydistrictgroup::model()->findAll('group_countryID=' . $country_id);
        $str = '';
        foreach ($selectedDistrict as $dd) {
            $str.=$dd->group_cities . ',';
        }
        $str = explode(',', rtrim($str, ','));
        //}

        $result = '<div class="row">';
        foreach ($districtData as $key => $value) {
            $result .= '<div class="col-md-4">';
            if ($state == 'update') {
                $flag1 = '';
                $flag2 = '';
                if (in_array($key, $str)) {
                    $flag1 = 'checked';
                    //$flag2 = 'disabled';
                }
            } else {
                $flag1 = '';
                $flag2 = '';
                if (in_array($key, $str)) {
                    $flag1 = 'checked';
                    $flag2 = 'disabled';
                }
            }
            $result .='<input type="checkbox" name="district[]" value="' . $key . '" ' . $flag1 . ' ' . $flag2 . '/> ' . $value;
            $result .= '</div>';
        }
        $result .= '</div>';
        /* Get CheckBox List */

        echo json_encode(array('groupname' => $group_name, 'districts' => $result));
    }

}
