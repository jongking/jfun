<?php
require_once './jfun.php';

$viewObj = View_Manager::create();
$modelCol = $viewObj->getCol();
$modelDtl = $viewObj->getAll();
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
<div style="float:left;">
    <table>
        <tr>
            <?php foreach ($modelCol as $value) { ?>
                <td><?= $value; ?></td>
            <?php } ?>
        </tr>
        <?php foreach ($modelDtl as $valueDtl) { ?>
            <tr>
                <?php foreach ($modelCol as $value) { ?>
                    <td><?= urlencode($valueDtl[$value]); ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="float:left;">
    <?php print_r($viewObj->getTemplate($view)); ?>
</div>
</body>
