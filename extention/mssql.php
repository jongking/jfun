<?php
class JDB extends AbstractDB{
	//pdo连实例
	private $pdo;
	private $usetranslation = false;

	public function select($table, $data = '*', $where = '', $limit = '', $order = '', $group = '') {
		$where = $where == '' ? '' : ' WHERE '.$where;
		$order = $order == '' ? '' : ' ORDER BY '.$order;
		$group = $group == '' ? '' : ' GROUP BY '.$group;
		$limit = $limit == '' ? '' : ' Top '.$limit.' ';
		$field = explode(',', $data);
		array_walk($field, array($this, 'add_special_char'));
		$data = implode(',', $field);
		$sql = 'SELECT '.$limit.$data.' FROM ['.$table.'] '.$where.$group.$order;
		return $this->query($sql);
	}

	public function select_one($table, $data = '*', $where = '', $order = '', $group = '') {
		return $this->select($table, $data, $where, '1', $order, $group);
	}

	public function insert($table, $value_arr){
		// if(!is_array( $value_arr ) || $table == '' || count($value_arr) == 0) {
		// 	return false;
		// }
		$fielddata = array_keys($value_arr);
		$valuedata = array_values($value_arr);
		array_walk($fielddata, array($this, 'add_special_char'));
		array_walk($valuedata, array($this, 'escape_string'));
		$field = implode (',', $fielddata);
		$value = implode (',', $valuedata);
		$sql = "INSERT INTO [{$table}] ({$field}) VALUES ({$value})";
		$this->exec($sql);
		//获取最新的id
		$result = $this->query("SELECT LAST_INSERT_ID=@@IDENTITY");
		return $result[0]['last_insert_id'];
	}

	public function update($table, $data, $where) {
		if($table == '' or $where == '') {
			return false;
		}

		$where = ' WHERE '.$where;
		$field = '';
		if(is_string($data) && $data != '') {
			$field = $data;
		} elseif (is_array($data) && count($data) > 0) {
			$fields = array();
			foreach($data as $k=>$v) {
				switch (substr($v, 0, 2)) {
					case '+=':
						$v = substr($v,2);
						if (is_numeric($v)) {
							$fields[] = $this->add_special_char($k).'='.$this->add_special_char($k).'+'.$this->escape_string($v, '', false);
						} else {
							continue;
						}
						
						break;
					case '-=':
						$v = substr($v,2);
						if (is_numeric($v)) {
							$fields[] = $this->add_special_char($k).'='.$this->add_special_char($k).'-'.$this->escape_string($v, '', false);
						} else {
							continue;
						}
						break;
					default:
						$fields[] = $this->add_special_char($k).'='.$this->escape_string($v);
				}
			}
			$field = implode(',', $fields);
		} else {
			return false;
		}

		$sql = 'UPDATE ['.$table.'] SET '.$field.$where;
		return $this->exec($sql);
	}

	public function delete($table, $where) {
		if ($table == '' || $where == '') {
			return false;
		}
		$where = ' WHERE '.$where;
		$sql = 'DELETE FROM ['.$table.'] '.$where;
		return $this->exec($sql);
	}

	public function query($sql){
		try {
			$this->to_gb2312($sql);
	   		$rs = $this->pdo->query($sql);
			$rs->setFetchMode(PDO::FETCH_ASSOC);
			$result = array();
			while($row = $rs->fetch()){
				//转为utf-8
				array_walk($row, array($this, 'to_utf8'));
				array_push($result, $row);
			}
			return $result;
		}
		catch (PDOException $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
		catch (Exception $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
	}

	public function exec($sql){
		try {
			$this->to_gb2312($sql);
	   		return $this->pdo->exec($sql);
		}
		catch (PDOException $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
		catch (Exception $e) {
			$this->errHandle($e, __FILE__, __LINE__);
		}
	}

	public function close(){
		$this->pdo = null;
	}

	public function createTable($table, $value_arr){
		$valuedata = array_values($value_arr);
		$value = implode (',', $valuedata);
		$sql = "CREATE TABLE [{$table}]({$value})";
		return $this->exec($sql);
	}

	public function alterTable($table, $value_arr){
		$valuedata = array_values($value_arr);
		$value = implode (',', $valuedata);
		$sql = "ALTER TABLE [{$table}] {$value}";
		return $this->exec($sql);
	}

	public function dropTable($table){
		$sql = "DROP TABLE [{$table}]";
		return $this->exec($sql);
	}

	public function getTableMsg($table){
		$sql = "Select * from TableMsgV Where ID=OBJECT_ID('{$table}')";
		return $this->query($sql);
	}

	public function beginTransaction(){
		$this->usetranslation = true;
		return $this->pdo->query('BEGIN TRANSACTION');
	}

	public function commit(){
		return $this->pdo->query('COMMIT TRANSACTION');
	}
	
	public function rollBack(){
		return $this->pdo->query('ROLLBACK TRANSACTION');
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

	/**
	 * 对字段两边加反引号，以保证数据库安全
	 * @param $value 数组值
	 */
	private function add_special_char(&$value) {
		if('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos ( $value, '`')) {
			//不处理包含* 或者 使用了sql方法。
		} else {
			$value = '['.trim($value).']';
		}
		if (preg_match("/\b(select|insert|update|delete)\b/i", $value)) {
			$value = preg_replace("/\b(select|insert|update|delete)\b/i", '', $value);
		}
		return $value;
	}
	
	/**
	 * 对字段值两边加引号，以保证数据库安全
	 * @param $value 数组值
	 * @param $key 数组key
	 * @param $quotation 
	 */
	private function escape_string(&$value, $key='', $quotation = 1) {
		if ($quotation) {
			$q = '\'';
		} else {
			$q = '';
		}
		$value = $q.$value.$q;
		return $value;
	}

	/**
	 * @param $e
	 */
	protected function errHandle($e, $file, $line)
	{
		if($this->usetranslation){
			$this->rollBack();
		}
		$this->close();
		Err::Msg($e->getMessage(), $file, $line);
	}

	private function to_utf8(&$value, $key='') {
		$value = iconv('GB2312', 'UTF-8', $value);
		return $value;
	}

	private function to_gb2312(&$value, $key='') {
		$value = iconv('UTF-8', 'GB2312', $value);
		return $value;
	}
}