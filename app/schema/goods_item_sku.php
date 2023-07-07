<?php
 return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'bigint',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '货品id',
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
  'item_id' => 
  array (
    'field' => 'item_id',
    'type' => 'int',
    'key' => 'mul',
    'null' => 'yes',
    'default' => '0',
    'title' => '商品id',
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
  'name' => 
  array (
    'field' => 'name',
    'type' => 'varchar(600)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => 'sku串名称',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 600,
  ),
  'picture' => 
  array (
    'field' => 'picture',
    'type' => 'varchar(200)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '主图',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 200,
  ),
  'price' => 
  array (
    'field' => 'price',
    'type' => 'decimal(8,2)',
    'key' => '',
    'null' => 'no',
    'default' => '0.00',
    'title' => '价格',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 8,
  ),
  'market_price' => 
  array (
    'field' => 'market_price',
    'type' => 'decimal(8,2)',
    'key' => '',
    'null' => 'no',
    'default' => '0.00',
    'title' => '市场价格',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 8,
  ),
  'cost_price' => 
  array (
    'field' => 'cost_price',
    'type' => 'decimal(8,2)',
    'key' => '',
    'null' => 'no',
    'default' => '0.00',
    'title' => '成本价',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 8,
  ),
  'stock' => 
  array (
    'field' => 'stock',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '库存',
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
  'sortrank' => 
  array (
    'field' => 'sortrank',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '1999',
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
  'spec' => 
  array (
    'field' => 'spec',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '规格',
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
  'status' => 
  array (
    'field' => 'status',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'yes',
    'default' => '1',
    'title' => '状态[-1:删除;0:禁用;1启用]',
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
    'input_type' => 'text',
    'input_maxlength' => 0,
  ),
  'update_time' => 
  array (
    'field' => 'update_time',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '更新时间',
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