<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
</head>
<body>
<?php
require_once './jfun.php';
JFUN::init();
try {
    $db = Db_factory::create();
    $db->beginTransaction();

//$result = $db->exec("UPDATE test SET name = 'hamburger2'");
//$result = $db->insert('test', array('no'=>'3', 'name'=>'中文'));
//$result = $db->query('select * from test');
//$result = $db->select('test', '*', "name='中'");
//$result = $db->select_one('test');
//$result = $db->update('test', array('no'=>'3', 'name'=>'中文'), '1=1');
//$result = $db->delete('test', "name='中文'");
//    $result = $db->createTable('testnohere', array("[id] [bigint] IDENTITY(1,1) NOT NULL PRIMARY KEY", "[no] [nvarchar](50) NULL"));
//    $result = $db->dropTable('testnohere');
// $result = $db->query('Select * from syscolumns Where ID=OBJECT_ID("test")');
    $result = $db->getTableMsg('test');
    $db->rollBack();
// $db->query('select * from test');
    print_r($result);
    $db->close();
} catch (PDOException $e) {
    print("Error: " . $e->getMessage() . "<br/>");
}
?>
</body>
</html>
