<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/8
 * Time: 21:51
 */
//界面的实现类
class DbView extends DbFun
{
    public function getTemplate($templateName)
    {
        $result = $this->getOne('template', "templateName = '{$templateName}'");
        if(sizeof($result) == 1){
            return $result[0]['template'];
        }
        else{
            return "";
        }
    }

    public function __construct($useNew = false)
    {
        parent::__construct($useNew);
    }

    public function tableName()
    {
        return 'v_view';
    }
}