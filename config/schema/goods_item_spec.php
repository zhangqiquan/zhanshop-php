<?php
 return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => 'id',
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
  'title' => 
  array (
    'field' => 'title',
    'type' => 'varchar(25)',
    'key' => 'mul',
    'null' => 'no',
    'default' => NULL,
    'title' => '规格名称',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 25,
  ),
  'show_type' => 
  array (
    'field' => 'show_type',
    'type' => 'varchar(10)',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '显示方式',
    'search' => false,
    'value' => 
    array (
      1 => '文字',
      2 => '颜色',
      3 => '图片',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 10,
  ),
  'sortrank' => 
  array (
    'field' => 'sortrank',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '50',
    'title' => '排序',
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
  'explain' => 
  array (
    'field' => 'explain',
    'type' => 'varchar(100)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '规格说明',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 100,
  ),
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '创建时间',
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
  'updated_time' => 
  array (
    'field' => 'updated_time',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '修改时间',
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
    'input_type' => 'time',
    'input_maxlength' => 0,
  ),
);