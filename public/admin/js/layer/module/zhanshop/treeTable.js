layui.define(['treeTable', 'zhanshopTableEvent', 'zhanshopDataFormat', 'dropdown'], function (exports) {
    var zhanshopTable = layui.zhanshop.table;
    var zhanshop = layui.zhanshop;
    var table = layui.treeTable;
    var dropdown = layui.dropdown;
    var util = layui.util;
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
            //rowToolbar: zhanshopTable.rowbar, // 行级菜单
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
            tree: {
                customName: zhanshopTable.treeCustomName,
                view: {
                    icon: '',
                },
                // 异步加载子节点
                async: {
                    enable: true,
                    url: zhanshopTable.url, // 此处为静态模拟数据，实际使用时需换成真实接口
                    autoParam: [zhanshopTable.treeCustomName.pid+'='+zhanshopTable.treeCustomName.id],
                    where: {
                        '_method': 'get'
                    },
                    method: 'post',
                    headers: headers,
                },
            },
            contentType: 'application/json',
            page: {
                groups : 5,
                first : false,
                last : false,
                limits : [100,200,500,1000],
                layout: ['prev', 'page', 'next', 'limit', 'count']
            },
            done: function(){
            }
            ,error: function(err, res){
                if(err.readyState < 4){
                    alert('网络异常,请刷新重新加载');
                    window.location.reload();
                }
                layui.zhanshop.alert('接口出错'+(xhr.responseJSON.msg ? xhr.responseJSON.msg : xhr.statusText), 'danger');
                console.log(err);
            }
            ,parseData: function(res){
                // 处理数据
                var data = res.data.list;
                data = layui.zhanshopDataFormat.onHandle(data, zhanshopTable.schma);
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

        table.on('rowContextmenu('+zhanshopTable.elem.replace('#','')+')', function(obj){
            zhanshop.table.rowObj = obj;
            rowObj = obj;
            dropdown.render({
                trigger: 'contextmenu',
                show: true,
                data: zhanshopTable.rowbar,
                click: function(menuData, othis) {
                    layui.zhanshopTableEvent.rowClick(menuData); // 点击行级菜单
                }
            });
            obj.setRowChecked({selectedStyle: true}); // 标注行选中状态样式

            window.event.preventDefault()
        });
        // layui表格头事件
        table.on('toolbar('+zhanshopTable.elem.replace('#','')+')', function(obj){
            if(obj.event == 'reload'){
                return window.location.reload();
            }
            zhanshopTable.listObj = table.checkStatus(zhanshopTable.elem.replace('#',''));
            obj = $(this).data('config');
            layui.zhanshopTableEvent.headClick(obj);
        });

        document.onclick = function(){
            $("#contextmenu").css('display', 'none');
        }

        zhanshopTable.table = table;

    }

    zhanshopTable.laycols = function (cols) {
        var data = {
            field: cols.field,
            title: cols.title,
            width: cols.width,
            sort: cols.sort
        };

        if(cols.fieldTitle != undefined) data['fieldTitle'] = cols.fieldTitle;
        if(cols.minWidth != undefined) data['minWidth'] = cols.minWidth;
        if(cols.maxWidth != undefined) data['maxWidth'] = cols.maxWidth;
        if(in_array(cols.type, ['normal', 'checkbox', 'radio', 'numbers', 'space'])){
            data['type'] = cols.type;
        }
        if(in_array(cols.fixed, ['left', 'right'])){
            data['fixed'] = cols.fixed;
        }
        if(cols.templet != undefined) data['templet'] = '<div>'+cols.templet+'</div>';
        if(cols.exportTemplet != undefined) data['exportTemplet'] = cols.exportTemplet;
        if(cols.totalRow != undefined) data['totalRow'] = cols.totalRow;
        if(cols.edit != undefined) data['edit'] = cols.edit;
        if(cols.hide != undefined) data['hide'] = cols.hide;
        if(cols.escape != undefined) data['escape'] = cols.escape;
        if(cols.unresize != undefined) data['unresize'] = cols.unresize;
        if(cols.event != undefined) data['event'] = cols.event;
        if(cols.style != undefined) data['style'] = cols.style;
        if(cols.align != undefined) data['align'] = cols.align;

        if(cols.colspan != undefined) data['colspan'] = cols.colspan;
        if(cols.rowspan != undefined) data['rowspan'] = cols.rowspan;
        return data;
    }

    // 行右击菜单事件
    $(document).on('click','.row-event', function() {
        layui.zhanshopTableEvent.rowClick(this);
    });

    window.laysearch = function(obj){
        where = {'_method': 'GET'};
        where['search'] = [];
        if(tabWhere) where['search'].push(tabWhere);
        if(layui.zhanshopTreeTable.idName == obj.field.value){
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
        layui.zhanshop.iframe('高级搜索', layui.zhanshopTreeTable.searchPage+'?_id='+layui.zhanshop.getParam('_id')+'&t='+(new Date().getTime()), 'layui-layer-molv', 'r', ['60%', '98%']);
    }
    exports('zhanshopTreeTable', zhanshopTable);//导出
});