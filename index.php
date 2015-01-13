<?php
require_once './jfun.php';

$viewObj = View_Manager::create();
$modelCol = $viewObj->getCol();
//$modelDtl = $viewObj->getAll();
$modelDtl = $viewObj->get('templatename');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./source/css/public.css" rel="stylesheet">
    <link href="./source/css/jquery.gridster.css" rel="stylesheet">
    <script type="text/javascript" src="./source/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="./source/js/jquery.gridster.js"></script>
    <script type="text/javascript" src="./source/js/public.js"></script>
    <script>
        var gridster;
        $(function(){
            gridster = $(".gridster ul").gridster({    //通过jquery选择DOM实现gridster
                widget_base_dimensions: [100, 120],    //模块的宽高 [宽,高]
                widget_margins: [5, 5]    //模块的间距 [上下,左右]
            }).data('gridster');
        });
    </script>
    <style>
        .gridster ul{margin:0;}
        .gridster ul li{list-style-type:none;border:1px solid #e0e0e0;}
    </style>
</head>
<body>
<div class="gridster">
    <ul>
        <li data-row="1" data-col="1" data-sizex="2" data-sizey="2">
            <!-- 这里写了一个header，对应配置里面的handle，鼠标落到header上面可以拖，而不是整个块 -->
            <header>|||</header>
            0
        </li>
        <li data-row="1" data-col="3" data-sizex="1" data-sizey="2">
            <header>|||</header>
            1
        </li>
        <li data-row="1" data-col="4" data-sizex="1" data-sizey="1">
            <header>|||</header>
            2
        </li>
        <li data-row="3" data-col="2" data-sizex="3" data-sizey="1">
            <header>|||</header>
            3
        </li>
        <li data-row="4" data-col="1" data-sizex="1" data-sizey="1">
            <header>|||</header>
            4
        </li>
        <li data-row="3" data-col="1" data-sizex="1" data-sizey="1">
            <header>|||</header>
            5
        </li>
        <li data-row="4" data-col="2" data-sizex="1" data-sizey="1">
            <header>|||</header>
            6
        </li>
        <li data-row="5" data-col="2" data-sizex="1" data-sizey="1">
            <header>|||</header>
            7
        </li>
        <li data-row="4" data-col="4" data-sizex="1" data-sizey="1">
            <header>|||</header>
            8
        </li>
        <li data-row="1" data-col="5" data-sizex="1" data-sizey="3">
            <header>|||</header>
            9
        </li>
    </ul>
</div>
<!--<div style="float:left; border: 1px solid #000000;">-->
<!--    <table>-->
<!--        <tr>-->
<!--            <td>tempatename</td>-->
<!--        </tr>-->
<!--        --><?php //foreach ($modelDtl as $valueDtl) { ?>
<!--            <tr>-->
<!--                <td><a href="index.php?view=--><?//= $valueDtl['templatename'] ?><!--">--><?//= $valueDtl['templatename'] ?><!--</a></td>-->
<!--            </tr>-->
<!--        --><?php //} ?>
<!--    </table>-->
<!--</div>-->
<!--<div data-row="1" data-col="3" data-sizex="1" data-sizey="2">-->
<!---->
<!--</div>-->
<!--<div style="float:left; border: 1px solid #000000;">-->
<!--    --><?php //print_r($viewObj->getTemplate(Route::$view)); ?>
<!--</div>-->
</body>
