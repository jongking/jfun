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
}