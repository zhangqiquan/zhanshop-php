<?php
 return array (
  'cat_id' => 
  array (
    'field' => 'cat_id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '类目id',
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
  'cat_name' => 
  array (
    'field' => 'cat_name',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '类目名称',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 280,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 60,
  ),
  'parent_id' => 
  array (
    'field' => 'parent_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '父类目',
    'search' => false,
    'value' => 
    array (
      'checkStrictly' => true,
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'goods_category',
    'input_type' => 'cascader',
    'input_maxlength' => 0,
  ),
  'keywords' => 
  array (
    'field' => 'keywords',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '关键词',
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
  'description' => 
  array (
    'field' => 'description',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '描述',
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
  'sortrank' => 
  array (
    'field' => 'sortrank',
    'type' => 'smallint',
    'key' => '',
    'null' => 'no',
    'default' => '50',
    'title' => '排序值',
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
    'input_type' => 'text',
    'input_maxlength' => 0,
  ),
);