window.$_GET = function() {
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
            return get;
        } else {
            return {};
        }
    }catch (e) {
        return {};
    }

}();

window.notifyError = function(title, callback){
    lightyear.loading('hide');
    lightyear.notify(title, 'danger', 100);
    setTimeout(function() {
        callback();
    }, 2000)
}

window.notifySuccess = function(title, callback){
    lightyear.loading('hide');
    lightyear.notify(title, 'success', 3000);
    setTimeout(function() {
        callback();
    }, 2000)
}

/**
 * ajax请求
 * @param {Object} url
 * @param {Object} method
 * @param {Object} data
 * @param {Object} successCallback
 * @param {Object} errorCallback
 */
window.ajax_request = function(url, method, data, successCallback) {
    lightyear.loading('show');
    var request = $.ajax({
        url: url,
        method: method,
        timeout: 30000, // 超时时间设置，单位毫秒
        data: data,
        //dataType: 'json'
    });

    request.done(function(res) {
        lightyear.loading('hide');
        return successCallback(res);
    });

    request.fail(function(jqXHR) {
        lightyear.loading('hide');
        notifyError(jqXHR.responseText, function(){
            window.location.href="about:blank";
        });
    });
};