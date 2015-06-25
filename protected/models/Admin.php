<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property integer $admin_id
 * @property string $admin_name
 * @property string $admin_username
 * @property string $admin_password
 * @property string $admin_email
 * @property integer $admin_status
 * @property string $admin_created
 */
class Admin extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{admin}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('admin_name, admin_username, admin_password, admin_email', 'required', 'message' => Yii::t('lang', 'please_enter') . ' {attribute}.'),
            array('admin_username', 'unique'),
            array('admin_name, admin_username, admin_password', 'length', 'max' => 225),
            array('admin_email', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('admin_id, admin_name, admin_username, admin_password, admin_email, admin_status, admin_created', 'safe', 'on' => 'search'),
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
            'admin_id' => Yii::t('lang', 'id'),
            'admin_name' => Yii::t('lang', 'name'),
            'admin_username' => Yii::t('lang', 'username'),
            'admin_password' => Yii::t('lang', 'password'),
            'admin_email' => Yii::t('lang', 'email_id'),
            'admin_status' => Yii::t('lang', 'status'),
            'admin_created' => Yii::t('lang', 'created_date'),
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

        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('admin_name', $this->admin_name, true);
        $criteria->compare('admin_username', $this->admin_username, true);
        $criteria->compare('admin_password', $this->admin_password, true);
        $criteria->compare('admin_email', $this->admin_email, true);
        $criteria->compare('admin_status', $this->admin_status);
        $criteria->compare('admin_created', $this->admin_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Admin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getProfile() {
        $id = Yii::app()->session['admin_data']['admin_id'];
        $model = Admin::model()->findByPk($id);

        $role_name = 'Operator';
        if ($model->admin_role == 1) {
            $role_name = 'Supervisor';
        }

        $result = array(
            'name' => $model->admin_name,
            'email' => $model->admin_email,
            'photo' => !empty($model->admin_image) ? Utils::UserImagePath() . $model->admin_image : Utils::UserImagePath_M(),
            'role_id' => $model->admin_role,
            'role' => $role_name
        );
        return $result;
    }

}
