<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/3
 * Time: 21:22
 */
class DbModel
{
    private $jdb;
    private $modelName;

    public function __construct($modelName, $useNew = false)
    {
        $this->jdb = $useNew == false ? Db_factory::DefaultDb() : Db_factory::create();
        $this->modelName = $modelName;
    }

    public function add($val_arr)
    {
        return $this->jdb->insert($this->tableName(), $val_arr);
    }

    public function modify($data, $where)
    {
        return $this->jdb->update($this->tableName(), $data, $where);
    }

    public function del($where)
    {
        return $this->jdb->delete($this->tableName(), $where);
    }

    public function getAll()
    {
        return $this->jdb->select($this->tableName());
    }

    public function getMsg()
    {
        return $this->jdb->getTableMsg($this->tableName());
    }

    public function getCol()
    {
        return $this->jdb->getTableCol($this->tableName());
    }

    private function tableName(){
        return 'm_'.$this->modelName;
    }
}