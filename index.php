<?php
require_once './jfun.php';

$viewObj = View_Manager::create('view');
$modelCol = $viewObj->getCol();
$modelDtl = $viewObj->get('templatename');

$htmlcontrolsObj = View_Manager::create('htmlcontrols');
$htmlcontrolsDtl = $htmlcontrolsObj->getAll();

$htmlcontrolsGroupObj = View_Manager::create('htmlcontrolgroups');
$htmlcontrolsGroup = $htmlcontrolsGroupObj->getAll();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./source/css/public.css" rel="stylesheet">
    <link href="./source/css/font-awesome.css" rel="stylesheet">
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
        function gridsterInit() {
            var windowWidth = 1000;
            var widget_base_dimensionsW = 25;
            var widget_base_dimensionsH = 25;
            var max_cols = parseInt(windowWidth / widget_base_dimensionsW);
            $("#editDiv").gridster({    //通过jquery选择DOM实现gridster
                widget_selector: 'div',
                widget_base_dimensions: [widget_base_dimensionsW, widget_base_dimensionsH],    //模块的宽高 [宽,高]
                widget_margins: [2, 2],    //模块的间距 [上下,左右]
                max_cols:max_cols,
                draggable : {handle : '.j-header-draggable'},
                resize:{enabled: true}
            });
        }
        var StaticTicker = 0;
        function controlAddInit(fun) {
            $(".j-control-add").click(fun);
        }
        function controlAddFun() {
            var newWidgetHeaderDel;
            var newWidget;
            var $this = $(this);
            var isGridster = parseInt($this.attr("data-j-isgridster"));
            var sizeX = parseInt($this.attr("data-j-sizex"));
            var sizeY = parseInt($this.attr("data-j-sizey"));
            var controlId = parseInt($this.attr("data-j-controlid"));
            var controlhtml = $this.find("div").html();
            var gridsterSelect = $(".gridster-select").data('gridster');

            if(isGridster == 0){//非可拖动框的控件
                newWidget = gridsterSelect.add_widget("<div class='j-warpper'>" +
                "<div class='j-header'><div class='j-header-draggable'>+</div><div class='j-header-del'>X</div></div>" + controlhtml + "</div>", sizeX, sizeY);

                newWidget.attr("data-j-controlid", controlId);
                newWidget.attr("data-uniqueid", ++StaticTicker);
                newWidgetHeaderDel = newWidget.find(".j-header-del");
                newWidgetHeaderDel.attr("data-id", StaticTicker);
                newWidgetHeaderDel.click(function(){
                    var $this = $(this);
                    var id = $this.attr("data-id");
                    gridsterSelect.remove_widget(newWidget.get(0));
                    newWidget = null;
//                    gridster.remove_widget($("div[data-uniqueid='" + id + "']").get(0));
                });
            }
            else{//可拖动框的控件
                newWidget = gridsterSelect.add_widget("<div class='j-warpper' data-isgridster='1'>" +
                "<div class='j-header'><div class='j-header-draggable'>+</div><div class='j-header-del'>X</div></div>" + controlhtml + "</div>", sizeX, sizeY);

                newWidget.gridster({    //通过jquery选择DOM实现gridster
                    widget_selector: 'div.j-warpper',
                    widget_base_dimensions: [50, 50],    //模块的宽高 [宽,高]
                    widget_margins: [5, 5],    //模块的间距 [上下,左右]
                    draggable : {handle : '.j-header-draggable'},
                    resize:{enabled: true}
                });

                newWidget.attr("data-j-controlid", controlId);
                newWidget.attr("data-uniqueid", ++StaticTicker);
                newWidgetHeaderDel = newWidget.find(".j-header-del");
                newWidgetHeaderDel.attr("data-id", StaticTicker);
                newWidgetHeaderDel.click(function(){
                    var $this = $(this);
                    var id = $this.attr("data-id");
                    gridsterSelect.remove_widget(newWidget.get(0));
                    newWidget = null;
//                    gridster.remove_widget($("div[data-uniqueid='" + id + "']").get(0));
                });
            }
        }
        function gridsterReMark(){
            var $gridsters = $("[data-isgridster='1']");
            var gridsterLen = $gridsters.length;
            for(var i = 0; i < gridsterLen; i++){
                $gridsters.eq(i).attr("data-gridster-index", i);
            }
            return $gridsters;
        }
        function buttonBind(){
            $("#choButton").click(function(){
                var gridsters = gridsterReMark();
                if(gridsters.length < 1) return;
                if(gridsters.length == 1) {
                    $("#editDiv").addClass("gridster-select");
                    return;
                }

                var $gselect = $(".gridster-select");
                var nowIndex = parseInt($gselect.attr("data-gridster-index"));
                $gselect.removeClass("gridster-select");

                if(++nowIndex == gridsters.length){
                    nowIndex = 0;
                }

                $("[data-gridster-index='" + nowIndex + "']").addClass("gridster-select");
            });
        }
        $(function () {
            //拖动控件初始化
            gridsterInit();
            //侧边栏控件初始化
            menuGroupInit();
            //元素生成控件初始化
            controlAddInit(controlAddFun);
            //绑定页面按钮
            buttonBind();
        });
    </script>
    <style>
        .gridster {
            border: 1px solid #000000;
        }

        .menu-group {
            background-color: antiquewhite
        }

        .menu-group-head {
            background-color: #9cc9e0;
            cursor: pointer;
        }

        .j-control-add {
            cursor: pointer;
        }

        .gridster .preview-holder {
            border: none;
            background: #ff4172;
        }
        .j-warpper{
        }
        .j-header{
            position: absolute;
            right: 0;
            z-index: 20;
            opacity: 0.2;
        }
        .j-header:hover{
            opacity: 1;
        }
        .j-header-draggable{
            float: left;
            cursor: move;
        }
        .j-header-del{
            float: left;
            cursor: pointer;
        }
        .j-warpper, .j-header, .j-header-draggable,.j-header-del {
            border: 1px solid #000000;
        }
        .gridster-select{
            border: 1px solid #ff0000;
        }
        .j-window-head{
            background-color: #000000;
            color: #ffffff;
            width: 100%;
            height: 32px;
            white-space: nowrap;
        }
        .j-window-head > *{
            font-size: 20px;
            cursor: default;
            vertical-align: middle;
        }
        .j-btn-default{
            padding: 5px 10px 5px 10px;
            background-color: #03e0b6;
            font-size: 16px;
            font-weight:bold;
            border: 0;
        }
        .j-btn-default:hover{
            opacity: 0.9;
        }
        .j-window-left{
            background-color: rgb(204, 204, 204);
            position: absolute;
            width: 120px;
            height: 100%;
            bottom:0;
        }
        .j-window-middle{
            background-color: rgba(204, 204, 204, 0.17);
            position: absolute;
            top: 0;
            left: 120px;
            right: 0;
            bottom:0;
        }
        .j-window-body{
            position: absolute;
            top: 32px;
            bottom: 0;
            width: 100%;
            padding: 0;
        }
        .j-window-body tr,td{
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="j-window-head">
    <span class="fa fa-sellsy"></span><span>可视化布局</span>
    <input class="j-btn-default" type="button" value="编辑"><input class="j-btn-default" type="button" value="布局编辑"><input class="j-btn-default" type="button" value="预览">
    <input class="j-btn-default" type="button" value="下载"><input class="j-btn-default" type="button" value="保存"><input class="j-btn-default" type="button" value="清空">
</div>
<div class="j-window-body">
    <div class="j-window-left">
        <div class="menu-group">
            <div class="menu-group-head" data-turnon="True">
                视图列表
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
                <?php foreach ($htmlcontrolsGroup as $htmlcontrolsGroupVal) { ?>
                    <div class="menu-group">
                        <div class="menu-group-head" data-turnon="<?= $htmlcontrolsGroupVal['isturnon'] == '1'? 'True':'False' ?>">
                            <?= $htmlcontrolsGroupVal['controlgroupname'] ?>
                        </div>
                        <?php foreach ($htmlcontrolsDtl as $htmlcontrolsVal) {
                            if ($htmlcontrolsGroupVal['controlgroupname'] == $htmlcontrolsVal['controlgroupname']) {
                                ?>
                                <div class="j-control-add" data-j-controlid="<?= $htmlcontrolsVal['id'] ?>"
                                     data-j-sizex="<?= $htmlcontrolsVal['sizex'] ?>" data-j-sizey="<?= $htmlcontrolsVal['sizey'] ?>"
                                     data-j-isgridster="<?= $htmlcontrolsVal['isgridster'] ?>">
                                    <?= $htmlcontrolsVal['controlname'] ?>
                                    <div style="display: none;">
                                        <?= $htmlcontrolsVal['controlhtml'] ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                <?php } ?>
            </div>
            <div>
                <input id="choButton" type="button" value="切换布局框"/>
            </div>
        </div>
    </div>
    <div id="editDiv" class="j-window-middle gridster gridster-select" data-isgridster='1'>
    </div>
</div>
<!--<div class="container">-->
<!--    <div class="gridster">-->
<!--        <div data-row="1" data-col="8" data-sizex="1" data-sizey="3">-->
<!--            --><?php //print_r($viewObj->getTemplate(Route::$view)); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
</body>
