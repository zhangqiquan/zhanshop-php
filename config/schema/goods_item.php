<?php
 return array (
  'item_id' => 
  array (
    'field' => 'item_id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品ID',
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
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品标题',
    'search' => true,
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
  'sub_title' => 
  array (
    'field' => 'sub_title',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '简述',
    'search' => true,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'textarea',
    'input_maxlength' => 255,
  ),
  'keywords' => 
  array (
    'field' => 'keywords',
    'type' => 'varchar(200)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '商品关键字',
    'search' => true,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'tag',
    'input_maxlength' => 200,
  ),
  'description' => 
  array (
    'field' => 'description',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品描述',
    'search' => true,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'textarea',
    'input_maxlength' => 0,
  ),
  'thumbnails' => 
  array (
    'field' => 'thumbnails',
    'type' => 'text',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品图片',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 180,
    'value_menu' => '',
    'input_type' => 'images',
    'input_maxlength' => 0,
  ),
  'video_url' => 
  array (
    'field' => 'video_url',
    'type' => 'varchar(100)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '展示视频',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'video',
    'input_maxlength' => 100,
  ),
  'cat_id' => 
  array (
    'field' => 'cat_id',
    'type' => 'int',
    'key' => 'mul',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品分类',
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
  'sales' => 
  array (
    'field' => 'sales',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '虚拟购买量',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 0,
  ),
  'price' => 
  array (
    'field' => 'price',
    'type' => 'decimal(8,2)',
    'key' => 'mul',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品价格',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 8,
  ),
  'market_price' => 
  array (
    'field' => 'market_price',
    'type' => 'decimal(8,2)',
    'key' => '',
    'null' => 'yes',
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
    'input_type' => 'hidden',
    'input_maxlength' => 8,
  ),
  'cost_price' => 
  array (
    'field' => 'cost_price',
    'type' => 'decimal(19,2)',
    'key' => '',
    'null' => 'yes',
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
    'input_type' => 'hidden',
    'input_maxlength' => 19,
  ),
  'state' => 
  array (
    'field' => 'state',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '审核状态 -1 审核失败 0 未审核 1 审核成功',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'is_attribute' => 
  array (
    'field' => 'is_attribute',
    'type' => 'enum(\'0\',\'1\')',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '启用商品规格',
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
    'input_maxlength' => 0,
  ),
  'sortrank' => 
  array (
    'field' => 'sortrank',
    'type' => 'int',
    'key' => 'mul',
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
  'goods_status' => 
  array (
    'field' => 'goods_status',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'yes',
    'default' => '1',
    'title' => '商品状态',
    'search' => false,
    'value' => 
    array (
      0 => '仓库',
      1 => '上架',
      10 => '违规',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 0,
  ),
  'marketing_type' => 
  array (
    'field' => 'marketing_type',
    'type' => 'varchar(50)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '促销类型',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 50,
  ),
  'marketing_id' => 
  array (
    'field' => 'marketing_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '促销活动ID',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'marketing_price' => 
  array (
    'field' => 'marketing_price',
    'type' => 'decimal(10,2)',
    'key' => '',
    'null' => 'no',
    'default' => '0.00',
    'title' => '商品促销价格',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 10,
  ),
  'min_buy' => 
  array (
    'field' => 'min_buy',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '最少买几件',
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
  'max_buy' => 
  array (
    'field' => 'max_buy',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '限购数量',
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
  'is_stock_visible' => 
  array (
    'field' => 'is_stock_visible',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '库存显示',
    'search' => false,
    'value' => 
    array (
      0 => '不显示',
      1 => '显示',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 0,
  ),
  'product_type_id' => 
  array (
    'field' => 'product_type_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '商品类型',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => 'goods_type',
    'input_type' => 'select',
    'input_maxlength' => 0,
  ),
  'spec_data' => 
  array (
    'field' => 'spec_data',
    'type' => 'text',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '商品规格',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'match_point' => 
  array (
    'field' => 'match_point',
    'type' => 'float',
    'key' => '',
    'null' => 'yes',
    'default' => '5',
    'title' => '实物与描述相符（根据评价计算）',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'match_ratio' => 
  array (
    'field' => 'match_ratio',
    'type' => 'float',
    'key' => '',
    'null' => 'yes',
    'default' => '100',
    'title' => '实物与描述相符（根据评价计算）百分比',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'sale_date' => 
  array (
    'field' => 'sale_date',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '上下架时间',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'hidden',
    'input_maxlength' => 0,
  ),
  'is_virtual' => 
  array (
    'field' => 'is_virtual',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '是否虚拟商品',
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
  'unit' => 
  array (
    'field' => 'unit',
    'type' => 'varchar(20)',
    'key' => '',
    'null' => 'yes',
    'default' => '件',
    'title' => '商品单位',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 20,
  ),
  'status' => 
  array (
    'field' => 'status',
    'type' => 'tinyint',
    'key' => '',
    'null' => 'yes',
    'default' => '1',
    'title' => '状态',
    'search' => false,
    'value' => 
    array (
      0 => '仓库',
      1 => '上架',
      10 => '违规',
    ),
    'in_list' => false,
    'in_field' => false,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 0,
  ),
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
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
  'update_time' => 
  array (
    'field' => 'update_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
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