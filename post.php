<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/11
 * Time: 19:27
 */
require_once './jfun.php';

$act = REQUEST("act");

switch ($act) {
    case "addModel":
        $modelName = POST("modelName");
        $formName = POST("formName");
        $formType = POST("formType");
        $formDefaultValue = POST("formDefaultValue");

        Check::create()->limitLen($modelName, 2, 50, 'modelName');

        $model = Model_Manager::create($modelName);
        $model->createByArray($formName, $formType, $formDefaultValue);
        exit("OK");
    default:
        die($act);
}