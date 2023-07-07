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
  'latest_version' => 
  array (
    'field' => 'latest_version',
    'type' => 'varchar(20)',
    'key' => 'uni',
    'null' => 'no',
    'default' => NULL,
    'title' => '版本号',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 20,
  ),
  'apple_id' => 
  array (
    'field' => 'apple_id',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '苹果APPID',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 255,
  ),
  'detail' => 
  array (
    'field' => 'detail',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '更新内容',
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
  'update_type' => 
  array (
    'field' => 'update_type',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '更新类型',
    'search' => false,
    'value' => 
    array (
      0 => '热更新',
      1 => '普通更新',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'forced_update' => 
  array (
    'field' => 'forced_update',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '是否强制更新',
    'search' => false,
    'value' => 
    array (
      0 => '否',
      1 => '是',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '创建时间',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 170,
    'value_menu' => '',
    'input_type' => 'time',
    'input_maxlength' => 0,
  ),
  'update_time' => 
  array (
    'field' => 'update_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '更新时间',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'time',
    'input_maxlength' => 0,
  ),
  'delete_time' => 
  array (
    'field' => 'delete_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '删除时间',
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
);