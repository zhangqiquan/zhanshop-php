layui.define([], function (exports) {
    var $ = layui.$;
    $(document).on("click",".image-add",function(){
        alert('添加图片');
    });
    var fromAdd = {

    };
    exports('fromAdd', fromAdd);//导出
});