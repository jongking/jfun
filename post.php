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

        Check::create()->limitLen($modelName, 50, 2, 'modelName');
        $addModelScript = array("`id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY");
        foreach ($formName as $key => $colName) {
            if(Check::create()->isEmpty($colName)) continue;

            $colType = $formType[$key];
            $colDefaultValue = $formDefaultValue[$key];
            if(!Check::create()->isEmpty($colDefaultValue)){
                $colDefaultValue = " DEFAULT '{$colDefaultValue}' ";
            }
            switch($colType){
                case "int":array_push($addModelScript, "`{$colName}` int(20) NOT NULL {$colDefaultValue}");break;
                case "varchar1":array_push($addModelScript, "`{$colName}` varchar(100) NOT NULL {$colDefaultValue}");break;
                case "varchar2":array_push($addModelScript, "`{$colName}` varchar(4000) NOT NULL {$colDefaultValue}");break;
                case "text":array_push($addModelScript, "`{$colName}` TEXT NOT NULL {$colDefaultValue}");break;
                case "date":array_push($addModelScript, "`{$colName}` int(20) NOT NULL {$colDefaultValue}");break;
            }
        }

        $model = Model_Manager::create($modelName);
        $model->create($addModelScript);
        exit("OK");
    default:
        die($act);
}