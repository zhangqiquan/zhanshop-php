const API_ADDRESS = window.location.protocol+'//'+window.location.host; // 管理后台API地址
//const API_ADDRESS = 'http://127.0.0.1:6200';
window.layPath = getRootPath()+'/js/layer/';

var timeStamp = new Date().getTime().toString();
layui.config({
    base: layPath+"module/",
    // cookie开启debug模式的话不缓存库
    version: timeStamp.slice(0, 7),// 版本号有效期1天
}).extend({
    'zhanshop': 'zhanshop/zhanshop',
    'zhanshopTable': 'zhanshop/table',
    'zhanshopTreeTable': 'zhanshop/treeTable',
    'zhanshopTableEvent': 'zhanshop/tableEvent',
    'zhanshopFrom': 'zhanshop/from',
    'zhanshopDataFormat': 'zhanshop/dataFormat',

    'xmSelect' : 'xm-select/xm-select',
    'tableSelect': 'table-select/table-select',
    'inputTag': 'inputtag/inputtag',
    'layCascader': 'cascader/cascader',
    'skuTable': 'skuTable/skuTable',
    'sortable': 'skuTable/sortable',
});
/**
 * 时间戳转日期
 * @param time
 * @returns {string}
 */
window.date = function(timeStamp, type = 'Y-M-D H:I:S', auto = false){
    let time = (timeStamp + '').length === 10 ? new Date(parseInt(timeStamp) * 1000) : new Date(parseInt(timeStamp));
    let _year = time.getFullYear();
    let _month = (time.getMonth() + 1) < 10 ? '0' + (time.getMonth() + 1) : (time.getMonth() + 1);
    let _date = time.getDate() < 10 ? '0' + time.getDate() : time.getDate();
    let _hours = time.getHours() < 10 ? '0' + time.getHours() : time.getHours();
    let _minutes = time.getMinutes() < 10 ? '0' + time.getMinutes() : time.getMinutes();
    let _secconds = time.getSeconds() < 10 ? '0' + time.getSeconds() : time.getSeconds();
    let formatTime = '';
    let distinctTime = new Date().getTime() - time.getTime();

    if (auto) {
        if (distinctTime <= (1 * 60 * 1000)) {
            // console.log('一分钟以内，以秒数计算');
            let _s = Math.floor((distinctTime / 1000) % 60);
            formatTime = _s + '秒前';
        } else if (distinctTime <= (1 * 3600 * 1000)) {
            // console.log('一小时以内,以分钟计算');
            let _m = Math.floor((distinctTime / (60 * 1000)) % 60);
            formatTime = _m + '分钟前';
        } else if (distinctTime <= (24 * 3600 * 1000)) {
            // console.log('一天以内，以小时计算');
            let _h = Math.floor((distinctTime / (60 * 60 * 1000)) % 24);
            formatTime = _h + '小时前';
        } else if (distinctTime <= (30 * 24 * 3600 * 1000)) {
            let _d = Math.floor((distinctTime / (24 * 60 * 60 * 1000)) % 30);
            formatTime = _d + '天前';
            // console.log('30天以内,以天数计算');
        } else {
            // 30天以外只显示年月日
            formatTime = _year + '-' + _month + '-' + _date;
        }
    } else {

        switch (type) {
            case 'Y-M-D H:I:S':
                formatTime = _year + '-' + _month + '-' + _date + ' ' + _hours + ':' + _minutes + ':' + _secconds;
                break;
            case 'Y-M-D H:I:S zh':
                formatTime = _year + '年' + _month + '月' + _date + '日  ' + _hours + ':' + _minutes + ':' + _secconds;
                break;
            case 'Y-M-D H:I':
                formatTime = _year + '-' + _month + '-' + _date + ' ' + _hours + ':' + _minutes;
                break;
            case 'Y-M-D H':
                formatTime = _year + '-' + _month + '-' + _date + ' ' + _hours;
                break;
            case 'Y-M-D':
                formatTime = _year + '-' + _month + '-' + _date;
                break;
            case 'Y-M-D zh':
                formatTime = _year + '年' + _month + '月' + _date + '日';
                break;
            case 'Y-M':
                formatTime = _year + '-' + _month;
                break;
            case 'Y':
                formatTime = _year;
                break;
            case 'M':
                formatTime = _month;
                break;
            case 'D':
                formatTime = _date;
                break;
            case 'H':
                formatTime = _hours;
                break;
            case 'I':
                formatTime = _minutes;
                break;
            case 'S':
                formatTime = _secconds;
                break;
            default:
                formatTime = _year + '-' + _month + '-' + _date + ' ' + _hours + ':' + _minutes + ':' + _secconds;
                break;
        }
    }
    // 返回格式化的日期字符串
    return formatTime;
}
/**
 * 模版foreach函数
 * @param {Object} arr
 * @param {Object} fun
 */
window.arr_foreach = function(arr, fun){
    var html = '';
    try{
        for(i in arr){
            html += fun(i, arr[i]);
        }
    }catch (e) {
        //console.warn(e);
    }

    return html;
}
/**
 * in_array
 * @param search
 * @param array
 * @returns {boolean}
 */
function in_array(search,array){
    for(var i in array){
        if(array[i] == search){
            return true;
        }
    }
    return false;
}

/**
 * 获取cookie
 * @param name
 * @returns {string|null}
 */
function getcookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) {
        return unescape(arr[2]);
    } else {
        return null;
    }
}

window.hiddenVal = function(val){
    if(val === null) return '';
    return  val;
}

window.json_encode = function(val){
    if(val === null) return '';
    return  JSON.stringify(val);
}

window.laytime = function(val){
    return date(val, 'Y-m-d H:i:s');
}

window.laydate = function(val){
    if(isNaN(val)){
        return val;
    }
    return date(val, 'Y-m-d');
}

window.previewJsonPics = function (str, height = 40){
    try{
        var imgs = JSON.parse(str);
        var html = '';
        for(var i in imgs){
            html += '<img onclick="previewPic(this)" src="'+imgs[i]+'" height="'+height+'px" />&nbsp;';
        }
        return html;
    }catch (e) {

    }
    return '';
}

window.laytimerange = function(val){
    var arr = val.split('-');
    return date(arr[0], 'Y-m-d') + ' - '+date(arr[1], 'Y-m-d');
}

window.json_decode = function (val) {
    try{
        var json = JSON.parse(val);
        return json;
    }catch (e) {
        return {};
    }
}

window.timerange = function (val) {
    if(val && val.length > 0){
        var arr = val.split(',');
        var arr0 = arr[0].trim();
        var arr1 = arr[1].trim();
        if(arr0 && arr1){
            var timerangeStr = '';
            timerangeStr = date(arr0, 'Y-m-d H:i:s')+" , ";
            timerangeStr += date(arr1, 'Y-m-d H:i:s');

            return timerangeStr;
        }
    }
    return val;
}

/**
 * in_array
 * @param search
 * @param array
 * @returns {boolean}
 */
function in_array(search,array){
    for(var i in array){
        if(array[i] == search){
            return true;
        }
    }
    return false;
}


