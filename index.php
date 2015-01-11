<?php require_once './jfun.php'; ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="./source/css/public.css" rel="stylesheet">
    <script type="text/javascript" src="./source/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="./source/js/jquery.form.js"></script>
    <script type="text/javascript" src="./source/js/public.js"></script>
    <script>
        function copyRow(tBody, addRow) {
            for (var i = 0; i < addRow; i++) {
                var $tBody = $("#" + tBody);
                /* 取出容器下第一行tr 复制至新对象*/
                var tr = $tBody.find("tr").eq(0).clone(true);
                /* 获取复制行内 有id属性的所有对象*/
                var target = tr.find("[id]");
                /* 获取容器下tr的总行数 构造最后一行的数字代号*/
                var trLength = parseFloat($tBody.find("tr").length);
                /* 遍历所有带id的对象 修改其id及name属性*/
                $.each(target, function () {
                    var id = $(this).attr("id").replace("@", trLength);
                    var name = $(this).attr("name").replace("@", '[' + trLength + ']');
                    $(this).attr("id", id);
                    $(this).attr("name", name)
                });
                /* 第一行默认的显示模式为none 修改为显示模式的table-row-group*/
                tr.css("display", "table-row");
                /* 向容器追加复制的行*/
                $tBody.append(tr);
            }
        }
        function openPageDiv() {
            $("div.PageDiv").show();
        }
        function closePageDiv() {
            $("div.PageDiv").hide();
        }
        function formSubmit() {
            $("#form1").ajaxSubmit({
                url: "./post.php?act=addModel",
                success: function (msg) {
                    if (msg == "OK") {
                        alert("success");
                        location.href = "./";
                    }
                    else {
                        alert(msg);
                    }
                }
            });
            return false;
        }
        $(function () {
            copyRow('fromBody', 1);
        });
    </script>
    <style>
        .PageDiv {
            display: none;
        }
    </style>
</head>
<body>
<div class="PageDiv" style="position:absolute; top:0;left:0;right:0;bottom:0; background-color: #000000; opacity:0.3;"
     onclick="closePageDiv()"></div>
<div class="PageDiv"
     style="position:absolute; top:10%;left:10%;right:10%;bottom:10%;z-index:30;background-color: #ffffff; padding: 5px; overflow: auto;">
    <form id="form1" method="post">
        <div style="text-align: center;">
            <label for="modelName">modelName:</label><input id="modelName" name="modelName" type="text"/>
        </div>
        <table style="width:100%; border: 1px solid #000000;text-align: center;">
            <tr>
                <td>Name</td>
                <td>Type</td>
                <td>DefaultValue</td>
                <td></td>
            </tr>
            <tbody id="fromBody">
            <tr style="display:none;">
                <td><input id="formName@" name="formName@" type="text"/></td>
                <td>
                    <select id="formType@" name="formType@">
                        <option value="int">Int(20)</option>
                        <option value="varchar1">Varchar(100)</option>
                        <option value="varchar2">Varchar(4000)</option>
                        <option value="text">Text</option>
                        <option value="date">Date</option>
                    </select>
                </td>
                <td>
                    <input id="formDefaultValue@" name="formDefaultValue@" type="text"/>
                </td>
                <td><input type="button" value="+" onclick="copyRow('fromBody', 1)"/></td>
            </tr>
            </tbody>
            <tr>
                <td></td>
            </tr>
        </table>
        <div style="text-align: center;">
            <input type="button" onclick="formSubmit()" value="submit" style="min-width: 30%;">
        </div>
    </form>
</div>
<div style="float: left; border: 1px solid #000000;">
    <table>
        <tr>
            <td>
                modelName
            </td>
        </tr>
        <?php
        $allModelName = Model_Manager::nullModel()->getAllModelName();
        foreach ($allModelName as $value) { ?>
            <tr>
                <td>
                    <a href="./?model=<?= $value; ?>"><?= $value; ?></a>
                </td>
                <td style="text-align: right;"><input type="button" value="X"></td>
            </tr>
        <?php } ?>
        <tr>
            <td>
                <input type="button" value="add model" onclick="openPageDiv()"/>
            </td>
        </tr>
    </table>
</div>
<div style="float: left; border: 1px solid #000000;">
    <?php
    if (!is_null($_REQUEST["model"])) {
        $model = Model_Manager::create($_REQUEST["model"]);
        $modelCol = $model->getCol();
        $modelDtl = $model->getAll();
        ?>
        <table>
            <tr>
                <td colspan="30">
                    modelDetail
                </td>
            </tr>
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
    <?php } ?>
</div>
</body>
