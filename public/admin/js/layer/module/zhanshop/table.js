layui.define(['zhanshop','table', 'zhanshopTableEvent', 'zhanshopDataFormat', 'dropdown'], function (exports) {
    var zhanshopTable = layui.zhanshop.table; // 获取基类 下面进行重写
    var zhanshop = layui.zhanshop;
    var table = layui.table;
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
            contentType: 'application/json',
            page: zhanshopTable.page,
            done: function(){
            }
            ,error: function(err, res){
                if(err.readyState < 4){
                    alert('网络异常,请刷新重新加载');
                    window.location.reload();
                }
                layui.zhanshop.alert(xhr.responseJSON.msg ? xhr.responseJSON.msg : xhr.statusText, 'danger');
                console.log(err);
            }
            ,parseData: function(res){
                // 处理数据
                var data = res.data.list;
                window.apiSourceData = data;
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

        table.on('rowContextmenu('+zhanshopTable.elem.replace('#','')+')', function(obj){
            zhanshop.table.rowObj = obj;
            var rowbars = zhanshopTable.rowbar;
            var showMenus = [];
            for(var i in rowbars){
                var rowbar = rowbars[i];
                var show = true;
                if(rowbar.condition){
                    if(rowbar.condition){
                        var conditions = json_decode(rowbar.condition);
                        for(var ii in conditions){
                            var condition = conditions[ii];
                            try{
                                var evalStr = "show = ('"+obj.data[condition[0]] + "' "+condition[1]+' "'+condition[2]+'");';
                                eval(evalStr);
                                if(show == false){
                                    break;
                                }
                            }catch (e) {
                                //console.error(e)
                            }
                        }
                    }
                }
                if(show){
                    showMenus.push(rowbar);
                }
            }

            dropdown.render({
                trigger: 'contextmenu',
                escape: false,
                show: true,
                data: showMenus,
                click: function(menuData, othis) {
                    layui.zhanshopTableEvent.rowClick(menuData); // 点击行级菜单
                }
            });
            obj.setRowChecked({selectedStyle: true}); // 标注行选中状态样式

            window.event.preventDefault()
        });

        // table.on('sort('+zhanshopTable.elem.replace('#','')+')', function(obj){
        //     $('tr').contextmenu(function(e) {
        //         $(this).click();
        //         e.preventDefault() // 阻止右键菜单默认行为
        //         $("#contextmenu").css({"display":"","left":e.originalEvent.pageX,"top":e.originalEvent.pageY});
        //     })
        // });
        // layui表格头事件
        table.on('toolbar('+zhanshopTable.elem.replace('#','')+')', function(obj){
            if(obj.event == 'reload'){
                return window.location.reload();
            }else if(obj.event == 'data'){
                zhanshopTable.listObj = table.checkStatus(zhanshopTable.elem.replace('#',''));
                window.listData = zhanshopTable.listObj.data;
            }else{
                zhanshopTable.listObj = table.checkStatus(zhanshopTable.elem.replace('#',''));
                window.listData = zhanshopTable.listObj.data;
                obj = $(this).data('config');
                layui.zhanshopTableEvent.headClick(obj);
            }
        });

        document.onclick = function(){
            $("#contextmenu").css('display', 'none');
        }

        zhanshopTable.table = table;

    }

    zhanshopTable.export = function (schma, single = false) {
        var exportWhere = where;
        var headers = {};
        var gets = layui.zhanshop.getParam();
        delete gets['_id'];
        delete gets['select'];
        delete gets['domid'];
        if(single == false){
            for(var i in gets){
                where[i] = gets[i];
            }
        }

        var url = zhanshopTable.url;
        if(url.indexOf("?") == -1){
            url += '?_token='+layui.zhanshop.getcookie('token');
        }else{
            url += '&_token='+layui.zhanshop.getcookie('token');
        }

        // 只能加在URL中

        var form = $("<form>");
        form.attr("style","display:none");
        //form.attr("target","_blank");
        form.attr("method","post");
        form.attr("action", url);

        var input = $("<input>");
        input.attr("type","hidden");
        input.attr('name', '_method');
        input.attr("value", exportWhere._method);

        delete exportWhere['_method'];

        form.append(input);

        for(var i in exportWhere['search']){
            var row = exportWhere['search'][i];
            for(var ii in row){
                var input = $("<input>");
                input.attr("type","hidden");
                input.attr('name', 'search['+i+']['+ii+']');
                input.attr("value",row[ii]);
                form.append(input);

            }
        }

        $("body").append(form);
        form.submit();
        form.remove();
    }
    /**
     * 生成表格列字段
     * @param cols
     */
    zhanshopTable.laycols = function (cols) {
        var data = {
            field: cols.field,
            title: cols.title,
            width: cols.width,
            sort: cols.sort ? cols.sort : false
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
        layui.zhanshop.iframe('高级搜索', layui.zhanshopTable.searchPage+'?_id='+layui.zhanshop.getParam('_id')+'&t='+(new Date().getTime()), 'layui-layer-molv', 'r', ['60%', '98%']);
    }
    exports('zhanshopTable', zhanshopTable);//导出
});