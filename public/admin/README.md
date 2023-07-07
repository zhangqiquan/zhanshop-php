## 表单组件
### input输入框
schema字段列 input_type=text, input_maxlength最大长度 ， input_minlength最小长度

### 地址选择
schema字段列 input_type=cascader, value_menu=SysRegion ， value : 'lazy' => true, 大数据设定成ajax获取

### 隐藏域
schema字段列 input_type=hidden

### 数字输入框
schema字段列 input_type=number , 限制小数位 value: {'step' => "0.01"} 限制小数点步数2位

### 标签回车输入框
schema字段列 input_type=tag

### 级联选择 
schema字段列 input_type=cascader value_menu=指定数据来源菜单 大数据应启用异步方式
props: 对应schema字段列value
multiple=true 复选
checkStrictly=true 来设置父子节点取消选中关联，从而达到选择任意一级选项的目的
lazy=true 异步加载
更多使用详见： https://yixiaco.github.io/lay_cascader/

### 下拉选择框
schema字段列 input_type=select , value_menu 和 value 任选其一 两者都选将进行合并value和value_menu重复的以value_menu为准不适合大数据 限制3000

### 单选框
schema字段列 input_type=radio , value_menu 和 value 任选其一 两者都选将进行合并value和value_menu重复的以value_menu为准不适合大数据 限制300

### 复选框
schema字段列 input_type=checkbox , value_menu 和 value 任选其一 两者都选将进行合并value和value_menu重复的以value_menu为准不适合大数据 限制300

### 下拉框高级版本
1. 复选框 schema字段列 input_type=xmselect , value_menu=菜单id value => ['max': 12] 限制最大个数,不指定默认20个
2. 单选框 input_type=xmselect , value_menu=菜单id value => ['radio': true] 指定为单选
https://maplemei.gitee.io/xm-select/#/component/install

### 下拉单选框大数据版本
schema字段列 input_type=xmselect , value_menu=菜单id  value 设定属性什么单选多选啥的 https://maplemei.gitee.io/xm-select/#/component/install

### 下拉选择框大数据版本
schema字段列 input_type=xmselect , value_menu=菜单id  value 设定属性什么单选多选啥的

更多使用详见: https://maplemei.gitee.io/xm-select/#/component/install

### 富文本输入框
schema字段列 input_type=textarea


### 时间输入框
schema字段列 input_type=time value= 支持自定义属性 限制年月日时分秒

### 时间范围输入框
schema字段列 input_type=timerange value= 支持自定义属性 限制年月日时分秒

### 图片选择框
schema字段列 input_type=image

### 多图片选择框
schema字段列 input_type=images

### 音频选择框
schema字段列 input_type=autio

### 多音频选择框
schema字段列 input_type=audios


### 视频选择框
schema字段列 input_type=video

### 多视频选择框
schema字段列 input_type=videos


### 文件选择框
schema字段列 input_type=document

### 多文件选择框
schema字段列 input_type=documents

### 百度编辑器
schema字段列 input_type=baidueditor








## 分步骤表单

添加菜单的时候设定 关联schma 多个使用,分割， 第一个schma的组件id必须在第二个和第三个表中出现

