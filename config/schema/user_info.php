<?php
 return array (
  'user_id' => 
  array (
    'field' => 'user_id',
    'type' => 'bigint',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '用户id',
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
  'nick' => 
  array (
    'field' => 'nick',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '昵称',
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
  'birthday' => 
  array (
    'field' => 'birthday',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '生日',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'time',
    'input_maxlength' => 60,
  ),
  'sex' => 
  array (
    'field' => 'sex',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '性别',
    'search' => false,
    'value' => 
    array (
      0 => '保密',
      1 => '男',
      2 => '女',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'regip' => 
  array (
    'field' => 'regip',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '注册ip',
    'search' => false,
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
  'reg_channel' => 
  array (
    'field' => 'reg_channel',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'no',
    'default' => 'unknown',
    'title' => '注册渠道',
    'search' => false,
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
  'vip_endtime' => 
  array (
    'field' => 'vip_endtime',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => 'vip截止时间',
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
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
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
);