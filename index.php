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
            gridster = $(".gridster").gridster({    //通过jquery选择DOM实现gridster
                widget_selector:'div',
                widget_base_dimensions: [100, 100],    //模块的宽高 [宽,高]
                widget_margins: [5, 5]    //模块的间距 [上下,左右]
            }).data('gridster');
//            gridster.disable();
//                gridster.enable();

            var $accordion = $(".accordion-group > div");
            $accordion.hide();
            $accordion.attr("data-turnon", "False");
            $(".accordion-group").click(function(){
                var $this = $(this);
                if($this.attr("data-turnon") == "True"){
                    $this.find("div").hide();
                    $this.attr("data-turnon", "False");
                }
                else{
                    $this.find("div").show();
                    $this.attr("data-turnon", "True");
                }
            });
        });
    </script>
    <style>
        .gridster{border:1px solid #000000;}
        .gridster div{border:1px solid #000000;}
        .container{float:left; border: 1px solid #000000;}
        .accordion-group{
            cursor: pointer;}
    </style>
</head>
<body>
<div class="container">
    <table>
        <tr>
            <td>tempatename</td>
        </tr>
        <?php foreach ($modelDtl as $valueDtl) { ?>
            <tr>
                <td><a href="index.php?view=<?= $valueDtl['templatename'] ?>"><?= $valueDtl['templatename'] ?></a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<div class="container">
    <div class="accordion-group">
        a
        <div>b</div>
        <div>c</div>
        <div>d</div>
    </div>
</div>
<div class="container">
    <div class="gridster">
        <div data-row="1" data-col="8" data-sizex="1" data-sizey="3">
            <?php print_r($viewObj->getTemplate(Route::$view)); ?>
        </div>
    </div>
</div>
</body>
