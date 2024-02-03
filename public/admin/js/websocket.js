var WebSock = {
    /**
     * websocket连接句柄
     */
    socket: null,
    /**
     * 消息响应处理对象
     */
    respEvent: null,
    /**
     * 读取url上的fd
     */
    fd: function () {
        var url = window.document.location.href.toString(); //当前完整url
        var u = url.split("?"); //以？为分隔符把url转换成字符串数组
        if (typeof(u[1]) == "string") {
            u = u[1].split("&"); //同上
            var get = {};
            for (var i in u) {
                var j = u[i].split("="); //同上
                if(j[0] == 'fd') return j[1];
            }
        }
        throw 'url上必须携带fd参数';
    },
    /**
     * 收到消息回调事件
     * @param evt
     */
    message: function (evt){

    },
    /**
     * 与服务端断开连接回调
     * @param evt
     */
    onclose: function (evt){

    },
    /**
     * 如果出现连接、处理、接收、发送数据失败的时候触发回调
     * @param evt
     */
    onerror: function (evt){

    },
    /**
     * 发送消息
     * @param uri
     * @param body
     */
    send: function (uri, body){
        var data = {
            "uri" : uri+'/'+this.respEvent.toFd,
            "header" : {
                "fd": this.respEvent.fd
            },
            "body": {
                'command' : body
            }
        };
        this.socket.send(JSON.stringify(data));
    },
    /**
     * 打开websocket
     * @param url 打开的url
     * @param event 事件回调类
     */
    open: function (url, ResponseEvent){
        this.respEvent = ResponseEvent;
        var fd = this.fd();
        ResponseEvent.toFd = fd;
        this.socket = new WebSocket(url+'/'+fd);
        var status = 0;
        this.socket.onmessage = function (evt) {
            var data = JSON.parse(evt.data);
            var event = data.uri;
            if(status == 0){
                status = 1;
            }
            console.log(evt.data);
            if(event){
                try{
                    ResponseEvent[event].call(ResponseEvent, data.header, data.body);
                }catch (e){
                    console.error(e);
                }
            }
        }
        this.socket.onclose = function (evt) {
            if(status == 0){
                ResponseEvent.terminal.echo(String("连接失败"));
            }else{
                ResponseEvent.terminal.echo(String("和服务连接断开"));
            }
            ResponseEvent.terminal.disable();
        }
        this.socket.onerror = function (evt) {
            ResponseEvent.terminal.echo(String(evt));
            console.error("发生错误", evt);
            ResponseEvent.terminal.disable();
            alert(evt);
        }
    }
    
};