<?php
require_once './jfun.php';
JFUN::init();
$model = Model_Manager::create('test');
$modelMsg = $model->getMsg();
$modelCol = $model->getCol();
$modelDtl = $model->getAll();
print_r($modelDtl);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript" src="./source/css/public.css"></script>
    <script type="text/javascript" src="./source/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="./source/js/public.js"></script>
</head>
<body>
<div>
    <table>
        <tr>
            <?php foreach ($modelCol as $value) { ?>
                <td><?= $value; ?></td>
            <?php } ?>
        </tr>
        <?php foreach ($modelDtl as $valueDtl) { ?>
            <tr>
                <?php foreach ($modelCol as $value) { ?>
                    <td><?= $valueDtl[$value]; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
