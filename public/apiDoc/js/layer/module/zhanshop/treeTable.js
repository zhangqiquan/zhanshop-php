layui.define(['zhanshop', 'treeTable', 'zhanshopTableEvent', 'zhanshopDataFormat'], function (exports) {
    var TreeTable = layui.zhanshop.table;
    var zhanshop = layui.zhanshop;
    window.rowObj = null;// 当前操作的表格行
    TreeTable.render = function(schma){
        var table = layui.treeTable.render({
            title: TreeTable.title,
            even: TreeTable.even,
            height: TreeTable.height,
            elem: TreeTable.elem,
            toolbar: TreeTable.toolbar,
            defaultToolbar: TreeTable.defaultToolbar,
            skin: TreeTable.skin,
            size: TreeTable.size,
            width: TreeTable.width,
            css: TreeTable.css,
            lineStyle: TreeTable.lineStyle,
            cellMinWidth: TreeTable.cellMinWidth,
            tree: {
                iconIndex: 2,
                isPidData: true,
                idName: TreeTable.idName,
                pidName: TreeTable.pidName,
                arrowType: 'arrow2',
                getIcon: 'ew-tree-icon-style2'
            },
            cols: [schma],
            reqData: function (data, callback) {  // 懒加载也可以用url方式，这里用reqData方式演示
                setTimeout(function () {  // 故意延迟一下
                    var url = TreeTable.url;
                    var reqData = {'_method': 'GET', 'page': 1, 'limit': 30000};
                    reqData['search']= [[TreeTable.pidName, '=', 0]];
                    if(data != undefined && data[TreeTable.idName]){
                        reqData['search']= [[TreeTable.pidName, '=', data[TreeTable.idName]]];
                    }
                    zhanshop.ajax(url, 'POST', reqData, {}, function(res){
                        var data = res.data.data;
                        data = layui.zhanshopDataFormat.onHandle(data, TreeTable.schma);
                        callback(data);
                    }, function (xhr){
                        zhanshop.alert(xhr.responseText, 'danger');
                    },false);
                }, 50);
            },
            done: function(){
                //if(callback != undefined) callback();
                $('tr').contextmenu(function(e) {
                    $(this).click();
                    e.preventDefault() // 阻止右键菜单默认行为
                    $("#contextmenu").css({"display":"","left":e.originalEvent.pageX,"top":e.originalEvent.pageY});
                })
            },
            style: 'margin-top:0;'
        });
        TreeTable.table = table;

        document.onclick = function(){
            $("#contextmenu").css('display', 'none');
        }
        // 监听表格菜单事件
        $(document).on('click', '.row-event', function() {
            layui.zhanshopTableEvent.rowClick(this);
        });

        // 监听行单击事件
        layui.treeTable.on('row('+TreeTable.elem.replace('#','')+')', function(obj){
            zhanshop.table.rowObj = obj;
        });

        // 监听列事件
        layui.treeTable.on('toolbar('+TreeTable.elem.replace('#','')+')', function(obj){
            if(obj.event == 'reload'){
                return window.location.reload();
            }
            zhanshop.table.listObj = zhanshop.table.table.checkStatus();
            layui.zhanshopTableEvent.headClick(this);
        });
    }
    exports('zhanshopTreeTable', TreeTable);//导出
});