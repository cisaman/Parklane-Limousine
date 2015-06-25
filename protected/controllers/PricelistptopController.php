<?php

class PricelistptopController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    protected function beforeAction($event) {
        if (!isset(Yii::app()->session['admin_data'])) {
            $this->redirect(array('dashboard/login'));
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
                'actions' => array('index', 'create', 'update', 'delete', 'getAllGroupsByCountryID', 'getAllDetailsForPrice', 'saveFare'),
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
        $model = new Pricelistptop;

        $this->performAjaxValidation($model);

        if (isset($_POST['Pricelistptop'])) {
            $model->attributes = $_POST['Pricelistptop'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', Yii::t('lang', 'pricelistptop') . ' ' . Yii::t('lang', 'msg_add'));
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', Yii::t('lang', 'msg_error'));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pricelistptop'])) {
            $model->attributes = $_POST['Pricelistptop'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ptop_id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Pricelistptop');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Pricelistptop('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pricelistptop']))
            $model->attributes = $_GET['Pricelistptop'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pricelistptop the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Pricelistptop::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pricelistptop $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pricelistptop-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetAllGroupsByCountryID() {
        $country_id = $_POST['country_id'];
        $state = $_POST['state'];

        $model = Countrydistrictgroup::model()->findAll('group_countryID=' . $country_id);
        $groupData = CHtml::listData($model, 'group_id', 'group_name');

        echo json_encode(array('groupdata' => $groupData));
    }

    public function actionGetAllDetailsForPrice() {
        $fromGroupId = $_POST['from'];
        $toGroupId = $_POST['to'];

        $fromModel = Countrydistrictgroup::model()->findByPk($fromGroupId);
        $fromCountryName = Country::model()->getCountryName($fromModel->group_countryID);
        $fromCitiesArray = explode(',', $fromModel->group_cities);

        $s = '';
        for ($i = 0; $i < count($fromCitiesArray); $i++) {
            $r = District::model()->getDistrictName($fromCitiesArray[$i]);
           // $s.=$r . ' /<br/>';
             $s.=$r . ' / ';
        }
        //$fromCities = rtrim($s, ' /<br/>');
        $fromCities = rtrim($s, ' / ');

        $from = array(
            'fromGroupId' => $fromGroupId,
            'fromCountry' => $fromCountryName,
            'fromDistricts' => $fromCities,
        );

        $toModel = Countrydistrictgroup::model()->findByPk($toGroupId);
        $toCountryName = Country::model()->getCountryName($toModel->group_countryID);
        $toCitiesArray = explode(',', $toModel->group_cities);

        $s = '';
        for ($i = 0; $i < count($toCitiesArray); $i++) {
            $r = District::model()->getDistrictName($toCitiesArray[$i]);
            //$s.=$r . ' /<br/>';
            $s.=$r . ' / ';
        }
        //$toCities = rtrim($s, ' /<br/>');
        $toCities = rtrim($s, ' / ');

        $to = array(
            'toGroupId' => $toGroupId,
            'toCountry' => $toCountryName,
            'toDistricts' => $toCities,
        );

        echo json_encode(array('from' => $from, 'to' => $to));
    }

    public function actionSaveFare() {
        $fromId = $_POST['from'];
        $toId = $_POST['to'];
        $price = $_POST['price'];
        $msg = '';
        $flag = 0;

        $check = Pricelistptop::model()->findByAttributes(array('ptop_from_groupID' => $fromId, 'ptop_to_groupID' => $toId));

        if (count($check) > 0) {
            $check->ptop_price = $price;
            if ($check->save()) {
                $msg = 'Price updated successfully';
                $flag = 1;
            } else {
                $msg = 'Error in updating price successfully';
                $flag = 0;
            }
        } else {
            $model = new Pricelistptop;
            $model->ptop_from_groupID = $fromId;
            $model->ptop_to_groupID = $toId;
            $model->ptop_price = $price;
            if ($model->save()) {
                $msg = 'Price added successfully';
                $flag = 1;
            } else {
                $msg = 'Error in adding price successfully';
                $flag = 0;
            }
        }

        echo json_encode(array('success' => $flag, 'message' => $msg));
    }

}
