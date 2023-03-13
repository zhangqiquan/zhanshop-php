layui.define(['zhanshop','table', 'zhanshopTableEvent', 'zhanshopDataFormat'], function (exports) {
    var zhanshopTable = layui.zhanshop.table;
    var zhanshop = layui.zhanshop;
    var table = layui.table;
    window.rowObj = null;// 当前操作的表格行
    where = {'_method': 'GET'};
    zhanshopTable.render = function(schma, single = false){
        var headers = {};
        headers['token'] = layui.zhanshop.getcookie('token');
        var gets = layui.zhanshop.getParam();
        delete gets['_id'];
        delete gets['select'];
        delete gets['domid'];
        if(single == false){
            for(var i in gets){
                where[i] = gets[i];
            }
        }

        table.render({
            title: zhanshopTable.title,
            even: zhanshopTable.even,
            height: zhanshopTable.height,
            elem: zhanshopTable.elem,
            toolbar: zhanshopTable.toolbar,
            defaultToolbar: zhanshopTable.defaultToolbar,
            skin: zhanshopTable.skin,
            size: zhanshopTable.size,
            even: zhanshopTable.even,
            width: zhanshopTable.width,
            css: zhanshopTable.css,
            limit: zhanshopTable.limit,
            limits: zhanshopTable.limits,
            lineStyle: zhanshopTable.lineStyle,
            cellMinWidth: zhanshopTable.cellMinWidth
            ,cols: [schma],
            url: zhanshopTable.url, //数据接口
            method: 'POST',
            where: where,
            headers: headers,
            page: {
                groups : 5,
                first : false,
                last : false,
                limits : [10,20,50,100,300,500,1000],
                layout: ['prev', 'page', 'next', 'limit', 'count']
            },
            done: function(){
                $('tr').contextmenu(function(e) {
                    $(this).click();
                    e.preventDefault() // 阻止右键菜单默认行为
                    $("#contextmenu").css({"display":"","left":e.originalEvent.pageX,"top":e.originalEvent.pageY});
                })
        }
        ,error: function(err, res){
                if(err.readyState < 4){
                    alert('网络异常,请刷新重新加载');
                    window.location.reload();
                }
                layui.zhanshop.alert('接口出错'+err.responseText, 'danger');
                console.log(err);
            }
        ,parseData: function(res){
                // 处理数据
                var data = res.data.data;
                data = layui.zhanshopDataFormat.onHandle(data, layui.zhanshopTable.schma);
                return {
                    "code": res.code, //解析接口状态
                    "msg": res.msg, //解析提示文本
                    "count": res.data.total, //解析数据长度
                    "data": data //解析数据列表
                };
            }
        });

        // 行级事件
        table.on('row('+zhanshopTable.elem.replace('#','')+')', function(obj){
            zhanshop.table.rowObj = obj;
        });

        table.on('sort('+zhanshopTable.elem.replace('#','')+')', function(obj){
            $('tr').contextmenu(function(e) {
                $(this).click();
                e.preventDefault() // 阻止右键菜单默认行为
                $("#contextmenu").css({"display":"","left":e.originalEvent.pageX,"top":e.originalEvent.pageY});
            })
        });
        // layui表格头事件
        table.on('toolbar('+zhanshopTable.elem.replace('#','')+')', function(obj){
            if(obj.event == 'reload'){
                return window.location.reload();
            }
            zhanshopTable.listObj = table.checkStatus(zhanshopTable.elem.replace('#',''));
            layui.zhanshopTableEvent.headClick(this);
        });

        document.onclick = function(){
            $("#contextmenu").css('display', 'none');
        }

        zhanshopTable.table = table;

    }

    // 行右击菜单事件
    $(document).on('click','.row-event', function() {
        layui.zhanshopTableEvent.rowClick(this);
    });
    
    window.laysearch = function(obj){
        where = {'_method': 'GET'};
        where['search'] = [];
        if(tabWhere) where['search'].push(tabWhere);
        if(layui.zhanshopTable.idName == obj.field.value){
            if(obj.keyword.value){
                where['search'].push([obj.field.value, '=',obj.keyword.value]);
            }
        }else{
            where['search'].push([obj.field.value, 'like',obj.keyword.value]);
        }
        zhanshopTable.render(colsData, true);
        return false;
    }

    window.tabsLink = function (obj) {
        var tabWhereData = $(obj).data("where");
        tabWhereData = tabWhereData.split(',');
        where = {'_method': 'GET'};

        where['search'] = [];

        if(tabWhereData.length == 3 && tabWhereData[0] && tabWhereData[1] && tabWhereData[2]){
            tabWhere = tabWhereData;
            where['search'].push(tabWhereData);
        }else{
            tabWhere = [];
            where['search'].push([]);
        }
        zhanshopTable.render(colsData, true);
        return false;
    }

    window.advancedSearch = function(){
        layui.zhanshop.iframe('高级搜索', layui.zhanshopTable.searchPage+'?_id='+layui.zhanshop.getParam('_id'), 'layui-layer-molv', 'r', ['60%', '98%']);
    }
    exports('zhanshopTable', zhanshopTable);//导出
});