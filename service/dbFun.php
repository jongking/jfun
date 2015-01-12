<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/8
 * Time: 21:34
 */
//数据库的简单实现类,用于基本的数据库操作
class DbComment extends DbFun{
    private $tableName;

    public function __construct($tableName, $useNew = false)
    {
        $this->viewName = $tableName;
        parent:: __construct($useNew);
    }

    public function tableName()
    {
        return $this->tableName;
    }
}

abstract class DbFun {
    protected $jdb;

    public function __construct($useNew = false)
    {
        $this->jdb = $useNew == false ? Db_factory::DefaultDb() : Db_factory::create();
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

    public function get($data = '*', $where = '', $limit = '', $order = '', $group = '')
    {
        return $this->jdb->select($this->tableName(), $data, $where, $limit, $order, $group);
    }

    public function getOne($data = '*', $where = '', $order = '', $group = '')
    {
        return $this->jdb->selectOne($this->tableName(), $data, $where, $order, $group);
    }

    public function getAll()
    {
        return $this->jdb->select($this->tableName());
    }

    public function getMsg($tableName = 'notableName')
    {
        if($tableName == 'notableName'){
            return $this->jdb->getTableMsg($this->tableName());
        }
        else{
            return $this->jdb->getTableMsg($tableName);
        }
    }

    public function getCol($colName = 'column_name')
    {
        return $this->jdb->getTableCol($this->tableName(), $colName);
    }

    public function create($val_arr)
    {
        return $this->jdb->createTable($this->tableName(), $val_arr);
    }

    public function createByArray(array$colNames, array$colTypes, array$collDefaultValues, $withId = true)
    {
        $addModelScript = array();
        if($withId == true){
            array_push($addModelScript, "`id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY");
        }
        foreach ($colNames as $key => $colName) {
            if(Check::create()->isEmpty($colName)) continue;

            $colType = $colTypes[$key];
            $colDefaultValue = $collDefaultValues[$key];
            if(!Check::create()->isEmpty($colDefaultValue)){
                $colDefaultValue = " DEFAULT '{$colDefaultValue}' ";
            }
            switch($colType){
                case "int":$colType = " int(20) ";break;
                case "varchar1":$colType = " varchar(100) ";break;
                case "varchar2":$colType = " varchar(4000) ";break;
                case "text":$colType = " TEXT ";break;
                case "date":$colType = " int(20) ";break;
            }
            array_push($addModelScript, "`{$colName}` {$colType} NOT NULL {$colDefaultValue}");
        }

        return $this->create($addModelScript);
    }

    public function alert($val_arr){
        return $this->jdb->alterTable($this->tableName(), $val_arr);
    }

    public function drop(){
        return $this->jdb->dropTable($this->tableName());
    }

    abstract public function tableName();
}