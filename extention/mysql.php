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
	
	protected function init(){
		try {
	   		$this->pdo = new PDO(Config::dsn(), Config::$db_username, Config::$db_userpwd);
	   		//字段强制变为小写
	   		$this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
		}
		catch (PDOException $e) {
			$this->close();
	   		die("Error: " . $e->getMessage() . "<br/>");
		}
		catch (Exception $e) {
			$this->close();
	   		die("Error: " . $e->getMessage() . "<br/>");
		}
	}
}