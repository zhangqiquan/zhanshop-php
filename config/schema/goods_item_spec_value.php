<?php
 return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int unsigned',
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
  'spec_id' => 
  array (
    'field' => 'spec_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '规格id',
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
    'type' => 'varchar(125)',
    'key' => 'mul',
    'null' => 'no',
    'default' => NULL,
    'title' => '选项名称',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 125,
  ),
  'sort' => 
  array (
    'field' => 'sort',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '999',
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
  'status' => 
  array (
    'field' => 'status',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '状态(-1:已删除,0:禁用,1:正常)',
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
  'created_at' => 
  array (
    'field' => 'created_at',
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
  'updated_at' => 
  array (
    'field' => 'updated_at',
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
);