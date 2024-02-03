<?php
return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'varchar(255)',
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
    'input_maxlength' => 255,
  ),
  'task' => 
  array (
    'field' => 'task',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => 'task类',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 220,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 255,
  ),
  'param' => 
  array (
    'field' => 'param',
    'type' => 'text',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '参数',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 220,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 0,
  ),
  'result' => 
  array (
    'field' => 'result',
    'type' => 'text',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '结果',
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
  'status' => 
  array (
    'field' => 'status',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '状态',
    'search' => false,
    'value' => 
    array (
      -1 => '失败',
      0 => '待执行',
      1 => '执行中',
      2 => '完成',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 0,
  ),
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'datetime',
    'key' => '',
    'null' => 'yes',
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
    'type' => 'datetime',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '更新时间',
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
);