<?php
 return array (
  'id' => 
  array (
    'field' => 'id',
    'type' => 'int',
    'key' => 'pri',
    'null' => 'no',
    'default' => NULL,
    'title' => '文档id',
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
    'title' => '标题',
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
  'thumbnail' => 
  array (
    'field' => 'thumbnail',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '缩略图',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'image',
    'input_maxlength' => 255,
  ),
  'templet' => 
  array (
    'field' => 'templet',
    'type' => 'varchar(255)',
    'key' => '',
    'null' => 'no',
    'default' => 'article_article.html',
    'title' => '模版',
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
  'cat_id' => 
  array (
    'field' => 'cat_id',
    'type' => 'int',
    'key' => '',
    'null' => 'no',
    'default' => '0',
    'title' => '分类',
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
    'input_type' => 'text',
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
    'input_type' => 'text',
    'input_maxlength' => 255,
  ),
  'body' => 
  array (
    'field' => 'body',
    'type' => 'longtext',
    'key' => '',
    'null' => 'no',
    'default' => NULL,
    'title' => '内容',
    'search' => false,
    'value' => 
    array (
    ),
    'in_list' => true,
    'in_field' => true,
    'width' => 120,
    'value_menu' => '',
    'input_type' => 'baidueditor',
    'input_maxlength' => 0,
  ),
  'source' => 
  array (
    'field' => 'source',
    'type' => 'varchar(20)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '来源',
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
  'author' => 
  array (
    'field' => 'author',
    'type' => 'varchar(20)',
    'key' => '',
    'null' => 'yes',
    'default' => NULL,
    'title' => '作者',
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