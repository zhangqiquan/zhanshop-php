layui.define(['zhanshop'], function (exports) {
    var tableEvent = {
        headClick: function(obj){
            window.idName = layui.zhanshop.table.idName;
            window.listData = layui.zhanshop.table.listObj.data;
            //window.menuObj = obj;
            var event = obj.event;
            this[event].call(this, obj);
        },
        rowClick: function(obj){
            console.log(obj);
            window.idName = layui.zhanshop.table.idName;
            window.rowData = layui.zhanshop.table.rowObj.data;
            var event = obj.event;
            this[event].call(this, obj);
        },
        add: function(obj){
            if(obj.target == '_self'){
                window.location = obj.page+'?t='+(Date.parse(new Date()) / 1000);
            }else{
                layui.zhanshop.iframe(obj.title, obj.page+'?t='+(Date.parse(new Date()) / 1000));
            }
        },
        edit: function(obj){
            layui.zhanshop.iframe(obj.title, obj.page+'?'+idName+'='+rowData[idName]+'?t='+(Date.parse(new Date()) / 1000));
        },
        delete: function(obj){
            var req = {
                '_method':'DELETE',
            };
            var push = [];
            push.push(rowData[idName]);
            req['pk'] = push;
            layui.zhanshop.confirm('确定要删除当前行么?', function(){
                layui.zhanshop.ajax(layui.zhanshop.table.url, 'POST', req, {}, function(data){
                    layui.zhanshop.table.rowObj.del();
                    // 删除当前行
                }, function(xhr){
                    layui.zhanshop.alert(xhr.responseText, 'danger');
                });
            });

        },
        // 删除所有
        deletes: function(obj){
            var req = {
                '_method':'DELETE',
            };
            var push = [];
            for(var i in listData){
                push.push(listData[i][idName]);
            }
            req['pk'] = push;
            if(push.length == 0) return layui.zhanshop.alert('请选择需要删除的行', 'danger');
            layui.zhanshop.confirm('确定要删除选中行么?', function(){
                layui.zhanshop.ajax(layui.zhanshop.table.url, 'POST', req, {}, function(data){
                    var number = 0;
                    $(".layui-table tr td").each(function(i){
                        if($(this).data('field') == idName){
                            number++;
                            if(in_array( this.innerText, push )){
                                number--;
                                $(this).parent().remove();
                            }
                        }
                    });
                    // 删除完了需要触发一次刷新啊
                    if(number <= 0){
                        return window.location.reload();
                    }
                    // 删除当前行
                }, function(xhr){
                    layui.zhanshop.alert(xhr.responseJSON.msg ? xhr.responseJSON.msg : xhr.statusText, 'danger');
                });
            });
        },
        ajax: function(obj){
            var req = {
                '_method': obj.method,
            };
            req[idName] = rowData[idName];
            layui.zhanshop.ajax(layui.zhanshop.table.url, 'POST', req, {}, function(data){

            }, function(xhr){
                layui.zhanshop.alert(xhr.responseJSON.msg ? xhr.responseJSON.msg : xhr.statusText, 'danger');
            });
        },
        open: function(obj){
            layui.zhanshop.iframe(obj.title, obj.page+'?t='+(Date.parse(new Date()) / 1000));
        },
        submit: function(obj){
            this.ajax(obj);
        },
        source: function(obj){
            return layer.alert(JSON.stringify(rowData))
        }
    };
    exports('zhanshopTableEvent', tableEvent);//导出
});