<?php

class PromotionController extends Controller
{
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
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'create', 'update', 'delete'),
                'users' => array('admin'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Promotion;

        $this->performAjaxValidation($model);
		
        if (isset($_POST['Promotion'])) {
            $model->attributes = $_POST['Promotion'];            
			
			$promotion_file = CUploadedFile::getInstance($model, 'promotion_file');
			$random_name = rand(1111, 9999) . date('Ymdhi');

			if (!empty($promotion_file)) {
				$extension = strtolower($promotion_file->getExtensionName());
				$filename = "{$random_name}.{$extension}";
				$model->promotion_file = $filename;
				$promotion_file->saveAs(Utils::getPromotionFileBasePath() . $filename);
			}

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Promotion added successfully.');
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
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Promotion'])) {
            $model->attributes = $_POST['Promotion'];
            
			$promotion_file = CUploadedFile::getInstance($model, 'promotion_file');
			$random_name = rand(1111, 9999) . date('Ymdhi');

			if (!empty($promotion_file)) {
				$extension = strtolower($promotion_file->getExtensionName());
				$filename = "{$random_name}.{$extension}";
				$model->promotion_file = $filename;
				$promotion_file->saveAs(Utils::getPromotionFileBasePath() . $filename);
			}
			
            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Promotion updated successfully.');
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
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if ($model->delete()) {

            if (!isset($_GET['ajax'])) {
                Yii::app()->user->setFlash('msg_type', 'alert-success');
                Yii::app()->user->setFlash('message', 'Promotion deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg">Promotion deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Promotion('search');
        $model->unsetAttributes();
        if (isset($_GET['Promotion'])) {
            $model->attributes = $_GET['Promotion'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
	}	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Promotion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Promotion::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Promotion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promotion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
