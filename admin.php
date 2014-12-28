<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
</head>
<body>
<?php
require_once './jfun.php';
JFUN::init();
try{
$db = Db_factory::create();
$db->beginTransaction();
//$result = $db->exec("UPDATE test SET name = 'hamburger2'");
//$result = $db->insert('test', array('no'=>'3', 'name'=>'5'));
$result = $db->query('select * from test');
$db->commit();
// $db->query('select * from test');
print_r($result);
$db->close();
}
catch (PDOException $e) {
    print("Error: " . $e->getMessage() . "<br/>");
}
?>
</body>
</html>
