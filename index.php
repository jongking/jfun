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
    <script type="text/javascript" src="./source/js/mustache.js"></script>
    <script type="text/javascript" src="./source/js/jquery.gridster.js"></script>
    <script type="text/javascript" src="./source/js/jquery.mustache.js"></script>
    <script type="text/javascript" src="./source/js/public.js"></script>
    <script>
        function menuGroupInit() {
            var $menu = $(".menu-group");
            $menu.children().hide();
            $menu.attr("data-turnon", "False");
            var $menuHead = $(".menu-group-head");
            $menuHead.show();
            $menuHead.click(function () {
                var $parent = $(this).parent();
                if ($parent.attr("data-turnon") == "True") {
                    $parent.children().hide();
                    $parent.attr("data-turnon", "False");
                }
                else {
                    $parent.children().show();
                    $parent.attr("data-turnon", "True");
                }
                $(this).show();
            });
            $(".menu-group-head[data-turnon='True']").click();
        }
        var gridster;
        function gridsterInit() {
            gridster = $(".gridster").gridster({    //通过jquery选择DOM实现gridster
                widget_selector: 'div',
                widget_base_dimensions: [100, 100],    //模块的宽高 [宽,高]
                widget_margins: [5, 5]    //模块的间距 [上下,左右]
            }).data('gridster');
//            gridster.disable();
//                gridster.enable();
        }
        function loadTemplate() {
            $('#target').html($('#template').mustache({
                name: "Luke"
            }));
        }
        $(function () {
            loadTemplate();
            gridsterInit();
            menuGroupInit();

            $(".control-add").click(function () {
                var $this = $(this);
                var controlhtml = $this.attr("data-controlhtml");
                gridster.add_widget("<div>" + controlhtml + "</div>");
            });
        });
    </script>
    <style>
        .gridster {
            border: 1px solid #000000;
        }

        .gridster div {
            border: 1px solid #000000;
        }

        .container {
            float: left;
            border: 1px solid #000000;
        }

        .menu-group {
            background-color: antiquewhite
        }

        .menu-group-head {
            background-color: #9cc9e0;
            cursor: pointer;
        }

        .control-add{
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id="target" class="container">Loading...</div>
<script id="template" type="text/html">
    <div class="menu-group">
        <div class="menu-group-head" data-turnon="True">
            视图列表{{name}}
        </div>
        <div>
            <table>
                <tr>
                    <td>tempatename</td>
                </tr>
                <?php foreach ($modelDtl as $valueDtl) { ?>
                    <tr>
                        <td>
                            <a href="index.php?view=<?= $valueDtl['templatename'] ?>"><?= $valueDtl['templatename'] ?></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="menu-group">
        <div class="menu-group-head" data-turnon="True">
            控件列表
        </div>
        <div>
            <div class="menu-group">
                <div class="menu-group-head" data-turnon="True">
                    基本元素
                </div>
                <div class="control-add" data-controlhtml="<input>">输入框
                </div>
                <div>c</div>
                <div>d</div>
            </div>
            <div class="menu-group">
                <div class="menu-group-head">
                    aaaaa
                </div>
                <div>b</div>
                <div>c</div>
                <div>d</div>
            </div>
        </div>
    </div>
</script>
<div class="container">
    <div class="gridster">
        <div data-row="1" data-col="8" data-sizex="1" data-sizey="3">
            <?php print_r($viewObj->getTemplate(Route::$view)); ?>
        </div>
    </div>
</div>
</body>
