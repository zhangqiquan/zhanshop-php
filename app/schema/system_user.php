<?php
 return array (
  'user_id' => 
  array (
    'field' => 'user_id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '会员id',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'escape' => false,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'user_name' => 
  array (
    'field' => 'user_name',
    'type' => 'varchar(60)',
    'key' => 'uni',
    'null' => 'no',
    'default' => NULL,
    'title' => '用户名',
    'search' => true,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 60,
  ),
  'password' => 
  array (
    'field' => 'password',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '密码',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'password',
    'input_maxlength' => 255,
  ),
  'avatar' => 
  array (
    'field' => 'avatar',
    'type' => 'text',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '头像',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'image',
    'input_maxlength' => 0,
  ),
  'role_id' => 
  array (
    'field' => 'role_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '角色',
    'search' => false,
    'value' => 
    array (
      0 => '超级管理员',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'SysRole',
    'input_type' => 'select',
    'input_maxlength' => 0,
  ),
  'last_login_ip' => 
  array (
    'field' => 'last_login_ip',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '上次登录ip',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 60,
  ),
  'last_login_time' => 
  array (
    'field' => 'last_login_time',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '上次登录时间',
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
  'login_count' => 
  array (
    'field' => 'login_count',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '登录次数',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'is_demo' => 
  array (
    'field' => 'is_demo',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '演示账号',
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
    'default' => '0',
    'title' => '注册时间',
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
  'enabled' => 
  array (
    'field' => 'enabled',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '可用状态',
    'search' => false,
    'value' => 
    array (
      0 => '禁用',
      1 => '启用',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
);