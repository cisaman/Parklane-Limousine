<?php

class AdhocptopController extends Controller {

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
                'actions' => array('index', 'create', 'update', 'delete', 'remove', 'view', 'confirm'),
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
        $model = $this->loadModel($id);
        $model->adhocptop_statuscode = 2;
        $model->save();

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Adhocptop;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Adhocptop'])) {
            $model->attributes = $_POST['Adhocptop'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->adhocptop_id));
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

        $model->adhocptop_statuscode = 2;
        $model->save();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Adhocptop'])) {
            $model->attributes = $_POST['Adhocptop'];

            $model->adhocptop_licenseplateno = $_POST['Adhocptop']['adhocptop_licenseplateno'];
            $model->adhocptop_drivername = $_POST['Adhocptop']['adhocptop_drivername'];
            $model->adhocptop_surcharge = $_POST['Adhocptop']['adhocptop_surcharge'];
            $model->adhocptop_remark = $_POST['Adhocptop']['adhocptop_remark'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Adhoc Point to Point Record ' . Yii::t('lang', 'msg_update'));
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', Yii::t('lang', 'msg_error'));
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
                Yii::app()->user->setFlash('message', 'Adhoc Point to Point Record ' . Yii::t('lang', 'msg_delete'));
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg">Adhoc Point to Point Record ' . Yii::t('lang', 'msg_delete') . '</div>';
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
        $model = new Adhocptop('search');

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Adhocptop'])) {
            $model->attributes = $_GET['Adhocptop'];
        }

        if (isset($_REQUEST['ajax'])) {
            $this->renderPartial('index', array(
                'model' => $model,
            ));
        } else {
            $this->render('index', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Adhocptop('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Adhocptop']))
            $model->attributes = $_GET['Adhocptop'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Adhocptop the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Adhocptop::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Adhocptop $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'adhocptop-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionConfirm() {
        $bookings = $_POST['bookings'];

        if (!empty($bookings)) {
            try {
                foreach ($bookings as $single) {
                    $model = Adhocptop::model()->findByPk($single);
                    $model->adhocptop_statuscode = 3;
                    $model->save();
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'All selected bookings are confirmed!');
            } catch (Exception $e) {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Error: ' . $e);
            }
        }

        $this->redirect('index');
    }

}
