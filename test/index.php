<?php
require_once './jfun.php';
JFUN::init();
try {
    $db = Db_factory::create();
//    $db->beginTransaction();

//$result = $db->exec("UPDATE test SET name = 'hamburger2'");
//$result = $db->insert('test', array('no'=>'中'));
//$result = $db->query('select * from test');
//$result = $db->select('test', '*', "no='中'");
//$result = $db->select_one('test');
//$result = $db->update('test', array('no'=>'3', 'name'=>'中文'), '1=1');
//$result = $db->delete('test', "name='中文'");
//$result = $db->createTable('m_model', array("[id] [bigint] IDENTITY(1,1) NOT NULL PRIMARY KEY", "[no] [nvarchar](50) NULL"));
//   $result = $db->createTable('m_test2', array("`id` int(8) AUTO_INCREMENT NOT NULL PRIMARY KEY", "`no` varchar(50) DEFAULT NULL"));
//    $result = $db->dropTable('m_test2');
// $result = $db->query('Select * from syscolumns Where ID=OBJECT_ID("test")');
    $result = $db->getTableMsg('test');
//    $db->rollBack();
// $db->query('select * from test');
    // $model = Model_Manager::create('test');
    //$result = $model->getAll();

    print_r($result);
//    $db->close();
} catch (PDOException $e) {
    print("Error: " . $e->getMessage() . "<br/>");
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <script type="text/javascript" src="../source/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="../source/js/public.js"></script>
</head>
<body>

</body>
</html>
