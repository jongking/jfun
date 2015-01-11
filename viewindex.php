<?php
require_once './jfun.php';

$view = View_Manager::create();
$modelMsg = $view->getMsg();
$modelCol = $view->getCol();
$modelDtl = $view->getAll();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./source/css/public.css" rel="stylesheet">
    <script type="text/javascript" src="./source/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="./source/js/public.js"></script>
</head>
<body>
    <form method="post">
        <input type="submit" value="添加视图模版">
    </form>

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
</body>
