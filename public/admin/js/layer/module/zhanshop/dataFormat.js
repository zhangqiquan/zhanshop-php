layui.define([], function (exports) {

    var obj = {
        schmaField: {},
        setSchmaField: function(listObj, schma){
            var schmaType = {};
            for(var i in listObj){
                var item = listObj[i];
                for(var ii in item){
                    if(schmaType[ii] == undefined){
                        for(var k in schma){
                            if(schma[k]['field'] == ii){
                                schmaType[ii] = {
                                    "type" : schma[k]['input_type'],
                                    "val" : schma[k]['value']
                                };
                            }
                        }
                    }
                }
            }
            this.schmaField = schmaType;
        },
        onHandle: function(listObj, schma){
            this.setSchmaField(listObj, schma);

            for(var i in listObj){
                var item = listObj[i];
                for(var ii in item){
                    var schmaField = this.schmaField[ii];
                    if(schmaField != undefined){
                        try{
                            var type = schmaField['type'];
                            listObj[i][ii] = this[type].call(this, item[ii], schmaField['val']);
                        }catch (e) {console.log(schmaField['type']);console.error(e);}

                    }

                }
            }
            return listObj;
        },
        select: function(data, val){
            for(var i in val){
                if(val[i]['key'] == data){
                    return val[i]['val'];
                }
            }
            if(val[data] != undefined && typeof val[data] != 'object') return val[data];

            return data;
        },
        radio: function(data, val){
            if(val[data] != undefined) return val[data];
            return data;
        },
        checkbox: function(data, val){
            try{
                var json = data = JSON.parse(data);
                var html = '';
                for(var i in json){
                    if(val[json[i]] != undefined) html += val[json[i]] + ' ';
                }
                return html;
            }catch (e) {
                return data;
            }

        },
        radios: function(data, val){
            try{
                var json = JSON.parse(data);

                if(json.title != undefined && json.title) return json.title;
            }catch (e) {
                
            }

            return data;
        },
        checkboxs: function(data, val){
            var json = JSON.parse(data);
            var html = '';
            for(var i in json){
                html += json[i]['title']+',';
            }
            if(html == '') html = data;
            return html;
        },
        date: function(data, val){
            if(!isNaN(data)){
                return date(data, 'Y-m-d');
            }
            return data;
        },
        time: function(data, val){
            if(data && !isNaN(data)){
                return date(data, 'Y-m-d H:i:s');
            }
            return data;
        },
        timerange: function(data, val){
            return window.timerange(data);
        },
        image: function(data, val){
            //if(data) return '<img src="'+data+'" height="28px" onclick="pictureBrowser(this)" />';
            return data;
        },
        images: function(data, val){
            // try{
            //     data = JSON.parse(data);
            //     var html = '';
            //     for(var i in data){
            //         html += '<img src="'+data[i]+'" height="38px" onclick="pictureBrowser(this)" /> &nbsp;'
            //     }
            //     return html;
            // }catch (e) {
            //
            // }
            return data;
        },
        audio: function(data, val){
            try{
                var json = JSON.parse(data);
                return json.original;
            }catch (e) {
                return data;
            }
        },

        number: function(data, val){
            return data;
        },

        xmselect: function (data, val) {
            return data;
        },

        documents: function (data, val) {
            return data;
        },
        audios: function(data, val){
            try{
                var json = JSON.parse(data);
                var originals = "";
                for(var i in json){
                    originals += json[i]['original']+',';
                }
                return originals;
            }catch (e) {
                return data;
            }
        },
        video: function(data, val){
            try{
                var json = JSON.parse(data);
                return json.original;
            }catch (e) {

            }
            return data;
        },
        videos: function(data, val){
            var html = '';
            try{
                var json = JSON.parse(data);

                for(var i in json){
                    html += json[i]['original']+',';
                }
            }catch (e) {

            }

            if(html == '') html = data;
            return html;
        },
        switch: function(data, val){
            if(val){
                return '开启';
            }
            return '关闭';
        },
        text: function (data, val) {
            return data;
        },
        password: function (data, val) {
            return "******";
        },
        baidueditor: function(data, val){
            return data;
        },
        cascader: function (data, val){
            if(val[data]) return val[data];
            return data;
        },
        textarea: function(data, val){
            return data;
        },
        tag: function(data, val){
            return data;
        },
        hidden: function(data, val){
            return data;
        },
        document: function(data, val){
            try{
                json = JSON.parse(data);
                if(json.original) return json.original;
            }catch (e) {

            }
            return data;
        },
        documents: function(data, val){
            try{
                var json = JSON.parse(data);
                var originals = "";
                for(var i in json){
                    if(json[i]['original']) originals += json[i]['original']+',';
                }
                if(originals) return originals;
            }catch (e) {

            }
            return data;
        },
        icon: function (data, val) {
            return '';
        }
    };
    exports('zhanshopDataFormat', obj);//导出
});