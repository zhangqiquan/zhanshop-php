<?php
 return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'varchar(20)',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '菜单id',
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
  'title' => 
  array (
    'field' => 'title',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '菜单名称',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 320,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 60,
  ),
  'parent_id' => 
  array (
    'field' => 'parent_id',
    'type' => 'varchar(20)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '父级菜单',
    'search' => false,
    'value' => 
    array (
      'checkStrictly' => true,
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'sys_menu',
    'input_type' => 'cascader',
    'input_maxlength' => 20,
  ),
  'target' => 
  array (
    'field' => 'target',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'no',
    'default' => '_self',
    'title' => '打开方式',
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
  'icon' => 
  array (
    'field' => 'icon',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '图标',
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
  'table_names' => 
  array (
    'field' => 'table_names',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '关联schma',
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
  'pk' => 
  array (
    'field' => 'pk',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '组件id',
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
  'name' => 
  array (
    'field' => 'name',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '字段标题',
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
  'pid' => 
  array (
    'field' => 'pid',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '层字段',
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
  'page' => 
  array (
    'field' => 'page',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '打开外部页面',
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
  'is_hidden' => 
  array (
    'field' => 'is_hidden',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '是否隐藏',
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
  'sortrank' => 
  array (
    'field' => 'sortrank',
    'type' => 'mediumint',
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
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'varchar(20)',
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
    'input_maxlength' => 20,
  ),
);