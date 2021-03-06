<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/3
 * Time: 21:22
 */
//模型的实现类
class DbModel extends DbFun
{
    private $modelName;

    public function __construct($modelName, $useNew = false)
    {
        $this->modelName = $modelName;
        parent:: __construct($useNew);
    }

    public function tableName(){
        return 'm_'.$this->modelName;
    }

    public function getAllModelName(){
        $result = $this->jdb->getTableCol('m_%', 'table_name', '', '', 'table_name');
        array_walk($result, array($this, 'replaceM_'));
        return $result;
    }

    private function replaceM_(&$value){
        $value = substr($value, 2);
    }
}