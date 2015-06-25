<?php

$code = Yii::app()->user->getState('lang');
if (!empty($code)) {
    $lang = $code;
} else {
    $lang = "ch";
}

$sql = "select * from pa_lang where lang_shortcode='" . $lang . "' ";
$list = Yii::app()->db->createCommand($sql)->queryAll();

$rs = array();

foreach ($list as $item) {
    //process each item here
    $rs[$item['lang_attribute']] = $item['lang_attribute_t'];
}

return $rs;
?>