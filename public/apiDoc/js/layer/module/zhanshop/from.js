layui.define(['zhanshop', 'laydate', 'inputTag', 'layCascader', 'xmSelect'], function (exports) {

    var from = {
        currentInputId : null,
        onStep: function(){
            var element = layui.element;
            if($('#layui-tab-ul').find('li').length == 1){
                document.getElementById("submitButton").style.display = '';
            }
            element.on('tab(docDemoTabBrief)', function() {
                if($('#layui-tab-ul').find('li').length == 1) return ;
                if ($(this).data("index") > 0 && $(this).data("index") < $(this).find(
                    ".layui-tab-ul li").length - 1) {
                    document.getElementById("upButton").style.display = '';
                    document.getElementById("nextButton").style.display = '';
                    document.getElementById("submitButton").style.display = 'none';
                } else if ($(this).data("index") == 0) {
                    document.getElementById("upButton").style.display = 'none';
                    //if(parent.layui.finder.fieldsMenu.structure1 != ''){
                    document.getElementById("nextButton").style.display = '';
                    document.getElementById("submitButton").style.display = 'none';
                    //}
                } else if ($(this).data("index") <= $(this).find(
                    ".layui-tab-ul li").length - 1) {
                    document.getElementById("upButton").style.display = '';
                    document.getElementById("nextButton").style.display = 'none';
                    document.getElementById("submitButton").style.display = '';
                }
            });
            $('#upButton').click(function(){
                //获取当前
                var li = document.getElementById("layui-tab-ul").getElementsByTagName('li');
                for(i in li){
                    if(li[i].className == 'layui-this'){
                        var index= parseInt(li[i].getAttribute('data-index'));
                        index--;
                        document.getElementById("submitButton").style.display='none';
                        if(index <= 0){
                            //把上一步隐藏 把确认异常
                            document.getElementById("upButton").style.display='none';
                        }

                        if(index > 0){
                            document.getElementById("upButton").style.display='';
                            document.getElementById("nextButton").style.display='';//把下一步隐藏
                        }
                        document.getElementById("layertab"+index).click();
                        break;
                    }
                }
            });
            $('#nextButton').click(function(){
                //获取当前
                var li = document.getElementById("layui-tab-ul").getElementsByTagName('li');
                for(i in li){
                    if(li[i].className == 'layui-this'){
                        //下一步需要做的就是验证当前
                        var index = parseInt(li[i].getAttribute('data-index'));
                        index ++;
                        if(index > 0){
                            document.getElementById("upButton").style.display='';//把上一步显示出来
                        }
                        if(index >= li.length - 1){
                            document.getElementById("submitButton").style.display='';//把确认显示出来
                            document.getElementById("nextButton").style.display='none';//把下一步隐藏
                        }
                        document.getElementById("layertab"+index).click();
                        break;
                    }
                }
            });
        },
        searchhandle: function(data, callback){
            var submitData = data;
            var searchData = [];
            for(var i in submitData) {
                if(submitData[i] == ""){
                    delete submitData[i];
                }else{
                    var viewData = schmas[i];
                    var field = i;
                    if (in_array(viewData.input_type, ['date', 'time', 'timerange']) && viewData.type == 'int') {
                        var arr = submitData[i].split(',');
                        var arr0 = arr[0].trim();
                        var arr1 = arr[1].trim();
                        if(arr0 && arr1){
                             var date = new Date(arr0);
                             var time1 = date.getTime();
                             val = time1 / 1000;
                            submitData[field] = val+',';
                            var date = new Date(arr1);
                            var time1 = date.getTime();
                            val = time1 / 1000;
                            submitData[field] += val;
                            searchData.push([field, "between", submitData[i]]);
                        }
                    }else{
                        searchData.push([field, "like", submitData[i]]);
                    }

                }
            }
            callback(searchData);
        },
        // 表单验证
        verification: function(data, callback){
            var submitData = data;
            for(var i in submitData) {
                var row = i;
                var rows = row.split("[");
                var tableName = rows[0];
                var index = null;
                var field = rows[1].split("]")[0];
                var viewData = null;
                for(var ii in schmas){
                    var schma = schmas[ii];
                    if(schma.table_name == tableName){
                        viewData = schma['schema'][field];
                        index = ii;
                    }
                }

                var val = submitData[i];
                var outField = ['create_time', 'update_time', 'delete_time'];
                try {

                    // 如果是组件并且hidden
                    if (viewData.title && val.length == 0 && viewData.null == 'no' && (viewData.key == 'pri' && viewData.input_type == 'hidden') == false && !in_array(field, outField)) {
                        layui.zhanshop.alert(viewData.title + '不能为空', 'danger');
                        $("#layertab" + index).click();
                        // {{item.table_name}}--{{v.field}}
                        $("#" + tableName +'--'+ field).focus();
                        $("#" + tableName +'--'+ field).click();
                        // 滚动条滚动起来
                        return false;
                    }

                    if (in_array(viewData.input_type, ['date', 'time']) && viewData.type == 'int') {
                        if(val == false){
                            delete submitData[tableName+'['+field+']'];
                        }else{
                            var date = new Date(val);
                            var time1 = date.getTime();
                            val = time1 / 1000;
                            submitData[tableName+'['+field+']'] = val;
                        }
                    }

                    if(viewData.input_type == 'timerange' && val){
                        var arr = val.split(',');
                        var arr0 = arr[0].trim();
                        var arr1 = arr[1].trim();
                        if(arr0 && arr1){
                            var timerange = '';
                            var date = new Date(arr0);
                            var time1 = date.getTime();
                            time1 = time1 / 1000;
                            timerange += time1+',';
                            //submitData[field] = val+',';
                            var date = new Date(arr1);
                            var time1 = date.getTime();
                            time1 = time1 / 1000;
                            timerange += time1;
                            submitData[tableName+'['+field+']'] = timerange;
                        }
                    }

                    if (viewData.input_maxlength > 0 && val.length > viewData.input_maxlength) {
                        layer.msg(viewData.title + '长度不能超过' + viewData.input_maxlength + '字符', {icon: 2, anim: 6});
                        $("#layertab" + index).click();
                        $("#" + field + index).focus();
                        return false;
                    }
                } catch (e) {
                    //console.error(e);
                }
            }
            callback();
        },
        // 支持inputDate，inputTime，inputTimerange, inputImage
        render: function(){
            if($('#layui-tab-ul').find('li').length == 1){
                $('#layui-tab-ul').css('display', 'none');
            }
            
            this.onStep();

            this.inputDate();
            this.inputTime();
            this.inputTimerange();
            this.inputImage();
            this.inputImages();
            this.inputAudio();
            this.inputAudios();
            this.inputVideo();
            this.inputVideos();
            this.inputDocument();
            this.inputDocuments();
            this.inputBaidueditor();
            this.inputTag();
            this.inputCascader();
            this.inputRadios();
            this.inputCheckboxs();
            this.inputSwitch();
        },
        // 日期输入框
        inputDate: function(){
            layui.laydate.render({
                elem: '.inputDate'
            });
        },
        // 时间输入框
        inputTime: function(){
            layui.laydate.render({
                elem: '.inputTime',
                type: 'datetime'
            });
        },
        inputTimerange: function(){
            layui.laydate.render({
                elem: '.inputTimerange', //指定元素
                type: 'datetime',
                range: ','
            });
        },
        inputImage: function(){
            // 渲染单个图片
            $('.inputImage').each(function(){
                var val = $(this).val(); // 转json
                var selfHtml = this.outerHTML;
                var original = '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><a class="add image-add" ></a></li></ul>';
                if(val){
                    selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><figure><img src="'+val+'" height="200px"><figcaption><a class="btn btn-round btn-square btn-danger inputImageDel" href="javascript:void(0)"><i class="mdi mdi-close image-delete"></i></a></figcaption></figure></li></ul>';
                }else{
                    selfHtml += original;
                }
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputImageDel', function() {
                    // 删除元素
                    var imageDom = $(this).parent().parent().parent().parent().parent();
                    $(imageDom).find('.inputImage').val('');
                    $(this).parent().parent().parent().parent().remove();
                    imageDom.html($(imageDom).find('.inputImage').prop('outerHTML') + original);
                });
                $(document).on('click', '.image-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputImage').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('图片选择器', getRootPath()+'/selector/image.html?_id=system-res-image', 'layui-layer-green');
                });
                // 给到处理方法
            });
        },
        inputImages: function(){
            // 渲染多个图片
            $('.inputImages').each(function(){
                var vals = [];
                try{
                    var vals = $(this).val() ? JSON.parse($(this).val()) : []; // 转json
                }catch (e) {
                    
                }

                var selfHtml = this.outerHTML;
                selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0">';
                if($(this).val()){
                    for(var i in vals){
                        selfHtml += '<li class="col-6 col-md-4 col-lg-2"><figure><img src="'+vals[i]+'" height="200px"><figcaption><a class="btn btn-round btn-square btn-danger inputImagesDel" href="javascript:void(0)"><i class="mdi mdi-close image-delete"></i></a></figcaption></figure></li>';
                    }
                }
                selfHtml += '<li class="col-6 col-md-4 col-lg-2"><a class="add images-add" ></a></li>';
                selfHtml += '</ul>';
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputImagesDel', function() {
                    // 删除元素
                    var inputDom = $(this).parent().parent().parent().parent().parent().find('.inputImages');
                    var inputVal = JSON.parse(inputDom.val());
                    var imgSrc = $(this).parent().parent().find('img').attr('src');
                    var valKey = inputVal.indexOf(imgSrc);
                    console.log(valKey);
                    if(valKey >= 0){
                        inputVal.splice(valKey,1);
                    }
                    inputVal = JSON.stringify(inputVal);
                    if(inputVal == '[]') inputVal = '';
                    inputDom.val(inputVal);
                    $(this).parent().parent().parent().remove();
                });
                $(document).on('click', '.images-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputImages').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('图片选择器', getRootPath()+'/selector/image.html?_id=system-res-image&multi=1', 'layui-layer-green');
                });
                // 给到处理方法
            });
        },
        inputAudio: function(){
            // 渲染单个音频
            $('.inputAudio').each(function(){
                var val = $(this).val() ? JSON.parse($(this).val()) : '';
                var selfHtml = this.outerHTML;
                var original = '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><a class="add audio-add" ></a></li></ul>';
                if(val){
                    selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><figure><div class="pictext"><span class="mdi mdi-volume-medium icotext"></span><br>'+val.original+'</div><figcaption><a class="btn btn-round btn-square btn-danger inputAudioDel" href="javascript:void(0)"><i class="mdi mdi-close audio-delete"></i></a></figcaption></figure></li></ul>';
                }else{
                    selfHtml += original;
                }
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputAudioDel', function() {
                    // 删除元素
                    var audioDom = $(this).parent().parent().parent().parent().parent();
                    $(audioDom).find('.inputAudio').val('');
                    $(this).parent().parent().parent().remove();
                    audioDom.html($(audioDom).find('.inputAudio').prop('outerHTML') + original);
                });
                $(document).on('click', '.audio-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputAudio').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('音频选择器', getRootPath()+'/selector/audio.html?_id=sys_audio', 'layui-layer-green');
                });
            });
        },
        inputAudios: function(){
            $('.inputAudios').each(function(){
                var vals = $(this).val() ? JSON.parse($(this).val()) : []; // 转json
                var selfHtml = this.outerHTML;
                selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0">';
                if($(this).val()){
                    for(var i in vals){
                        selfHtml += '<li class="col-6 col-md-4 col-lg-2"><figure><div class="pictext"><span class="mdi mdi-volume-medium icotext"></span><br>'+vals[i]['original']+'</div><figcaption><a class="btn btn-round btn-square btn-danger inputAudiosDel" data-url="'+vals[i]['url']+'" href="javascript:void(0)"><i class="mdi mdi-close audios-delete"></i></a></figcaption></figure></li>';
                    }
                }
                selfHtml += '<li class="col-6 col-md-4 col-lg-2"><a class="add audios-add" ></a></li>';
                selfHtml += '</ul>';
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputAudiosDel', function() {
                    // 删除元素
                    var inputDom = $(this).parent().parent().parent().parent().parent().find('.inputAudios');
                    var inputVal = JSON.parse(inputDom.val());
                    console.log(inputVal, $(this).data('url'));
                    // 一个数组是否在另外一个数组中不管用了 只能循环
                    for(var i in inputVal){
                        if(inputVal[i]['url'] == $(this).data('url')){
                            inputVal.splice(i,1);
                        }
                    }
                    inputVal = JSON.stringify(inputVal);
                    if(inputVal == '[]') inputVal = '';
                    inputDom.val(inputVal);
                    $(this).parent().parent().parent().remove();
                });
                $(document).on('click', '.audios-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputAudios').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('音频选择器', getRootPath()+'/selector/audio.html?_id=sys_audio&multi=1', 'layui-layer-green');
                });
                // 给到处理方法
            });
        },
        inputVideo: function(){
            $('.inputVideo').each(function(){
                var val = $(this).val() ? JSON.parse($(this).val()) : '';
                var selfHtml = this.outerHTML;
                var original = '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><a class="add video-add" ></a></li></ul>';
                if(val){
                    selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0"><li class="col-6 col-md-4 col-lg-2"><figure><div class="pictext"><span class="mdi mdi-file-video-outline icotext"></span><br>'+val.original+'</div><figcaption><a class="btn btn-round btn-square btn-danger inputVideoDel" href="javascript:void(0)"><i class="mdi mdi-close video-delete"></i></a></figcaption></figure></li></ul>';
                }else{
                    selfHtml += original;
                }
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputVideoDel', function() {
                    // 删除元素
                    var videoDom = $(this).parent().parent().parent().parent().parent();
                    $(videoDom).find('.inputVideo').val('');
                    $(this).parent().parent().parent().parent().remove();
                    videoDom.html($(videoDom).find('.inputVideo').prop('outerHTML') + original);
                });
                $(document).on('click', '.video-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputVideo').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('视频选择器', getRootPath()+'/selector/video.html?_id=sys_video', 'layui-layer-green');
                });
                // 给到处理方法
            });
        },
        inputVideos: function(){
            $('.inputVideos').each(function(){
                var vals = $(this).val() ? JSON.parse($(this).val()) : []; // 转json
                var selfHtml = this.outerHTML;
                selfHtml += '<ul class="list-inline row lyear-uploads-pic mb-0">';
                if($(this).val()){
                    for(var i in vals){
                        selfHtml += '<li class="col-6 col-md-4 col-lg-2"><figure><div class="pictext"><span class="mdi mdi-file-video-outline icotext"></span><br>'+vals[i]['original']+'</div><figcaption><a class="btn btn-round btn-square btn-danger inputVideosDel" data-url="'+vals[i]['url']+'" href="javascript:void(0)"><i class="mdi mdi-close videos-delete"></i></a></figcaption></figure></li>';
                    }
                }
                selfHtml += '<li class="col-6 col-md-4 col-lg-2"><a class="add videos-add" ></a></li>';
                selfHtml += '</ul>';
                this.outerHTML = selfHtml;
                $(document).on('click', '.inputVideosDel', function() {
                    // 删除元素
                    var inputDom = $(this).parent().parent().parent().parent().parent().find('.inputVideos');
                    var inputVal = JSON.parse(inputDom.val());
                    console.log(inputVal, $(this).data('url'));
                    // 一个数组是否在另外一个数组中不管用了 只能循环
                    for(var i in inputVal){
                        if(inputVal[i]['url'] == $(this).data('url')){
                            inputVal.splice(i,1);
                        }
                    }
                    inputVal = JSON.stringify(inputVal);
                    if(inputVal == '[]') inputVal = '';
                    inputDom.val(inputVal);
                    $(this).parent().parent().parent().remove();
                });
                $(document).on('click', '.videos-add', function() {
                    from.currentInputId = $(this).parent().parent().parent().find('.inputVideos').attr("id");
                    // 选择图片 title, page
                    layui.zhanshop.iframe('视频选择器', getRootPath()+'/selector/video.html?_id=sys_video&multi=1', 'layui-layer-green');
                });
                // 给到处理方法
            });
        },
        inputDocument: function(){
            // 渲染单个图片
        },
        inputDocuments: function(){
            // 渲染单个图片
        },
        // 渲染百度编辑器
        inputBaidueditor: function(){
            $('.inputBaidueditor').each(function(){
                UE.getEditor(this.id, {
                    autoHeightEnabled: true,
                    autoFloatEnabled: true
                });
            });
        },
        inputTag: function(){
            $('.inputTag').each(function(){
                var inputTagVal = $(this).parent().parent().find('.inputTagVal');
                var elem = '#'+this.id;
                var data = [];
                if(inputTagVal.val()) data = inputTagVal.val().split(',');

                layui.inputTag.render({
                    elem: elem,
                    data: data,//初始值
                    permanentData: [],//不允许删除的值
                    onChange: function (value) {
                        inputTagVal.val(value.join(','));
                    }
                });

            });
        },
        inputCascader: function (){
            $('.inputCascader').each(function(){
                var menuid = $(this).data('menuid');
                if(menuid == false){
                    var errorTitle = $(this).parent().parent().html() + '为确定数据来源的menuid';
                    alert(errorTitle);
                    throw errorTitle;
                }
                var thisId = this.id;
                var thisVal = parseInt(this.value);
                if(isNaN(thisVal)) thisVal = this.value;
                var prop = $(this).parent().find('.cascader-prop').html();
                if(prop) prop = JSON.parse(prop);
                if(prop == false) prop = {};
                layui.zhanshop.ajax(API_ADDRESS+'/v3.0.0/index.table?id='+parent.layui.zhanshop.getParam('_id')+'&value_menu='+menuid, 'post', {"_method":'cascader'},{}, function(res){
                    layui.layCascader({
                        elem: '#'+thisId,
                        value: thisVal,
                        options: res.data,
                        filterable: true,
                        props: prop,
                    });
                },function(xhr){
                    return layui.zhanshop.alert(xhr.responseText ? xhr.responseText : xhr.statusText, 'danger');
                });

            });
        },
        inputRadios: function(){
            $('.inputRadios').each(function(){
                var thisId = this.id;
                var menuid = $(this).data('menuid');
                if(menuid == false){
                    var errorTitle = $(this).parent().parent().html() + '为确定数据来源的menuid';
                    alert(errorTitle);
                    throw errorTitle;
                }
                var domId = this.id.replace('-div', '');

                var xmSelect = layui.xmSelect.render({
                    el: '#'+thisId,
                    radio: true,
                    paging: true,
                    pageRemote: true,
                    filterable: true,
                    max: 1,
                    theme: {
                        color: '#1cbbb4',
                    },
                    prop: {
                        name: 'title',
                        value: 'id',
                    },
                    remoteMethod: function(val, cb, show, pageIndex){
                        //val: 搜索框的内容, 不开启搜索默认为空, cb: 回调函数, show: 当前下拉框是否展开, pageIndex: 当前第几页
                        if(val == undefined) val = '';
                        layui.zhanshop.ajax(API_ADDRESS+'/v3.0.0/index.table?id='+parent.layui.zhanshop.getParam('_id')+'&value_menu='+menuid, 'POST', {"keyword":val, "page": pageIndex, "limit":10, '_method': 'xmselect'}, {}, function(res){
                            //console.log(res.data.data);
                            cb(res.data.data, Math.ceil(res.data.total / 10))
                        },function(xhr){
                            cb([], 0);
                        }, false);
                    },
                    on: function(data){
                        //arr:  当前多选已选中的数据
                        var arr = data.arr;
                        if(arr[0] != undefined){
                            var selectVal = data.arr[0];
                            $('#'+domId).val(JSON.stringify({"id":selectVal.id,"title":selectVal.title}));
                        }else{
                            $('#'+domId).val('');
                        }
                    },
                });
                var defaultVal = $('#'+domId).val();
                if(defaultVal) defaultVal = JSON.parse('['+defaultVal+']');
                xmSelect.setValue(defaultVal);
            });
        },
        inputCheckboxs: function(){
            $('.inputCheckboxs').each(function(){
                var thisId = this.id;
                var menuid = $(this).data('menuid');
                if(menuid == false){
                    var errorTitle = $(this).parent().parent().html() + '为确定数据来源的menuid';
                    alert(errorTitle);
                    throw errorTitle;
                }
                var domId = this.id.replace('-div', '');

                var xmSelect = layui.xmSelect.render({
                    el: '#'+thisId,
                    radio: false,
                    paging: true,
                    pageRemote: true,
                    filterable: true,
                    max: 12,
                    theme: {
                        color: '#1cbbb4',
                    },
                    prop: {
                        name: 'title',
                        value: 'id',
                    },
                    remoteMethod: function(val, cb, show, pageIndex){
                        //val: 搜索框的内容, 不开启搜索默认为空, cb: 回调函数, show: 当前下拉框是否展开, pageIndex: 当前第几页
                        if(val == undefined) val = '';
                        layui.zhanshop.ajax(API_ADDRESS+'/v3.0.0/index.table?id='+parent.layui.zhanshop.getParam('_id')+'&value_menu='+menuid, 'POST', {"keyword":val, "page": pageIndex, "limit":10, '_method': 'xmselect'}, {}, function(res){
                            //console.log(res.data.data);
                            cb(res.data.data, Math.ceil(res.data.total / 10))
                        },function(xhr){
                            cb([], 0);
                        }, false);
                    },
                    on: function(data){
                        //arr:  当前多选已选中的数据
                        var arr = data.arr;
                        if(arr[0] != undefined){
                            var selectVals = [];
                            for(var i in data.arr){
                                var selectVal = data.arr[i];
                                selectVals.push({"id":selectVal.id,"title":selectVal.title});
                            }
                            $('#'+domId).val(JSON.stringify(selectVals));
                        }else{
                            $('#'+domId).val('');
                        }
                    },
                });
                var defaultVal = $('#'+domId).val();
                if(defaultVal) defaultVal = JSON.parse(defaultVal);
                xmSelect.setValue(defaultVal);
            });
        },
        inputJson : function(){
            $('.inputJson').each(function(){
                //$(this)
            });
        },
        inputSwitch: function(){
            $('.inputSwitch').each(function(){
            });
        }
    };
    exports('zhanshopFrom', from);//导出
});