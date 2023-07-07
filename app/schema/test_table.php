<?php
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => 'ID',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 0,
  ),
  '_hidden' => 
  array (
    'field' => '_hidden',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '隐藏输入',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 255,
  ),
  '_number' => 
  array (
    'field' => '_number',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '数字输入',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'number',
    'input_maxlength' => 0,
  ),
  '_xiaoshu' => 
  array (
    'field' => '_xiaoshu',
    'type' => 'double(20,2)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '小数点',
    'search' => false,
    'value' => 
    array (
      'step' => '0.01',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'number',
    'input_maxlength' => 20,
  ),
  '_tag' => 
  array (
    'field' => '_tag',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '标签',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'tag',
    'input_maxlength' => 255,
  ),
  '_cascader' => 
  array (
    'field' => '_cascader',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '级联选择',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'GoodsCategory',
    'input_type' => 'cascader',
    'input_maxlength' => 255,
  ),
  '_select' => 
  array (
    'field' => '_select',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '下拉选择',
    'search' => false,
    'value' => 
    array (
      0 => '张三',
      1 => '李四',
      2 => '王八蛋',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'select',
    'input_maxlength' => 255,
  ),
  '_radio' => 
  array (
    'field' => '_radio',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '单选框',
    'search' => false,
    'value' => 
    array (
      0 => '张三1',
      1 => '李四2',
      2 => '王八蛋3',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 255,
  ),
  '_checkbox' => 
  array (
    'field' => '_checkbox',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '复选框',
    'search' => false,
    'value' => 
    array (
      0 => '张三1',
      1 => '李四2',
      2 => '王八蛋3',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'checkbox',
    'input_maxlength' => 255,
  ),
  '_xmselect' => 
  array (
    'field' => '_xmselect',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '选择框',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'UserInfo',
    'input_type' => 'xmselect',
    'input_maxlength' => 255,
  ),
  '_xmselect_radio' => 
  array (
    'field' => '_xmselect_radio',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '下拉高级单选',
    'search' => false,
    'value' => 
    array (
      'radio' => true,
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'UserInfo',
    'input_type' => 'xmselect',
    'input_maxlength' => 255,
  ),
  '_textarea' => 
  array (
    'field' => '_textarea',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '文本区域',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'textarea',
    'input_maxlength' => 255,
  ),
  '_date' => 
  array (
    'field' => '_date',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '日期',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'date',
    'input_maxlength' => 255,
  ),
  'time' => 
  array (
    'field' => 'time',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '时间',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'time',
    'input_maxlength' => 255,
  ),
  '_date1' => 
  array (
    'field' => '_date1',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '日期1',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'date',
    'input_maxlength' => 0,
  ),
  '_time' => 
  array (
    'field' => '_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '时间1',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'time',
    'input_maxlength' => 0,
  ),
  '_timerange' => 
  array (
    'field' => '_timerange',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '时间范围',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'timerange',
    'input_maxlength' => 255,
  ),
  '_timerange1' => 
  array (
    'field' => '_timerange1',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '时间范围1',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'timerange',
    'input_maxlength' => 255,
  ),
  '_image' => 
  array (
    'field' => '_image',
    'type' => 'varchar(500)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '单图',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'image',
    'input_maxlength' => 500,
  ),
  '_images' => 
  array (
    'field' => '_images',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '多图',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'images',
    'input_maxlength' => 255,
  ),
  '_audio' => 
  array (
    'field' => '_audio',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '单音频',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'audio',
    'input_maxlength' => 0,
  ),
  '_audios' => 
  array (
    'field' => '_audios',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '多音频',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'audios',
    'input_maxlength' => 0,
  ),
  '_video' => 
  array (
    'field' => '_video',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '单视频',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'video',
    'input_maxlength' => 0,
  ),
  '_videos' => 
  array (
    'field' => '_videos',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '多视频',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'videos',
    'input_maxlength' => 0,
  ),
  '_baidueditor' => 
  array (
    'field' => '_baidueditor',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '百度编辑器',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'baidueditor',
    'input_maxlength' => 0,
  ),
  '_dizhi' => 
  array (
    'field' => '_dizhi',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '地址库',
    'search' => false,
    'value' => 
    array (
      'lazy' => true,
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'SysRegion',
    'input_type' => 'cascader',
    'input_maxlength' => 255,
  ),
  '_document' => 
  array (
    'field' => '_document',
    'type' => 'varchar(500)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '单个文件',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'document',
    'input_maxlength' => 500,
  ),
  '_documents' => 
  array (
    'field' => '_documents',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '多个文件',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'documents',
    'input_maxlength' => 0,
  ),
);