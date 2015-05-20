<html>
<head>
    <title>小蚊子专用运营后台</title>
    {includeView('Admin/header')}
</head>
<body style='margin:2px 2px 0 3px;padding:0px 0px 0 0px;'>
<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'north', href:'{$top}'" style="height:60px" >

    </div>
    <div data-options="region:'west',split:true, href:'{$left}'" title="" style="width:125px;">

    </div>
    <div data-options="region:'center',border:0,iconCls:'icon-ok'" >
        <div id="contab" class="easyui-tabs" >
        </div>
    </div>
</div>
</body>

</html>
