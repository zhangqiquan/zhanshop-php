<?php
 return array (
  'order_id' => 
  array (
    'field' => 'order_id',
    'type' => 'varchar(60)',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '订单id',
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
  'trade_id' => 
  array (
    'field' => 'trade_id',
    'type' => 'varchar(60)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '合并支付订单ID',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 60,
  ),
  'user_id' => 
  array (
    'field' => 'user_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '用户id',
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
  'amount' => 
  array (
    'field' => 'amount',
    'type' => 'decimal(20,3)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '订单金额',
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
  'goods_amount' => 
  array (
    'field' => 'goods_amount',
    'type' => 'decimal(20,3)',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '商品金额',
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
  'goods_privilege' => 
  array (
    'field' => 'goods_privilege',
    'type' => 'decimal(20,3)',
    'key' => '',
    'null' => 'no',
    'default' => '0.000',
    'title' => '商品优惠金额',
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
  'pay_status' => 
  array (
    'field' => 'pay_status',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '支付状态',
    'search' => false,
    'value' => 
    array (
      0 => '未支付',
      1 => '已支付',
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'ship_status' => 
  array (
    'field' => 'ship_status',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'yes',
    'default' => '0',
    'title' => '发货状态',
    'search' => false,
    'value' => 
    array (
      0 => '未发送',
      1 => '已发货',
      3 => '部分发货',
      4 => '退回',
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'coupon' => 
  array (
    'field' => 'coupon',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => '',
    'title' => '优惠券',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 255,
  ),
  'status' => 
  array (
    'field' => 'status',
    'type' => 'tinyint(1)',
    'key' => '',
    'null' => 'no',
    'default' => '1',
    'title' => '订单状态',
    'search' => false,
    'value' => 
    array (
      0 => '废弃',
      1 => '正常',
    ),
    'in_list' => false,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'radio',
    'input_maxlength' => 1,
  ),
  'remark' => 
  array (
    'field' => 'remark',
    'type' => 'text',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '订单备注',
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
  'payment_time' => 
  array (
    'field' => 'payment_time',
    'type' => 'int',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '支付时间',
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
  'payment_platform' => 
  array (
    'field' => 'payment_platform',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '支付方式',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 170,
    'value_menu' => '',
    'input_type' => 'text',
    'input_maxlength' => 255,
  ),
  'create_time' => 
  array (
    'field' => 'create_time',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '下单时间',
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