<?php
require_once './jfun.php';
JFUN::init();
$model = Model_Manager::create('test');
$modelMsg = $model->getMsg();
$modelCol = $model->getCol();
$modelDtl = $model->getAll();
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
    <script>
        $(function(){
            var divZero = $("#divZero");
            var wd = $(window);
            var x = 10;
            var y = 10;
            var divNum = x * y;
            var divWidth = parseFloat(wd.width() / x);
            var divHeight = parseFloat(wd.height() / y);
            for(var i = 0; i < divNum; i++){
                divZero.after("<div style='border: 1px solid #000000; float: left; width:" + (divWidth - 2) + "px; height:" + (divHeight - 2) + "px;'></div>");
            }

            //Test
            var divTest = $("#divTest");
            var dWidth = parseInt(divTest.data("width"));
            var dHeight = parseInt(divTest.data("height"));
            divTest.width(dWidth * divWidth);
            divTest.height(dHeight * divHeight);
        })
        function resize(){
            var divZero = $("#divZero");
            var wd = $(window);
            var x = 10;
            var y = 10;
            var divNum = x * y;
            var divWidth = parseFloat(wd.width() / x);
            var divHeight = parseFloat(wd.height() / y);
            for(var i = 0; i < divNum; i++){
                divZero.after("<div style='border: 1px solid #000000; float: left; width:" + (divWidth - 2) + "px; height:" + (divHeight - 2) + "px;'></div>");
            }

            //Test
            var divTest = $("#divTest");
            var dWidth = parseInt(divTest.data("width"));
            var dHeight = parseInt(divTest.data("height"));
            divTest.width(dWidth * divWidth);
            divTest.height(dHeight * divHeight);
        }
    </script>
</head>
<body onresize="resize()">
<div id="divTest" style="position: absolute; border:1px solid #000000;" data-width="3" data-height="4"></div>
<div id="divZero" style="display: none;"></div>
<!--    <table>-->
<!--        <tr>-->
<!--            --><?php //foreach ($modelCol as $value) { ?>
<!--                <td>--><?//= $value; ?><!--</td>-->
<!--            --><?php //} ?>
<!--        </tr>-->
<!--        --><?php //foreach ($modelDtl as $valueDtl) { ?>
<!--            <tr>-->
<!--                --><?php //foreach ($modelCol as $value) { ?>
<!--                    <td>--><?//= $valueDtl[$value]; ?><!--</td>-->
<!--                --><?php //} ?>
<!--            </tr>-->
<!--        --><?php //} ?>
<!--    </table>-->
</body>
