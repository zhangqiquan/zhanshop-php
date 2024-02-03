layui.define(['laytpl'], function (exports) {
    window.$ = layui.$;
    window.laytpl=layui.laytpl;

    window.previewPic = function (obj) {
        layer.photos({
            "shade": 0.2,
            photos: {
                "title": "图片预览",
                "start": 0,
                "data": [
                    {
                        "alt": $(obj).attr('alt'),
                        "pid": $(obj).data('id'),
                        "src": obj.src,
                    }
                ]
            },
            //hideFooter: true // 是否隐藏底部栏 --- 2.8+
        });
    }

    window.previewPics = function (objs) {
        layer.photos({
            "shade": 0.2,
            photos: {
                "title": "图片预览",
                "start": 0,
                "data": objs
            },
        });
    }

    var zhanshop = {
        /**
         * 加载层
         * @param msg 加载文字
         * @param shade 遮罩透明度
         * @returns {*}
         */
        loadding : function(msg, shade = 0.5){
            return layer.msg(msg, {
                icon: 16,
                skin: 'lyear-skin-loadding'
                ,shade: shade
                ,time: false
            });
        },
        /**
         * 弹出alert信息
         * @param msg 消息内容
         * @param type 消息类型(success,info,warning,danger)
         * @param endCallback 弹窗被销毁回调函数 funtion(){}
         * @param time 自动关闭时间毫秒
         * @param shade 遮罩透明度
         * @returns {*}
         */
        alert: function(msg, type = 'info', endCallback = null, time = 3000, shade = false){
            var icon = 0;
            var anim = 1;
            var title = '信息';
            switch (type) {
                case "success":
                    icon = 1;
                    title = '成功';
                    break;
                case "warning":
                    icon = 3;
                    title = '警告';
                    time = false;
                    break;
                case "danger":
                    icon = 2;
                    time = false;
                    anim = 6;
                    title = '错误';
                    break;
            }
            return layer.alert(msg, {
                title: title,
                icon: icon,
                zIndex: 999999999,
                skin: 'lyear-skin-'+type,
                time: time,
                anim: anim,
                end: endCallback,
            });
        },
        /**
         * 询问弹窗
         * @param msg 询问信息
         * @param yesCallback 确定回调
         * @param noCallback 取消回调
         * @param btn
         */
        confirm: function(msg, yesCallback = null, noCallback = null, btn = ['确定', '取消']){
            layer.confirm(msg, {
                    icon: 3,
                    btn: btn,
                    skin: 'lyear-skin-warning',
                },
                yesCallback,
                noCallback
            );
        },
        /**
         * 小tips
         * @param msg
         * @param dom
         */
        tips: function (msg, dom) {
            layer.tips(msg, dom, {
                tips: [1, '#33cabb'],
                time: 5000
            });
        },
        /**
         * 打开一个框架页面
         * @param title 页面标题
         * @param page 页面地址
         * @param offset 坐标支持auto,r,b,l,t,lt,rt
         * @param area
         */
        iframe: function(title, page, skin = 'layui-layer-molv', offset = 'auto', area = ['98.2%', '96%']){
            layer.open({
                skin: skin,
                type: 2,
                shade: 0.3,
                title: title,
                offset:offset,
                scrollbar: true,
                area: area,
                content: page,
                anim: 2
            });
        },
        view: function(url, elem, callback, reqMethod = 'POST', data = '', head = {}){
            var view = $(elem).html();
            this.ajax(url, reqMethod, data, head, function(res){
                laytpl($(elem).html()).render(res.data, function(html){
                    $(elem).html(html);
                    //渲染成功回调
                    if(callback != undefined){
                        callback(res.data);
                    }
                });
            }, function(xhr){
                //if(xhr.status == 404) return window.location = 'about:blank';
                zhanshop.alert('页面渲染失败: '+(xhr.responseJSON.msg ? xhr.responseJSON.msg : xhr.statusText), 'danger', function(){
                    window.location.reload();
                });
            });
        },
        /**
         * 滑块 依赖jquery.sliderVerification.js
         * @param dom 元素
         * @param callback 拖动结束的回调函数function(result) {}
         * @param width
         * @param height
         */
        slider: function(dom, callback, width = 384, height = 38){
            $(dom).slider({
                width: width,                     // width
                height: height,                     // height
                sliderBg: "#f9fafb",            // 滑块背景颜色
                color: "#8b95a5",               // 文字颜色
                fontSize: 14,                   // 文字大小
                bgColor: "#15c377",             // 背景颜色
                textMsg: "按住滑块，拖拽验证",     // 提示文字
                successMsg: "验证通过了哦",       // 验证成功提示文字
                successColor: "#fff",           // 滑块验证成功提示文字颜色
                time: 400,                      // 返回时间
                callback: callback   // 回调函数，true(成功),false(失败)
            });
        },
        /**
         * 拼图滑块
         * @param dom
         * @param img
         * @param success
         * @param error
         */
        imgver: function(dom, img, successCallback, width = 260, height = 116){
            imgVer({
                el:'$("'+dom+'")',
                width:width,
                height:height,
                img:[
                    'http://lyear.itshubao.com/iframe/images/img-slide-1.jpg',
                    'http://lyear.itshubao.com/iframe/images/img-slide-2.jpg',
                    'http://lyear.itshubao.com/iframe/images/img-slide-3.jpg',
                    'http://lyear.itshubao.com/iframe/images/img-slide-4.jpg',
                    'http://lyear.itshubao.com/iframe/images/img-slide-5.jpg',
                ],
                success:function () {
                    successCallback();
                },
                error:function () {
                    //alert('错误执行')
                }
            });
        },
        /**
         * Ajax请求
         * @param url 请求地址
         * @param method 请求方法
         * @param data 请求参数
         * @param header 请求头
         * @param successCallback 成功回调
         * @param errorCallback 失败回调
         * @param load 是否显示load状态
         */
        ajax: function (url, method, data, header, successCallback, errorCallback, load = true, jsonRequest = true){
            var index;
            if(load != false){
                if(load == true) load = '正在请求后端数据...';
                index = this.loadding(load, 0.3);
            }
            //header['token'] = this.getcookie('token');
            var reqdata = data;
            var contentType = 'application/x-www-form-urlencoded;charset:utf-8';
            var dataType = '';
            if(method == 'POST' && jsonRequest){
                reqdata = JSON.stringify(data);
                contentType = 'application/json';
                dataType = 'json';
            }
            var request = $.ajax({
                url: url,
                method: method,
                timeout: 30000, // 超时时间设置，单位毫秒
                data: reqdata,
                contentType: contentType,
                dataType: dataType,
                headers: header,
            });
            request.done(function(res) {
                layer.close(index);
                return successCallback(res);
            });
            request.fail(function(jqXHR) {
                layer.close(index);
                console.error(jqXHR);
                return errorCallback(jqXHR);
            });
        },
        /**
         * 设置/删除cookie
         * @param name
         * @param value
         * @param time
         * @returns
         */
        setcookie: function(name, value, time) {
            var exp = new Date();
            if (null == value) {
                exp.setTime(0);
            } else {
                exp.setTime(exp.getTime() + time * 1000);
            }
            document.cookie = name + "=" + escape(value) + ";path=/;expires=" + exp.toGMTString();
        },
        /**
         * 获取session
         * @param name
         */
        getSesson: function (name) {
            return localStorage.getItem(name);
        },
        /**
         * 设置session
         * @param name
         * @param value
         */
        setSesson: function (name, value) {
            localStorage.setItem(name, value);
        },
        /**
         * 获取cookie
         * @param name
         * @returns
         */
        getcookie: function(name) {
            var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
            if (arr = document.cookie.match(reg)) {
                return unescape(arr[2]);
            } else {
                return null;
            }
        },
        // 数据表格
        table: {
            url: '', // 接口数据地址
            title: '表格标题', // 表格表格
            width: 'auto',
            even: false,
            css: '',
            limit: 10,
            skin: 'line',
            size: 'sm',
            limits: [10,20,50,100,200],
            page: {
                groups : 5,
                first : false,
                last : false,
                layout: ['prev', 'page', 'next', 'limit', 'count']
            },
            lineStyle: '',
            data: null,
            cellMinWidth: '60',
            height: 'full-150', // 高度
            elem: '#laytable', // 表格载体dom
            toolbar: null, // 头部左侧工具栏
            rowbar: null, // 行级菜单
            defaultToolbar: ['filter', 'print', 'exports',{
                title: '刷新页面'
                ,layEvent: 'reload'
                ,icon: 'layui-icon-refresh'
            }], // 表格头右侧默认工具栏
            table: null, // 表格对象
            rowObj: null, // 当前操作行
            listObj: null,
            listData: null, // 当前操作的列数据
            idName: null,
            titleName: null,
            pidName: null,
            searchPage: null,
            treeCustomName: {
                'id': 'id',
                'name': 'title',
                'pid': 'parent_id',
                'isParent': 'is_parent',
                'children': 'children',
            },
            search: function(){
                console.log(111);
            },
            render: function(){
            },
            laycols: function(cols){
            },
            formatData: function(){
            },
            headerToolbar: function(){
            },
            rowToolbar: function(){
            }
        },
        /**
         * 获取get参数
         * @param key
         * @returns {{}|*}
         */
        getParam: function(key = null){
            var url = window.document.location.href.toString(); //当前完整url
            var u = url.split("?"); //以？为分隔符把url转换成字符串数组
            try {
                if (typeof(u[1]) == "string") {
                    u = u[1].split("&"); //同上
                    var get = {};
                    for (var i in u) {
                        var j = u[i].split("="); //同上
                        get[j[0]] = j[1];
                    }
                    if(key){
                        var val = get[key] ? get[key] : '';
                        if(val) val = decodeURI(val);
                        return val;
                    }
                    return get;
                } else {
                    return {};
                }
            }catch (e) {
                return {};
            }
        },
        /**
         * url解析get参数
         * @param str
         * @returns {{}|*|string}
         */
        parseStr: function (str) {
            var u = str.split("?"); //以？为分隔符把url转换成字符串数组
            try {
                if (typeof(u[1]) == "string") {
                    u = u[1].split("&"); //同上
                    var get = {};
                    for (var i in u) {
                        var j = u[i].split("="); //同上
                        get[j[0]] = j[1];
                    }
                    return get;
                } else {
                    return {};
                }
            }catch (e) {
                return {};
            }
        }

    };
    exports('zhanshop', zhanshop);//导出
});