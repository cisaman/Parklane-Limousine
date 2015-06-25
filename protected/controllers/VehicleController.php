<?php

class VehicleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    protected function beforeAction($event) {
        if (!isset(Yii::app()->session['admin_data'])) {
            $this->redirect(Yii::app()->createAbsoluteUrl('dashboard/admin'));
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
                'actions' => array('index', 'create', 'update', 'delete', 'remove'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Vehicle();

        $this->performAjaxValidation($model);

        if (isset($_POST['Vehicle'])) {

            $model->attributes = $_POST['Vehicle'];
            $model->vehicle_description = $_POST['description'];

            $vehicle_image = CUploadedFile::getInstance($model, 'vehicle_image');
            $random_name = rand(1111, 9999) . date('Ymdhi');

            if (!empty($vehicle_image)) {
                $extension = strtolower($vehicle_image->getExtensionName());
                $filename = "{$random_name}.{$extension}";
                $model->vehicle_image = $filename;
                $vehicle_image->saveAs(Utils::getVehicleImageBasePath() . $filename);

                /* ------ Create Image Thumbnail Start ----- */
                $temp_path = Utils::getVehicleImageBasePath() . $filename;
                $img_thumbnail_path = Utils::getVehicleImageThumbBasePath() . $filename;

                $obj = new ImageThumbnail;
                $obj->CreateImageThumbnail($temp_path, $img_thumbnail_path, $extension);
                /* ------ Create Image Thumbnail End ----- */
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Vehicle information added successfully.');
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

        if (isset($_POST['Vehicle'])) {
            $model->attributes = $_POST['Vehicle'];
            $model->vehicle_status = $_POST['Vehicle']['vehicle_status'];
            $model->vehicle_description = $_POST['description'];

            $vehicle_image = CUploadedFile::getInstance($model, 'vehicle_image');
            $random_name = rand(1111, 9999) . date('Ymdhi');

            if (!empty($vehicle_image)) {
                $extension = strtolower($vehicle_image->getExtensionName());
                $filename = "{$random_name}.{$extension}";
                $model->vehicle_image = $filename;
                $vehicle_image->saveAs(Utils::getVehicleImageBasePath() . $filename);

                /* ------ Create Image Thumbnail Start ----- */
                $temp_path = Utils::getVehicleImageBasePath() . $filename;
                $img_thumbnail_path = Utils::getVehicleImageThumbBasePath() . $filename;

                $obj = new ImageThumbnail;
                $obj->CreateImageThumbnail($temp_path, $img_thumbnail_path, $extension);
                /* ------ Create Image Thumbnail End ----- */
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Vehicle information updated successfully.');
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

            if (!empty($model->vehicle_image) && isset($model->vehicle_image)) {
                $img_path = Utils::getVehicleImageBasePath() . $model->vehicle_image;
                $img_thumbnail_path = Utils::getVehicleImageThumbBasePath() . $model->vehicle_image;

                if (file_exists($img_path)) {
                    unlink($img_path);
                }
                if (file_exists($img_thumbnail_path)) {
                    unlink($img_thumbnail_path);
                }
            }

            if (!isset($_GET['ajax'])) {
                Yii::app()->user->setFlash('msg_type', 'alert-success');
                Yii::app()->user->setFlash('message', 'Vehicle information deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg">Vehicle information deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Vehicle('search');
        $model->unsetAttributes();
        if (isset($_GET['Vehicle'])) {
            $model->attributes = $_GET['Vehicle'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Vehicle the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Vehicle::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Vehicle $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vehicle-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRemove() {
        $id = $_POST['id'];
        $model = $this->loadModel($id);
        if (isset($model) && !empty($model)) {
            $flag = 0;
            if (file_exists(Utils::getVehicleImageBasePath() . $model->vehicle_image)) {
                unlink(Utils::getVehicleImageBasePath() . $model->vehicle_image);
                $flag++;
            }

            if (file_exists(Utils::getVehicleImageThumbBasePath() . $model->vehicle_image)) {
                unlink(Utils::getVehicleImageThumbBasePath() . $model->vehicle_image);
                $flag++;
            }

            if ($flag == 2) {
                $model->vehicle_image = '';
                if ($model->save()) {
                    echo $flag;
                } else {
                    echo $flag;
                }
            } else {
                echo $flag;
            }
        }
    }

}
