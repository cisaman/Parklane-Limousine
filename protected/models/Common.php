<?php

class Common extends CActiveRecord {

    public function tableName() {
        return 'sc_classified';
    }

    public function classified() {
        $where = " status =1";
        $res = Yii::app()->db->createCommand()
                ->select('classified_id,classified_text,classified_img  ,after_click_image')
                ->from('sc_classified')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_banner() {

        $res = Yii::app()->db->createCommand()
                ->select('aboutus,banner_image,ads_image,google_playurl ')
                ->from('sc_appinfo')
                ->queryAll();

        return $res;
    }

    public function get_district() {
        $where = " status =1";
        $res = Yii::app()->db->createCommand()
                ->select('district_id,district_name')
                ->from('sc_district')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_email_id() {

        $res = Yii::app()->db->createCommand()
                ->select('email')
                ->from('sc_appinfo')
                ->limit(1)
                ->queryAll();

        return $res;
    }

    public function insert_comments($sub, $email_id, $comments) {

        $insert_comments = 'INSERT INTO `sc_comments` (`subject`, `email` ,`comment_content`) VALUES ("' . $sub . '","' . $email_id . '" ,"' . $comments . '")';
        return $id = Yii::app()->db->createCommand($insert_comments)->execute();
    }

    public function get_advertisement() {
        $where = " status =1";
        $res = Yii::app()->db->createCommand()
                ->select('ads_id,image_title,image_url,ads_text,link')
                ->from('sc_advertisement')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_gallery($school_id) {

        $where = " school_id =" . $school_id;

        $res = Yii::app()->db->createCommand()
                ->select('*')
                ->from('sc_gallery')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_school_id($classified_id) {


        $where = " classified_id =" . $classified_id;

        $res = Yii::app()->db->createCommand()
                ->select('school_id')
                ->from('sc_school_rel_classified')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_school_list($school_id, $district_id = 0) {
        $res = "";
        if (!empty($district_id)) {
            foreach ($school_id as $value) {

                if (!empty($res)) {
                    $res.=" , ";
                }
                $res .= implode($value, ",");
            }
            $where = " status =1 and  school_id  in ( " . $res . " ) and district_id = " . $district_id;
        } else {
            $where = "status =1 and school_id  in (" . $school_id . ")";
        }

        $res = Yii::app()->db->createCommand()
                ->select('school_id,school_name,school_banner,school_address AS school_details ,school_desc AS school_summary, district_id')
                ->from('sc_school')
                ->where($where)
                ->queryAll();

        return $res;
    }

    public function get_school_list_by_src($search) {
        $res = "";

        $where = " school_name like '%" . $search . "%'  or  school_address like  '%" . $search . "%'  or school_desc like '%" . $search . "%' ";

        $res = Yii::app()->db->createCommand()
                ->select('school_id,school_name,school_banner,school_address AS school_details ,school_desc AS school_summary, district_id')
                ->from('sc_school')
                ->where($where)
                ->queryAll();

        return $res;
    }
        

}
