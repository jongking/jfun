<?php
class JDB extends AbstractDB{
	//pdo连实例
	private $pdo;

	public function insert($tableName, $value_arr = array()){
		$sql = "INSERT INTO {$tableName}";
		$this->pdo->exec($sql);
	}

	public function query($sql){
		$rs = $this->pdo->query($sql);
		$rs->setFetchMode(PDO::FETCH_ASSOC);
		return $rs->fetchAll();
	}

	public function exec($sql){
		return $this->pdo->exec($sql);
	}

	public function close(){
		$this->pdo = null;
	}

	public function beginTransaction(){
		return $this->pdo->beginTransaction();
	}

	public function commit(){
		return $this->pdo->commit();
	}
	
	public function rollBack(){
		return $this->pdo->rollBack();
	}

	protected function init($db_type, $db_host, $db_dbname, $db_username, $db_userpwd){
		try {
			$dsn = $db_type.':host='.$db_host.';dbname='.$db_dbname;
			$this->pdo = new PDO($dsn, $db_username, $db_userpwd);
			//字段强制变为小写
			$this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
			//设置为抛出错误模式
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
		catch (Exception $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
	}
}