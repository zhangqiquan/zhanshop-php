-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-03-13 18:20:16
-- 服务器版本： 8.0.31
-- PHP 版本： 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `zhanshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `app_push`
--

CREATE TABLE `app_push` (
  `push_id` int NOT NULL COMMENT '推送id',
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '推送标题',
  `body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '推送内容',
  `openpage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '打开页面',
  `send_time` int DEFAULT '0' COMMENT '发送时间',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='app自定义推送' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `app_version`
--

CREATE TABLE `app_version` (
  `id` int NOT NULL COMMENT 'ID',
  `latest_version` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '版本号',
  `apple_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '苹果APPID',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新内容',
  `update_type` tinyint(1) DEFAULT '0' COMMENT '更新类型',
  `forced_update` tinyint(1) DEFAULT '0' COMMENT '是否强制更新',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='冥想APP版本' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `article_category`
--

CREATE TABLE `article_category` (
  `cat_id` int NOT NULL COMMENT '类目id',
  `cat_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类目名称',
  `parent_id` int NOT NULL COMMENT '父栏目',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '缩略图',
  `background_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '背景图片',
  `sortrank` smallint NOT NULL DEFAULT '50' COMMENT '排序',
  `permission` tinyint(1) NOT NULL DEFAULT '1' COMMENT '浏览权限',
  `attribute` tinyint(1) NOT NULL DEFAULT '0' COMMENT '栏目属性',
  `channeltype_id` smallint DEFAULT '1' COMMENT '内容模型',
  `redirecturl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '外部url',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='信息分类表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `article_category_body`
--

CREATE TABLE `article_category_body` (
  `cat_id` int NOT NULL COMMENT '分类id',
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='信息分类内容' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `article_category_param`
--

CREATE TABLE `article_category_param` (
  `cat_id` int NOT NULL COMMENT '栏目id',
  `seo_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'SEO标题',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '关键字',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目描述',
  `tempindex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'index_article.html' COMMENT '封面模板',
  `templist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'list_article.html' COMMENT '列表模板',
  `temparticle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'article_article.html' COMMENT '详情模板'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='信息分类表参数' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `article_content`
--

CREATE TABLE `article_content` (
  `id` int NOT NULL COMMENT '文档id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `templet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'article_article.html' COMMENT '模版',
  `cat_id` int NOT NULL DEFAULT '0' COMMENT '分类',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `source` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
  `author` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者',
  `sortrank` int NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='信息内容表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `article_indexslide`
--

CREATE TABLE `article_indexslide` (
  `id` int NOT NULL COMMENT 'id',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '连接地址',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='信息主页幻灯片' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `article_indexslide`
--

INSERT INTO `article_indexslide` (`id`, `image`, `title`, `url`, `create_time`, `update_time`) VALUES
(1, '{\"image_id\":8,\"original\":\"QQ截图20200920212454.jpg\",\"url\":\"/uploads/image/20200920/1600608312379051.jpg\"}', '幻灯片', '3', 1603625919, 1603706029);

-- --------------------------------------------------------

--
-- 表的结构 `goods_category`
--

CREATE TABLE `goods_category` (
  `cat_id` int NOT NULL COMMENT '类目id',
  `cat_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类目名称',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '父类目',
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `sortrank` smallint NOT NULL DEFAULT '50' COMMENT '排序值',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='商品类目表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `goods_category`
--

INSERT INTO `goods_category` (`cat_id`, `cat_name`, `parent_id`, `keywords`, `description`, `sortrank`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '鞋服', 0, '1111111', '111111111', 50, 1677759201, 1677759201, 0),
(2, '男装', 1, '1111111', '111111111', 50, 1677759201, 1677759201, 0),
(3, '女装', 1, '1111111', '111111111', 50, 1677759201, 1677759201, 0),
(4, '美食', 0, '', '', 50, 1677759672, 1677759672, 0),
(5, '川菜', 4, '', '', 50, 1677759695, 1677759695, 0),
(6, '烧烤', 4, '', '', 50, 1677759695, 1677759695, 0),
(7, '面食', 4, '', '', 50, 1677759695, 1677759695, 0),
(8, '炸串', 4, '', '', 50, 1677759695, 1677759695, 0),
(9, '火锅', 4, '', '', 50, 1677759695, 1677759695, 0),
(10, '生鲜', 0, '', '', 50, 1677759860, 1677759860, 0),
(11, '蔬菜', 10, '', '', 50, 1677759872, 1677759872, 0),
(12, '豆制品', 10, '', '', 50, 1677759872, 1677759872, 0),
(13, '水果', 10, '', '', 50, 1677759872, 1677759872, 0),
(14, '胡萝卜', 11, '1111', '22222', 50, 1678072620, 1678072620, 0),
(15, '粮油123', 10, '1', '2', 50, 1678337471, 1678337471, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item`
--

CREATE TABLE `goods_item` (
  `item_id` int UNSIGNED NOT NULL COMMENT '商品ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品标题',
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '简述',
  `keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '商品关键字',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `thumbnails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品图片',
  `video_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '展示视频',
  `cat_id` int UNSIGNED NOT NULL COMMENT '商品分类',
  `sales` int NOT NULL DEFAULT '0' COMMENT '虚拟购买量',
  `price` decimal(8,2) NOT NULL COMMENT '商品价格',
  `market_price` decimal(8,2) DEFAULT '0.00' COMMENT '市场价格',
  `cost_price` decimal(19,2) DEFAULT '0.00' COMMENT '成本价',
  `state` tinyint NOT NULL DEFAULT '0' COMMENT '审核状态 -1 审核失败 0 未审核 1 审核成功',
  `is_attribute` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '启用商品规格',
  `sortrank` int NOT NULL DEFAULT '999' COMMENT '排序',
  `goods_status` tinyint DEFAULT '1' COMMENT '商品状态',
  `marketing_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '促销类型',
  `marketing_id` int NOT NULL DEFAULT '0' COMMENT '促销活动ID',
  `marketing_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品促销价格',
  `min_buy` int NOT NULL DEFAULT '1' COMMENT '最少买几件',
  `max_buy` int NOT NULL DEFAULT '0' COMMENT '限购数量',
  `is_stock_visible` int NOT NULL DEFAULT '1' COMMENT '库存显示',
  `product_type_id` int NOT NULL DEFAULT '0' COMMENT '商品类型',
  `spec_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '商品规格',
  `match_point` float DEFAULT '5' COMMENT '实物与描述相符（根据评价计算）',
  `match_ratio` float DEFAULT '100' COMMENT '实物与描述相符（根据评价计算）百分比',
  `sale_date` int DEFAULT '0' COMMENT '上下架时间',
  `is_virtual` tinyint(1) DEFAULT '0' COMMENT '是否虚拟商品',
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '件' COMMENT '商品单位',
  `status` tinyint DEFAULT '1' COMMENT '状态',
  `create_time` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品表';

--
-- 转存表中的数据 `goods_item`
--

INSERT INTO `goods_item` (`item_id`, `title`, `sub_title`, `keywords`, `description`, `thumbnails`, `video_url`, `cat_id`, `sales`, `price`, `market_price`, `cost_price`, `state`, `is_attribute`, `sortrank`, `goods_status`, `marketing_type`, `marketing_id`, `marketing_price`, `min_buy`, `max_buy`, `is_stock_visible`, `product_type_id`, `spec_data`, `match_point`, `match_ratio`, `sale_date`, `is_virtual`, `unit`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, NULL, 5, 100, 0, 0, '件', 1, 0, 0, 0),
(2, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, NULL, 5, 100, 0, 0, '件', 1, 0, 0, 0),
(3, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, NULL, 5, 100, 0, 0, '件', 1, 0, 0, 0),
(4, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, NULL, 5, 100, 0, 0, '件', 1, 0, 0, 0),
(5, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '[{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"}]},{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":6,\"spec_id\":2,\"title\":\"M码\"}]}]', 5, 100, 0, 0, '件', 1, 0, 0, 0),
(7, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '[{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"}]},{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":6,\"spec_id\":2,\"title\":\"M码\"}]}]', 5, 100, 0, 0, '件', 1, 1677828694, 1677828694, 0),
(8, '6346', '346346', '436346', '2342352365', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '[{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"}]},{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":6,\"spec_id\":2,\"title\":\"M码\"}]}]', 5, 100, 0, 0, '件', 1, 1677828727, 1677828727, 0),
(9, '秋装新款五分袖针织衫雪纺半身裙拼接假两件套连衣裙', '假两件套连衣裙', '雪纺连衣裙,秋装裙,裙子,拼接裙', '秋装新款五分袖针织衫雪纺半身裙拼接假两件套连衣裙秋装新款五分袖针织衫雪纺半身裙拼接假两件套连衣裙', '[\"http://test-cdn.zhanshop.cn/202332/167773431149455616.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431143548266.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777343113873423.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431132328354.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431126212558.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342892061435340.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342891541422744.jpg\"]', '', 3, 0, '130.00', '220.00', '60.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '[{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":3,\"spec_id\":1,\"title\":\"蓝色\"},{\"id\":2,\"spec_id\":1,\"title\":\"白色\"},{\"id\":1,\"spec_id\":1,\"title\":\"粉色\"}]},{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":8,\"spec_id\":2,\"title\":\"XL码\"},{\"id\":7,\"spec_id\":2,\"title\":\"L码\"},{\"id\":6,\"spec_id\":2,\"title\":\"M码\"},{\"id\":5,\"spec_id\":2,\"title\":\"S码\"}]}]', 5, 100, 0, 0, '件', 1, 1677833563, 1677833563, 0),
(10, '一罐杏仁桃法式白色连衣裙春夏长袖设计感小众仙气网纱长裙仙女裙 ', '仙女裙 ', '仙女裙,白色连衣裙', '', '[\"http://test-cdn.zhanshop.cn/202332/1677734290691166333.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342909001695891.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342906971671200.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342907611684087.jpg\",\"http://test-cdn.zhanshop.cn/202332/1677734290588165342.jpg\"]', '', 3, 0, '160.00', '300.00', '80.00', 0, '0', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '{\"1\":{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"}]},\"2\":{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":7,\"spec_id\":2,\"title\":\"L码\"},{\"id\":6,\"spec_id\":2,\"title\":\"M码\"},{\"id\":5,\"spec_id\":2,\"title\":\"S码\"}]}}', 5, 100, 0, 0, '件', 1, 1677841598, 1677846168, 0),
(11, '灯芯绒背带裙两件套女装春秋季2023年新款奶fufu套装裙减龄连衣裙', '减龄连衣裙', '减龄连衣裙', '', '[\"http://test-cdn.zhanshop.cn/202332/16777342882891301173.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342881981284440.jpg\",\"http://test-cdn.zhanshop.cn/202332/1677734286912110190.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '{\"1\":{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"},{\"id\":1,\"spec_id\":1,\"title\":\"粉色\"}]},\"2\":{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":6,\"spec_id\":2,\"title\":\"M码\"}]}}', 5, 100, 0, 0, '件', 1, 1677844489, 1677896874, 0),
(12, '888888888888888', '456456', '645646456,45,6,456,456456', '', '[\"http://test-cdn.zhanshop.cn/202332/16777342906971671200.jpg\",\"http://test-cdn.zhanshop.cn/202332/1677734290155157353.jpg\",\"http://test-cdn.zhanshop.cn/202332/16777342894591475512.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '1', 999, 0, '0', 0, '0.00', 1, 0, 1, 1, '{\"1\":{\"id\":1,\"title\":\"颜色\",\"show_type\":3,\"value\":[{\"id\":2,\"spec_id\":1,\"title\":\"白色\"}]},\"2\":{\"id\":2,\"title\":\"尺码\",\"show_type\":1,\"value\":[{\"id\":7,\"spec_id\":2,\"title\":\"L码\"},{\"id\":6,\"spec_id\":2,\"title\":\"M码\"}]}}', 5, 100, 0, 0, '件', 1, 1677847450, 1677852348, 0),
(13, 'er5234234', '234234234', '324234423', '', '[\"http://test-cdn.zhanshop.cn/202332/1677734312208149776.jpg\",\"http://test-cdn.zhanshop.cn/202332/167773431165179596.jpg\",\"http://test-cdn.zhanshop.cn/202332/1677734290691166333.jpg\"]', '', 3, 0, '100.00', '1000.00', '100.00', 0, '1', 999, 1, '0', 0, '0.00', 1, 0, 1, 1, '{\"1\":{\"id\":1,\"title\":\"颜色\",\"show_type\":\"3\",\"value\":[{\"id\":11,\"spec_id\":1,\"title\":\"白\"}]},\"2\":{\"id\":2,\"title\":\"尺码\",\"show_type\":\"1\",\"value\":[{\"id\":7,\"spec_id\":2,\"title\":\"L码\"}]}}', 5, 100, 0, 0, '件', 1, 1677896919, 1678336994, 0),
(14, '啊', '22', '', '222', '[\"http://test-cdn.zhanshop.cn/202334/16779185946331139107.jpg\"]', '', 2, 0, '33.00', '3.00', '11.00', 0, '1', 999, 1, '0', 0, '0.00', 122, 2, 1, 1, '{\"1\":{\"id\":1,\"title\":\"颜色\",\"show_type\":\"3\",\"value\":[{\"id\":11,\"spec_id\":1,\"title\":\"白\"},{\"id\":2,\"spec_id\":1,\"title\":\"白色\"},{\"id\":1,\"spec_id\":1,\"title\":\"粉色\"}]},\"2\":{\"id\":2,\"title\":\"尺码\",\"show_type\":\"1\",\"value\":[{\"id\":7,\"spec_id\":2,\"title\":\"L码\"},{\"id\":6,\"spec_id\":2,\"title\":\"M码\"},{\"id\":5,\"spec_id\":2,\"title\":\"S码\"}]}}', 5, 100, 0, 0, '件', 1, 1678072542, 1678072542, 0),
(15, '234777', '234234', '234', '', '[\"http://test-cdn.zhanshop.cn/202332/16777342907611684087.jpg\",\"http://test-cdn.zhanshop.cn/202332/1677734290588165342.jpg\"]', '', 3, 0, '100.00', '100.00', '100.00', 0, '0', 999, 1, '0', 0, '0.00', 1, 0, 1, 0, NULL, 5, 100, 0, 0, '件', 1, 1678073150, 1678340089, 0),
(16, '234', '234', '324', '234234', '[\"http://test-cdn.zhanshop.cn/202339/167833817590017908.jpg\",\"http://test-cdn.zhanshop.cn/202334/16779185946331139107.jpg\"]', '', 3, 0, '3.00', '34234.00', '234.00', 0, '0', 999, 1, '0', 0, '0.00', 1, 0, 1, 0, NULL, 5, 100, 0, 0, '件', 1, 1678340369, 1678340369, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_count`
--

CREATE TABLE `goods_item_count` (
  `item_id` int NOT NULL COMMENT '商品id',
  `sold_quantity` int NOT NULL DEFAULT '0' COMMENT '销量',
  `total_comments` int NOT NULL DEFAULT '0' COMMENT '评论次数',
  `total_praise` int NOT NULL DEFAULT '0' COMMENT '好评次数',
  `total_neutral` int NOT NULL DEFAULT '0' COMMENT '中评次数',
  `total_bad` int NOT NULL DEFAULT '0' COMMENT '差评次数',
  `total_buy` int NOT NULL DEFAULT '0' COMMENT '购买次数',
  `visit_pv` int NOT NULL DEFAULT '0' COMMENT '浏览量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='商品附加表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `goods_item_count`
--

INSERT INTO `goods_item_count` (`item_id`, `sold_quantity`, `total_comments`, `total_praise`, `total_neutral`, `total_bad`, `total_buy`, `visit_pv`) VALUES
(7, 0, 0, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0, 0, 0),
(16, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_detail`
--

CREATE TABLE `goods_item_detail` (
  `item_id` int NOT NULL COMMENT '商品id',
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '展示视频',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品详情'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='商品详情' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `goods_item_detail`
--

INSERT INTO `goods_item_detail` (`item_id`, `video`, `detail`) VALUES
(7, '', '<p>34634346<br/></p>'),
(8, '', '<p>34634346<br/></p>'),
(9, '', '<p style=\"text-align: center;\"><img src=\"https://img.alicdn.com/imgextra/i4/263817957/O1CN01wm6pmy28eM9bIDwnC_!!263817957.jpg\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01C8Ga6S28eM9bmwPuc_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01wtD31h28eMAJ3Tr5t_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01rCp0F928eM9XesvYK_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i2/263817957/O1CN01XGrGZx28eM9TNnffq_!!263817957.jpg\" class=\"\"/></p><p><img class=\"desc_anchor\" id=\"desc-module-2\" src=\"https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif\"/></p><div style=\"background-color: #ffffff;margin: 0 auto;overflow: hidden;color: #555555;width: 750.0px;font-family: 黑体;\"><div><div style=\"font-size: 0.0px;\"><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01id1IrI28eMB1tSPFq_!!263817957.jpg\" class=\"\"/></div></div></div><p><img class=\"desc_anchor\" id=\"desc-module-3\" src=\"https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif\"/></p><p style=\"text-align: center;\"><img src=\"https://img.alicdn.com/imgextra/i4/263817957/O1CN01F1Gc8A28eM9Xeufho_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN014q6mnD28eM9aOr9zV_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01Lz7SvE28eMANviMUm_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01L4C4hV28eM9Vb1kzx_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01yqtWjN28eM9YOUppc_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01XZjFRe28eM9VAC1hZ_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01hMQ2sL28eMB1uiDVv_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01cWeGy828eMB4S9lTD_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01WrZGwl28eMB8UpKZL_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01g3x87y28eMB4SAu9Y_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i3/263817957/O1CN01mpcJuM28eMB60JFEN_!!263817957.jpg\" class=\"\"/></p><p><img class=\"desc_anchor\" id=\"desc-module-4\" src=\"https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif\"/></p><p style=\"text-align: center;\"><img src=\"https://img.alicdn.com/imgextra/i4/263817957/O1CN01lul3bf28eMAsPW0Xx_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i4/263817957/O1CN013tHuzs28eMAwqxsPi_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN01LCsDEz28eMAufJCnY_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i4/263817957/O1CN01uopCIs28eMAyJ8UzU_!!263817957.jpg\" class=\"\"/><img src=\"https://img.alicdn.com/imgextra/i1/263817957/O1CN019ksgfx28eMAxgYV14_!!263817957.jpg\" class=\"\"/></p><p><br/></p>'),
(10, '', '<div style=\"display: block;\"><div class=\"ItemDetail--itemDesc--2wB6s_i\"><div class=\"ItemDetail--attrs--3t-mTb3\"><div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">品牌：歌帛萱</span><span class=\"Attrs--attr--33ShB6X\">适用年龄：18-24周岁</span><span class=\"Attrs--attr--33ShB6X\">尺码：S M L XL 2XL 3XL</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">图案：纯色</span><span class=\"Attrs--attr--33ShB6X\">风格：通勤</span><span class=\"Attrs--attr--33ShB6X\">通勤：韩版</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">领型：V领</span><span class=\"Attrs--attr--33ShB6X\">腰型：高腰</span><span class=\"Attrs--attr--33ShB6X\">衣门襟：套头</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">颜色分类：乳白色</span><span class=\"Attrs--attr--33ShB6X\">袖型：常规</span><span class=\"Attrs--attr--33ShB6X\">组合形式：单件</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">货号：GBXLYQT579</span><span class=\"Attrs--attr--33ShB6X\">裙型：公主裙</span><span class=\"Attrs--attr--33ShB6X\">适用季节：春季</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">年份季节：2023年春季</span><span class=\"Attrs--attr--33ShB6X\">袖长：长袖</span><span class=\"Attrs--attr--33ShB6X\">裙长：中长裙</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">流行元素/工艺：抽褶</span><span class=\"Attrs--attr--33ShB6X\">款式：衬衫裙</span><span class=\"Attrs--attr--33ShB6X\">销售渠道类型：纯电商(只在线上销售)</span></div><div class=\"Attrs--attrSection--2_G8xGa\"><span class=\"Attrs--attr--33ShB6X\">廓形：A型</span><span class=\"Attrs--attr--33ShB6X\">材质成分：聚酯纤维100%</span></div></div></div><div class=\"desc-root\"><div class=\"descV8-container\"><div class=\"descV8-singleImage\"><a href=\"https://item.taobao.com/item.htm?&id=696434425754&spm=a2141.7631564.1999060322.hot_area2\" class=\"descV8-hotArea\" style=\"width: 81.0483880341053px;\n                height: 106.45161337189136px;\n                top: 164.51612733785183px;\n                left: 33.87096896767616px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=695615677430&spm=a2141.7631564.1999060322.hot_area3\" class=\"descV8-hotArea\" style=\"width: 81.04838244616985px;\n                height: 106.45161337189136px;\n                top: 54.435485168810814px;\n                left: 52.0161297172308px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=695347248019&spm=a2141.7631564.1999060322.hot_area4\" class=\"descV8-hotArea\" style=\"width: 81.0483880341053px;\n                height: 106.45161337189136px;\n                top: 164.51612733785183px;\n                left: 124.59677830338478px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=695490138323&spm=a2141.7631564.1999060322.hot_area5\" class=\"descV8-hotArea\" style=\"width: 81.0483992099762px;\n                height: 106.45161004616848px;\n                top: 49.596774563073154px;\n                left: 143.95160973072052px;\"></a><a href=\"https://market.m.taobao.com/app/miniapp-biz/qrcode/index.html?_ariver_appid=3000000026244003&page=pages%2Flanding%2Flanding%3FpageId%3D1456075&spm=a2141.7631564.1999060322.hot_area6\" class=\"descV8-hotArea\" style=\"width: 307.2580397129059px;\n                height: 293.95161525556637px;\n                top: 10.887096368617588px;\n                left: 228.62903773784637px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area7\" class=\"descV8-hotArea\" style=\"width: 105.24193570017815px;\n                height: 129.43548459199167px;\n                top: 314.516139487105px;\n                left: 124.59677830338478px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area8\" class=\"descV8-hotArea\" style=\"width: 116.12902872730047px;\n                height: 129.43548459199167px;\n                top: 314.516139487105px;\n                left: 4.838709603063762px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area9\" class=\"descV8-hotArea\" style=\"width: 111.2903282046318px;\n                height: 130.64516972630256px;\n                top: 313.30645435279416px;\n                left: 234.67741906642914px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area10\" class=\"descV8-hotArea\" style=\"width: 94.35481578111649px;\n                height: 129.43548459199167px;\n                top: 314.516139487105px;\n                left: 348.38709980249405px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area11\" class=\"descV8-hotArea\" style=\"width: 102.82257199287415px;\n                height: 130.64516972630256px;\n                top: 313.30645435279416px;\n                left: 447.5806653499603px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area12\" class=\"descV8-hotArea\" style=\"width: 91.93548560142517px;\n                height: 129.43548459199167px;\n                top: 314.516139487105px;\n                left: 560.0806474685669px;\"></a><a href=\"https://shop408567270.taobao.com?&spm=a2141.7631564.1999060322.hot_area13\" class=\"descV8-hotArea\" style=\"width: 83.4677517414093px;\n                height: 130.64516972630256px;\n                top: 313.30645435279416px;\n                left: 658.0645143985748px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=696643887443&spm=a2141.7631564.1999060322.hot_area14\" class=\"descV8-hotArea\" style=\"width: 181.45161867141724px;\n                height: 291.53225995269753px;\n                top: 13.30645167148642px;\n                left: 549.1935610771179px;\"></a>\n &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN011J1ru92E9ZNF65zJ0_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><a href=\"https://item.taobao.com/item.htm?&id=696132995066&spm=a2141.7631564.1999060322.hot_area2\" class=\"descV8-hotArea\" style=\"width: 229.83869165182114px;\n                height: 301.2097030878067px;\n                top: 770.5644987523556px;\n                left: 260.08064299821854px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=698392593781&spm=a2141.7631564.1999060322.hot_area3\" class=\"descV8-hotArea\" style=\"width: 232.25808888673782px;\n                height: 309.67740565538406px;\n                top: 445.1612949371338px;\n                left: 264.91934806108475px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=695427918279&spm=a2141.7631564.1999060322.hot_area4\" class=\"descV8-hotArea\" style=\"width: 233.46774280071259px;\n                height: 304.8387184739113px;\n                top: 771.7741705477238px;\n                left: 516.5322571992874px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=696196840867&spm=a2141.7631564.1999060322.hot_area5\" class=\"descV8-hotArea\" style=\"width: 239.51612412929535px;\n                height: 292.74193570017815px;\n                top: 777.8225943446159px;\n                left: 0px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=690974404696&spm=a2141.7631564.1999060322.hot_area6\" class=\"descV8-hotArea\" style=\"width: 238.3064478635788px;\n                height: 310.88707745075226px;\n                top: 445.1612949371338px;\n                left: 506.854847073555px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=696259220909&spm=a2141.7631564.1999060322.hot_area7\" class=\"descV8-hotArea\" style=\"width: 238.3064478635788px;\n                height: 295.16127929091454px;\n                top: 133.06451328098774px;\n                left: 506.854847073555px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=696260020195&spm=a2141.7631564.1999060322.hot_area8\" class=\"descV8-hotArea\" style=\"width: 234.6774145262316px;\n                height: 302.4193424731493px;\n                top: 133.06451328098774px;\n                left: 4.838709603063762px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=695916486398&spm=a2141.7631564.1999060322.hot_area9\" class=\"descV8-hotArea\" style=\"width: 235.88710092008114px;\n                height: 308.4677014499903px;\n                top: 450.00001452863216px;\n                left: 16.93548448383808px;\"></a><a href=\"https://item.taobao.com/item.htm?&id=698399517788&spm=a2141.7631564.1999060322.hot_area10\" class=\"descV8-hotArea\" style=\"width: 231.04841262102127px;\n                height: 292.74193570017815px;\n                top: 133.06451328098774px;\n                left: 266.1290243268013px;\"></a>\n &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN01FZAXl12E9ZNJ0qvev_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i2/2206662258702/O1CN01JXcLP72E9ZM7DhAcN_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN01Dd3RlN2E9ZM5y7as6_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN01n9Ri682E9ZM5XszTc_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN012CuQAN2E9ZM3vpYvf_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN01nFETJC2E9ZMAhcqym_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i2/2206662258702/O1CN01pbkp1S2E9ZM7DRveA_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN017fbCso2E9ZM8pt7cb_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN01vB9XOc2E9ZM5y7asK_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN01F77Yw72E9ZM0pgQPI_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN01ZYKEcx2E9ZMCkAejy_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN01FOYETo2E9ZMBt7KpS_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i1/2206662258702/O1CN01Ew7eOw2E9ZM1ag7qf_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i4/2206662258702/O1CN01UGb4Uz2E9ZM86oaEs_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://img.alicdn.com/imgextra/i3/2206662258702/O1CN01T38DEo2E9ZM0phMZY_!!2206662258702.jpg\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div><div class=\"descV8-singleImage\"><img src=\"https://gw.alicdn.com/tfs/TB1d0h2qVYqK1RjSZLeXXbXppXa-1125-960.png?getAvatar=avatar\" class=\"descV8-singleImage-image lazyload\"/>\n &nbsp; &nbsp;</div></div></div></div></div><p><br/></p>'),
(11, '', '<p>433333333333333<br/></p>'),
(12, '', '<p>dssdfsdf <br/></p>'),
(13, '', '<p>111111111111111<br/></p>'),
(14, '\"\"', '<p>123</p>'),
(15, '{\"video_id\":76,\"thumbnail\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4?vframe/jpg/offset/3\",\"url\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4\",\"original\":\"e5a951291fbf9cd559935b56ed624a00.mp4\",\"size\":982579,\"duration\":8}', '<p>23423423<br/></p>'),
(16, '{\"video_id\":76,\"thumbnail\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4?vframe/jpg/offset/3\",\"url\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4\",\"original\":\"e5a951291fbf9cd559935b56ed624a00.mp4\",\"size\":982579,\"duration\":8}', '<p>234234234<br/></p>');

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_point`
--

CREATE TABLE `goods_item_point` (
  `item_id` bigint UNSIGNED NOT NULL COMMENT '商品ud',
  `point_exchange_type` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '积分兑换类型',
  `max_use_point` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '最大可使用积分'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='商品积分购买配置';

--
-- 转存表中的数据 `goods_item_point`
--

INSERT INTO `goods_item_point` (`item_id`, `point_exchange_type`, `max_use_point`) VALUES
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0),
(14, 0, 111),
(15, 0, 0),
(16, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_sku`
--

CREATE TABLE `goods_item_sku` (
  `id` bigint UNSIGNED NOT NULL COMMENT '货品id',
  `item_id` int UNSIGNED DEFAULT '0' COMMENT '商品id',
  `name` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'sku串名称',
  `picture` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '主图',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `market_price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `cost_price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `stock` int NOT NULL DEFAULT '0' COMMENT '库存',
  `sortrank` int DEFAULT '1999' COMMENT '排序',
  `spec` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '规格',
  `status` tinyint DEFAULT '1' COMMENT '状态[-1:删除;0:禁用;1启用]',
  `create_time` int UNSIGNED DEFAULT '0' COMMENT '创建时间',
  `update_time` int UNSIGNED DEFAULT '0' COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品sku表';

--
-- 转存表中的数据 `goods_item_sku`
--

INSERT INTO `goods_item_sku` (`id`, `item_id`, `name`, `picture`, `price`, `market_price`, `cost_price`, `stock`, `sortrank`, `spec`, `status`, `create_time`, `update_time`) VALUES
(1, 5, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-2', 1, 0, 0),
(3, 7, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-2', 1, 0, 0),
(4, 8, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-2', 1, 0, 0),
(5, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '7-2', 1, 0, 0),
(6, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '7-1', 1, 0, 0),
(7, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '7-3', 1, 0, 0),
(8, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '6-2', 1, 0, 0),
(9, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '6-1', 1, 0, 0),
(10, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '6-3', 1, 0, 0),
(11, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '5-2', 1, 0, 0),
(12, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '5-1', 1, 0, 0),
(13, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '5-3', 1, 0, 0),
(14, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '8-2', 1, 0, 0),
(15, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '8-1', 1, 0, 0),
(16, 9, '', '', '130.00', '220.00', '60.00', 100, 1999, '8-3', 1, 0, 0),
(17, 10, '', '', '160.00', '300.00', '80.00', 100, 1999, '7-2', 1, 0, 0),
(21, 11, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-2', 1, 0, 0),
(22, 11, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-1', 1, 0, 0),
(23, 12, '', '', '100.00', '100.00', '100.00', 100, 1999, '7-2', 1, 0, 0),
(24, 12, '', '', '100.00', '100.00', '100.00', 100, 1999, '6-2', 1, 0, 0),
(25, 13, '', '', '100.00', '1000.00', '100.00', 100, 1999, '7-11', 1, 0, 0),
(26, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '7-11', 0, 0, 0),
(27, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '7-2', 1, 0, 0),
(28, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '7-1', 1, 0, 0),
(29, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '6-11', 1, 0, 0),
(30, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '6-2', 1, 0, 0),
(31, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '6-1', 1, 0, 0),
(32, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '5-11', 1, 0, 0),
(33, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '5-2', 1, 0, 0),
(34, 14, '', '', '33.00', '3.00', '11.00', 22, 1999, '5-1', 1, 0, 0),
(35, 15, '', '', '100.00', '100.00', '100.00', 100, 1999, '', 1, 0, 0),
(36, 16, '', '', '3.00', '34234.00', '234.00', 32, 1999, '', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_spec`
--

CREATE TABLE `goods_item_spec` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规格名称',
  `show_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '显示方式',
  `sortrank` int NOT NULL DEFAULT '50' COMMENT '排序',
  `explain` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '规格说明',
  `create_time` int UNSIGNED DEFAULT '0' COMMENT '创建时间',
  `updated_time` int UNSIGNED DEFAULT '0' COMMENT '修改时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统规格表';

--
-- 转存表中的数据 `goods_item_spec`
--

INSERT INTO `goods_item_spec` (`id`, `title`, `show_type`, `sortrank`, `explain`, `create_time`, `updated_time`, `delete_time`) VALUES
(1, '颜色', 'text', 50, '鞋服专用', 1677741017, 0, 0),
(2, '尺码', '1', 50, '鞋服专用', 1677741036, 0, 0),
(4, '粗细', 'text', 50, '8888', 1677926785, 0, 0),
(5, '5555', 'text', 50, '23423433', 1677926905, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_spec_value`
--

CREATE TABLE `goods_item_spec_value` (
  `id` int UNSIGNED NOT NULL,
  `spec_id` int NOT NULL COMMENT '规格id',
  `title` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '选项名称',
  `sortrank` int NOT NULL DEFAULT '999' COMMENT '排序',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间',
  `create_time` int UNSIGNED DEFAULT '0' COMMENT '创建时间',
  `update_time` int UNSIGNED DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统规格值表';

--
-- 转存表中的数据 `goods_item_spec_value`
--

INSERT INTO `goods_item_spec_value` (`id`, `spec_id`, `title`, `sortrank`, `delete_time`, `create_time`, `update_time`) VALUES
(1, 1, '粉色', 999, 0, 0, 0),
(2, 1, '白色', 999, 0, 0, 0),
(3, 1, '蓝色', 999, 0, 0, 0),
(4, 1, '黑色', 999, 0, 0, 0),
(5, 2, 'S码', 999, 0, 0, 0),
(6, 2, 'M码', 999, 0, 0, 0),
(7, 2, 'L码', 999, 0, 0, 0),
(8, 2, 'XL码', 999, 0, 0, 0),
(9, 2, 'XXL码', 999, 0, 0, 0),
(10, 2, 'XXXL码', 999, 0, 0, 0),
(11, 1, '白123', 999, 0, 0, 0),
(25, 4, '小粗', 999, 0, 1677926785, 0),
(26, 4, '大粗', 999, 0, 1677926785, 0),
(27, 5, '234333', 999, 0, 1677926905, 0),
(28, 5, '234234', 999, 1678337657, 1677926905, 0);

-- --------------------------------------------------------

--
-- 表的结构 `goods_item_type`
--

CREATE TABLE `goods_item_type` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类型名称',
  `spec_ids` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '关联规格',
  `sortrank` int DEFAULT '999' COMMENT '排序',
  `create_time` int UNSIGNED DEFAULT '0' COMMENT '创建时间',
  `update_time` int UNSIGNED DEFAULT '0' COMMENT '修改时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统商品类型表';

--
-- 转存表中的数据 `goods_item_type`
--

INSERT INTO `goods_item_type` (`id`, `title`, `spec_ids`, `sortrank`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '鞋服', '[\"1\",\"2\"]', 999, 0, 0, 0),
(2, '测试123', '[\"1\",\"2\",\"4\"]', 999, 1677895452, 1677895452, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_audios`
--

CREATE TABLE `system_audios` (
  `audio_id` int NOT NULL COMMENT '文件id',
  `original` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '源文件名',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件地址',
  `size` int NOT NULL COMMENT ' 大小(字节) ',
  `duration` int NOT NULL DEFAULT '0' COMMENT '时长(秒)',
  `create_time` int NOT NULL COMMENT '创建时间',
  `delete_time` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='音频表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_config`
--

CREATE TABLE `system_config` (
  `varname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '' COMMENT '变量名',
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '值',
  `sortrank` int NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system_config`
--

INSERT INTO `system_config` (`varname`, `title`, `value`, `sortrank`) VALUES
('app_privacy_policy', 'app_privacy_policy', '<p>324WEFWEFSDFSDF<br/></p>', 50),
('app_user_agreement', 'app_user_agreement', '<p>123123123<br/></p>', 50);

-- --------------------------------------------------------

--
-- 表的结构 `system_errorlog`
--

CREATE TABLE `system_errorlog` (
  `error_id` int NOT NULL COMMENT '错误id',
  `errorurl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '错误url',
  `errorcode` int NOT NULL COMMENT '错误码',
  `errormsg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '错误信息',
  `error_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '错误文件',
  `error_line` mediumint NOT NULL COMMENT '错误行号',
  `create_time` int NOT NULL COMMENT '发生时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='系统错误日志' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_files`
--

CREATE TABLE `system_files` (
  `file_id` int NOT NULL COMMENT '文件id',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件地址',
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '源文件名',
  `size` int NOT NULL COMMENT ' 大小(字节) ',
  `create_time` int NOT NULL COMMENT '创建时间',
  `delete_time` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='文件表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_images`
--

CREATE TABLE `system_images` (
  `image_id` int NOT NULL COMMENT '文件id',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件地址',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文件名',
  `original` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '源文件名',
  `dir_id` int NOT NULL DEFAULT '0' COMMENT ' 图片分类id ',
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文件类型',
  `size` int NOT NULL COMMENT ' 大小(字节) ',
  `create_time` int NOT NULL COMMENT '创建时间',
  `delete_time` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='文件表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int UNSIGNED NOT NULL COMMENT 'id',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作ip',
  `date` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `event` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事件',
  `body` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_menu`
--

CREATE TABLE `system_menu` (
  `id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '菜单id',
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单名称',
  `parent_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '父级菜单',
  `target` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '打开方式',
  `icon` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图标',
  `table_names` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '关联schma',
  `pk` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件id',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段标题',
  `pid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '层字段',
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '打开外部页面',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `sortrank` mediumint NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='系统菜单' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system_menu`
--

INSERT INTO `system_menu` (`id`, `title`, `parent_id`, `target`, `icon`, `table_names`, `pk`, `name`, `pid`, `page`, `is_hidden`, `sortrank`, `create_time`) VALUES
('activity- manage', '活动管理', 'app-activity', 'table', 'mdi mdi-circle-outline', 'course_activity', 'activity_id', NULL, NULL, NULL, 0, 50, '1639533193'),
('activity-reglog', '活动报名', 'app-activity', 'table', 'mdi mdi-circle-outline', 'course_activity_enroll', 'id', NULL, NULL, NULL, 0, 50, '1639533145'),
('app_push', 'app推送', 'coo', 'table', 'mdi mdi-radiobox-blank', 'app_push', 'push_id', '', '', '', 0, 50, '1677686948'),
('app-release', 'APP发行', 'coo', 'table', 'mdi mdi-circle-outline', 'app_version', 'id', NULL, NULL, NULL, 0, 50, '1639532957'),
('article', '分类信息', '0', '_self', 'mdi mdi-file-document-box', '', '', '', '', '', 0, 50, '1677927571'),
('article_content', '文章列表', 'article', 'table', '', 'article_content', 'id', '', '', '', 0, 50, '1677927690'),
('base_conf', '基本参数', 'sys', 'config', '', 'system_config', 'varname', 'title', '', '', 0, 50, '1677987973'),
('community-topic', '话题管理', 'community', 'table', 'mdi mdi-circle-outline', 'user_community_topic', 'id', NULL, NULL, NULL, 0, 50, '1640311676'),
('coo', '产品运营', '0', '_self', 'mdi mdi-desktop-mac', '', '', '', '', '', 0, 50, '1638862099'),
('courseware', '课件合辑', 'flow-lesson', 'table', '', 'course_courseware', 'courseware_id', NULL, NULL, NULL, 1, 50, '1638862127'),
('everyday', '每日冥想', 'flow-lesson', 'table', 'mdi mdi-circle-outline', 'course_courseware', 'courseware_id', NULL, NULL, NULL, 1, 50, '1650258338'),
('flow_teacher', '冥想导师', 'flow-lesson', 'table', '', 'course_author', 'author_id', 'nick', NULL, NULL, 1, 50, '1638862134'),
('flow-everyday-report', '每日冥想报', 'flow-report', 'table', 'mdi mdi-circle-outline', 'daily_meditation', 'id', NULL, NULL, NULL, 0, 50, '1639467894'),
('flow-play-report', '冥想播放报告', 'flow-report', 'table', 'mdi mdi-circle-outline', 'meditation_play_statistic', 'id', NULL, NULL, NULL, 0, 50, '1639533299'),
('goods', '商品管理', '0', '_self', 'mdi mdi-shopping', '', '', NULL, NULL, NULL, 0, 50, '1638862098'),
('goods_category', '商品类目', 'goods', 'treetable', '', 'goods_category', 'cat_id', 'cat_name', 'parent_id', NULL, 0, 50, '1638862138'),
('goods_config', '商品配置', 'goods', '_self', '', '', NULL, '', '', NULL, 0, 50, '1677736984'),
('goods_item', '商品列表', 'goods', 'table', '', 'goods_item,goods_item_sku,goods_item_detail,goods_item_point', 'item_id', 'title', '', NULL, 0, 50, '1638862118'),
('goods_spec', '商品规格', 'goods_config', 'table', '', 'goods_item_spec', 'id', 'title', '', NULL, 0, 50, '1677739095'),
('goods_type', '商品类型', 'goods_config', 'table', '', 'goods_item_type', 'id', 'title', '', NULL, 0, 50, '1677737241'),
('json-decode', 'JSON格式化', 'web-tool', '_self', '', '', '', NULL, NULL, NULL, 0, 50, '1638862126'),
('lesson', '课程文档', 'flow-lesson', 'table', 'mdi mdi-circle-outline', 'course_lesson', 'lesson_id', NULL, NULL, NULL, 1, 50, '1639709589'),
('lesson_category', '冥想类目', 'flow-lesson', 'treetable', '', 'course_lesson_category', 'cat_id', 'cat_name', 'parent_id', NULL, 1, 50, '1638862142'),
('sys', '系统管理', '0', '_self', 'mdi mdi-settings', '', '', NULL, NULL, NULL, 0, 50, '1638862106'),
('sys_audio', '音频管理', 'sys_res', 'audio', '', 'system_audios', 'audio_id', 'original', '', NULL, 0, 50, '1638862145'),
('sys_document', '附件管理', 'sys_res', 'table', 'mdi mdi-circle-outline', 'system_files', 'file_id', 'original', '', NULL, 0, 50, '1639469759'),
('sys_image', '图片管理', 'sys_res', 'image', '', 'system_images', 'image_id', 'original', '', NULL, 0, 50, '1638862146'),
('sys_menu', '系统菜单', 'sys', 'treetable', '', 'system_menu', 'id', 'title', 'parent_id', NULL, 0, 50, '1638862128'),
('sys_res', '资源管理', 'sys', '_self', '', '', 'id', NULL, NULL, NULL, 0, 50, '1638862122'),
('sys_role', '系统角色', 'sys', 'table', '', 'system_role', 'role_id', 'role_name', NULL, NULL, 0, 50, '1638862129'),
('sys_user', '系统用户', 'sys', 'table', '', 'system_user', 'user_id', NULL, NULL, NULL, 0, 50, '1638862130'),
('sys_video', '视频管理', 'sys_res', 'video', '', 'system_videos', 'video_id', 'original', '', NULL, 0, 50, '1638862147'),
('test', '测试表格', 'sys', 'table', '', 'test_table', 'id', '_hidden', '', NULL, 0, 50, '1677901462'),
('topic-viewpoint', '话题观点', 'community', 'table', 'mdi mdi-circle-outline', 'user_note', 'note_id', NULL, NULL, NULL, 0, 50, '1640328154'),
('trades', '交易管理', '0', '_self', 'mdi mdi-credit-card', '', '', NULL, NULL, NULL, 0, 50, '1638862103'),
('trades_order', '交易订单', 'trades', 'table', 'mdi mdi-circle-outline', 'trades_order', 'order_id', NULL, NULL, NULL, 0, 50, '1639533831'),
('user', '用户管理', '0', '_self', 'mdi mdi-account-box', '', '', '', '', '', 0, 50, '1638862097'),
('user_info', '会员用户', 'user', 'table', '', 'user_info', 'user_id', 'nick', '', NULL, 0, 50, '1638862119'),
('user_payment', '付费会员', 'user', '_self', '', '', '', '', '', '', 0, 50, '1678029919'),
('user_payment_card', '付费会员卡密', 'user_payment', 'table', '', 'user_payment_card', 'id', 'title', '', '', 0, 50, '1678030103'),
('user_payment_type', '付费会员类型', 'user_payment', 'table', '', 'user_payment_type', 'id', 'title', '', '', 0, 50, '1678030009');

-- --------------------------------------------------------

--
-- 表的结构 `system_payment_tools`
--

CREATE TABLE `system_payment_tools` (
  `id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '支付id',
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付名称',
  `is_test` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否沙盒环境',
  `appid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'APPID',
  `notify_Url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '异步通知地址',
  `timeout_express` int DEFAULT NULL COMMENT '交易超时时间/秒',
  `more_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '更多配置',
  `enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='系统支付工具' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system_payment_tools`
--

INSERT INTO `system_payment_tools` (`id`, `title`, `is_test`, `appid`, `notify_Url`, `timeout_express`, `more_config`, `enabled`, `update_time`, `delete_time`) VALUES
('appalipay', '支付宝APP支付', 0, '1', '', 1800, '1', 0, 1, 0),
('appwxpay', '微信APP支付', 0, '1', '', 1800, '1', 0, 1, 0),
('nativealipay', '支付宝扫码支付', 0, '1', '', 1800, '1', 0, 1, 0),
('nativewxpay', '微信扫码支付', 0, '1', '', 1800, '1', 0, 1, 0),
('wapalipay', '支付宝WAP支付', 0, '1', '', 1800, '1', 0, 1, 0),
('wapwxpay', '微信WAP支付', 0, '1', '', 1800, '1', 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_role`
--

CREATE TABLE `system_role` (
  `role_id` smallint NOT NULL COMMENT '角色id',
  `role_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `menus` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限菜单json',
  `create_time` int NOT NULL COMMENT '创建时间',
  `update_time` int NOT NULL COMMENT '最后更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='系统角色表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system_role`
--

INSERT INTO `system_role` (`role_id`, `role_name`, `menus`, `create_time`, `update_time`) VALUES
(1, '测试', '[\"user\",\"user-info\",\"user_payment\",\"user_payment_type\",\"user_payment_card\",\"goods\",\"goods_item\",\"goods_category\",\"goods_config\",\"goods_type\",\"goods_spec\",\"sys\",\"sys_res\",\"sys_audio\",\"sys_image\",\"sys_video\",\"sys_document\"]', 1678068762, 1678068762),
(2, '234', '[\"coo\",\"app-release\",\"app_push\",\"article\",\"article_content\"]', 1678107929, 1678107929),
(3, '1111', '[\"user\",\"user_info\",\"user_payment\",\"user_payment_type\",\"user_payment_card\",\"goods\",\"goods_item\",\"goods_category\",\"goods_config\",\"goods_type\",\"goods_spec\",\"coo\",\"app-release\",\"app_push\",\"trades\",\"trades_order\",\"sys\",\"sys_res\",\"sys_audio\",\"sys_image\",\"sys_video\",\"sys_document\",\"sys_menu\",\"sys_role\",\"sys_user\",\"test\",\"base_conf\",\"article\",\"article_content\"]', 1678340699, 1678340699),
(4, '2', '[\"user\",\"user_info\",\"user_payment\",\"user_payment_type\",\"user_payment_card\",\"goods\",\"goods_item\",\"goods_category\",\"goods_config\",\"goods_type\",\"goods_spec\",\"coo\",\"app-release\",\"app_push\",\"trades\",\"trades_order\",\"sys\",\"sys_res\",\"sys_audio\",\"sys_image\",\"sys_video\",\"sys_document\",\"sys_menu\",\"sys_role\",\"sys_user\",\"test\",\"base_conf\",\"article\",\"article_content\",\"11\"]', 1678365257, 1678365257);

-- --------------------------------------------------------

--
-- 表的结构 `system_sms`
--

CREATE TABLE `system_sms` (
  `id` int NOT NULL COMMENT 'ID',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号码',
  `msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '发送内容',
  `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '接口返回',
  `create_time` int NOT NULL COMMENT '发送时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='系统短信发送表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `system_user`
--

CREATE TABLE `system_user` (
  `user_id` int NOT NULL COMMENT '会员id',
  `user_name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '头像',
  `role_id` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色',
  `last_login_ip` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上次登录ip',
  `last_login_time` int DEFAULT '0' COMMENT '上次登录时间',
  `login_count` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `is_demo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '演示账号',
  `create_time` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '可用状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system_user`
--

INSERT INTO `system_user` (`user_id`, `user_name`, `password`, `avatar`, `role_id`, `last_login_ip`, `last_login_time`, `login_count`, `is_demo`, `create_time`, `enabled`) VALUES
(1, 'admin', '$2y$10$Wa5p1/02JPei7oZc5p3rqehiRTY8ECmfT1Fqozl5T3J9CDg61lxe.', 'http://test-cdn.zhanshop.cn/202332/1677734290588165342.jpg', 0, '139.227.234.204', 1678701690, 113, 1, 1617292800, 1),
(2, 'root', '$2y$10$uwjO.Za6hh4oIz6SsYUAoOMFyNXHAi7Ay2QRLEJhdUAq8nxiI37rG', 'http://test-cdn.zhanshop.cn/202332/1677734290326160601.jpg', 0, '139.227.234.204', 1678702665, 23, 0, 1678106357, 1);

-- --------------------------------------------------------

--
-- 表的结构 `system_videos`
--

CREATE TABLE `system_videos` (
  `video_id` int NOT NULL COMMENT '文件id',
  `thumbnail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '缩略图',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件地址',
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '源文件名',
  `size` int NOT NULL COMMENT ' 大小(字节) ',
  `duration` int DEFAULT '0' COMMENT '时长秒',
  `create_time` int NOT NULL COMMENT '创建时间',
  `delete_time` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='视频文件表' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `test_table`
--

CREATE TABLE `test_table` (
  `id` int NOT NULL COMMENT 'ID',
  `_hidden` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '隐藏输入',
  `_number` int NOT NULL COMMENT '数字输入',
  `_tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签',
  `_cascader` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '级联选择',
  `_select` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '下拉选择',
  `_radio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '单选框',
  `_checkbox` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '复选框',
  `_xmselect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '选择框',
  `_textarea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文本区域',
  `_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日期',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '时间',
  `_date1` int NOT NULL COMMENT '日期1',
  `_time` int NOT NULL COMMENT '时间1',
  `_timerange` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '时间范围',
  `_timerange1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '时间范围1',
  `_image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '单图',
  `_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '多图',
  `_audio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '单音频',
  `_audios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '多音频',
  `_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '单视频',
  `_videos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '多视频',
  `_document` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '单文件',
  `_documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '多文件',
  `_baidueditor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '百度编辑器'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='测试';

--
-- 转存表中的数据 `test_table`
--

INSERT INTO `test_table` (`id`, `_hidden`, `_number`, `_tag`, `_cascader`, `_select`, `_radio`, `_checkbox`, `_xmselect`, `_textarea`, `_date`, `time`, `_date1`, `_time`, `_timerange`, `_timerange1`, `_image`, `_images`, `_audio`, `_audios`, `_video`, `_videos`, `_document`, `_documents`, `_baidueditor`) VALUES
(1, '', 555, '121221', '3', '0', '0', '[\"0\",\"1\"]', '1221', '212121', '2023-03-04', '1970-01-01 08:00:01', 1677888000, 1677859200, '1677859200,1680623999', '1677859200,1680623999', 'http://test-cdn.zhanshop.cn/202334/16779185948831186363.jpg', '[\"http://test-cdn.zhanshop.cn/202334/16779185948831186363.jpg\",\"http://test-cdn.zhanshop.cn/202334/16779185947131142240.jpg\"]', '{\"audio_id\":738,\"original\":\"0425精神保护圈.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/40e3d3c5d5540ed5ded4ae36f2fb0831.mp3\",\"size\":10123509,\"duration\":633}', '[{\"audio_id\":738,\"original\":\"0425精神保护圈.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/40e3d3c5d5540ed5ded4ae36f2fb0831.mp3\",\"size\":10123509,\"duration\":633},{\"audio_id\":737,\"original\":\"0427精神解放.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/f2cc93ad938ed2e44f5803798952becd.mp3\",\"size\":10013004,\"duration\":626}]', '{\"video_id\":74,\"thumbnail\":\"http://test-cdn.zhanshop.cn/202334/-14948926500.mp4?vframe/jpg/offset/3\",\"url\":\"http://test-cdn.zhanshop.cn/202334/-14948926500.mp4\",\"original\":\"e5a951291fbf9cd559935b56ed624a00.mp4\",\"type\":null,\"size\":982579,\"duration\":8}', '[{\"video_id\":74,\"thumbnail\":\"http://test-cdn.zhanshop.cn/202334/-14948926500.mp4?vframe/jpg/offset/3\",\"url\":\"http://test-cdn.zhanshop.cn/202334/-14948926500.mp4\",\"original\":\"e5a951291fbf9cd559935b56ed624a00.mp4\",\"type\":null,\"size\":982579,\"duration\":8},{\"video_id\":66,\"thumbnail\":\"https://img.fulou.life/uploads/video/20220215/ea1f4ac9df8b06537a4b0c5b6d9d69fd94.jpg\",\"url\":\"https://audio.fulou.life/uploads/video/20220215/ea1f4ac9df8b06537a4b0c5b6d9d69fd94.mp4\",\"original\":\"安神助眠瑜伽.mp4\",\"type\":null,\"size\":50048482,\"duration\":794}]', '{\"id\":38,\"title\":\"sjb.apk\"}', '[{\"id\":40,\"title\":\"__UNI__9C3D865_1203181640.apk\"},{\"id\":41,\"title\":\"user.sql\"}]', '<p>wqwqwq<br/></p>'),
(2, '', 22, '22', '2', '0', '0', '[\"0\"]', '22', '22', '2023-03-06', '2023-03-14 00:00:00', 1678060800, 1678032000, '1678032000,1680796799', '1678032000,1680796799', 'http://test-cdn.zhanshop.cn/202336/167810796960714165.jpg', '[\"http://test-cdn.zhanshop.cn/202336/167810796960714165.jpg\",\"http://test-cdn.zhanshop.cn/202334/16779185947131142240.jpg\"]', '{\"audio_id\":737,\"original\":\"0427精神解放.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/f2cc93ad938ed2e44f5803798952becd.mp3\",\"size\":10013004,\"duration\":626}', '[{\"audio_id\":737,\"original\":\"0427精神解放.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/f2cc93ad938ed2e44f5803798952becd.mp3\",\"size\":10013004,\"duration\":626},{\"audio_id\":736,\"original\":\"0428诗歌坐在一起.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/71b81b7970ec978ebce9feeb46c05db1.mp3\",\"size\":10046364,\"duration\":628},{\"audio_id\":719,\"original\":\"0411如何看到大局.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022310/ce0bce24952e67a72b3f56266644a526.mp3\",\"size\":10184704,\"duration\":637},{\"audio_id\":718,\"original\":\"0413疫情居家小欢喜.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022310/b77fc124d3f8dc04ac5f9cad1f64b6f7.mp3\",\"size\":10110976,\"duration\":632}]', '{\"video_id\":62,\"thumbnail\":\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAgICAwICAgMDAwMEBgQEBAQECAYGBQYJCAoKCQgJCQoMDwwKCw4LCQkNEQ0ODxAQERAKDBITEhATDxAQEP/bAEMBAwMDBAMECAQECBALCQsQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEP/AABEIAHAAyAMBIgACEQEDEQH/xAAVAAEBAAAAAAAAAAAAAAAAAAAACf/EABQQAQAAAAAAAAAAAAAAAAAAAAD/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AlUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/9k=\",\"url\":\"https://audio.fulou.life/202229/1972316163.mp4\",\"original\":\"111.mp4\",\"size\":8031197,\"duration\":90}', '[{\"video_id\":64,\"thumbnail\":\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAgICAwICAgMDAwMEBgQEBAQECAYGBQYJCAoKCQgJCQoMDwwKCw4LCQkNEQ0ODxAQERAKDBITEhATDxAQEP/bAEMBAwMDBAMECAQECBALCQsQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEP/AABEIAHAAyAMBIgACEQEDEQH/xAAVAAEBAAAAAAAAAAAAAAAAAAAACf/EABQQAQAAAAAAAAAAAAAAAAAAAAD/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AlUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/9k=\",\"url\":\"https://audio.fulou.life/202229/1972316163.mp4\",\"original\":\"111.mp4\",\"size\":8031197,\"duration\":90}]', '{\"id\":46,\"title\":\"工作簿1.xlsx\"}', '[{\"id\":46,\"title\":\"工作簿1.xlsx\"},{\"id\":45,\"title\":\"工作簿1.xlsx\"}]', '<p>11111</p>');
INSERT INTO `test_table` (`id`, `_hidden`, `_number`, `_tag`, `_cascader`, `_select`, `_radio`, `_checkbox`, `_xmselect`, `_textarea`, `_date`, `time`, `_date1`, `_time`, `_timerange`, `_timerange1`, `_image`, `_images`, `_audio`, `_audios`, `_video`, `_videos`, `_document`, `_documents`, `_baidueditor`) VALUES
(3, '', 234, '234,234234,23,4,42', '3', '0', '0', '1', '234', '234234', '2023-03-09', '1970-01-01 08:00:02', 1678320000, 1678291200, '1678291200,1681055999', '1678291200,1681055999', 'http://test-cdn.zhanshop.cn/202339/167833817590017908.jpg', '[\"http://test-cdn.zhanshop.cn/202339/167833817590017908.jpg\",\"http://test-cdn.zhanshop.cn/202336/167810796960714165.jpg\"]', '{\"audio_id\":736,\"original\":\"0428诗歌坐在一起.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/71b81b7970ec978ebce9feeb46c05db1.mp3\",\"size\":10046364,\"duration\":628}', '[{\"audio_id\":736,\"original\":\"0428诗歌坐在一起.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/71b81b7970ec978ebce9feeb46c05db1.mp3\",\"size\":10046364,\"duration\":628},{\"audio_id\":735,\"original\":\"0426诗歌境随心转.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/6ed49a9f5416945ce7e0e4f2485c93d1.mp3\",\"size\":10045530,\"duration\":628}]', '{\"video_id\":57,\"thumbnail\":\"data:image/jpeg;base64,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\",\"url\":\"https://audio.fulou.life/2022127/8510640575.mp4\",\"original\":\"111.mp4\",\"size\":9471705,\"duration\":126}', '[{\"video_id\":76,\"thumbnail\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4?vframe/jpg/offset/3\",\"url\":\"http://test-cdn.zhanshop.cn/202339/-15209543721.mp4\",\"original\":\"e5a951291fbf9cd559935b56ed624a00.mp4\",\"size\":982579,\"duration\":8},{\"video_id\":57,\"thumbnail\":\"data:image/jpeg;base64,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\",\"url\":\"https://audio.fulou.life/2022127/8510640575.mp4\",\"original\":\"111.mp4\",\"size\":9471705,\"duration\":126}]', '{\"id\":47,\"title\":\"2.html\"}', '[{\"id\":47,\"title\":\"2.html\"},{\"id\":46,\"title\":\"工作簿1.xlsx\"}]', '<p>234234<br/></p>');
INSERT INTO `test_table` (`id`, `_hidden`, `_number`, `_tag`, `_cascader`, `_select`, `_radio`, `_checkbox`, `_xmselect`, `_textarea`, `_date`, `time`, `_date1`, `_time`, `_timerange`, `_timerange1`, `_image`, `_images`, `_audio`, `_audios`, `_video`, `_videos`, `_document`, `_documents`, `_baidueditor`) VALUES
(4, '', 1, '1', '0', '0', '0', '1', '22', '11', '2023-03-09', '2023-03-09 00:00:00', 1678320000, 1678291200, '1678291200,1681055999', '1678291200,1681055999', 'http://test-cdn.zhanshop.cn/202334/16779185946331139107.jpg', '[\"http://test-cdn.zhanshop.cn/202334/16779185946331139107.jpg\"]', '{\"audio_id\":735,\"original\":\"0426诗歌境随心转.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/6ed49a9f5416945ce7e0e4f2485c93d1.mp3\",\"size\":10045530,\"duration\":628}', '[{\"audio_id\":735,\"original\":\"0426诗歌境随心转.mp3\",\"url\":\"https://audio.fulou.life/uploads/audio/2022324/6ed49a9f5416945ce7e0e4f2485c93d1.mp3\",\"size\":10045530,\"duration\":628}]', '{\"video_id\":57,\"thumbnail\":\"data:image/jpeg;base64,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\",\"url\":\"https://audio.fulou.life/2022127/8510640575.mp4\",\"original\":\"111.mp4\",\"size\":9471705,\"duration\":126}', '[{\"video_id\":57,\"thumbnail\":\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD/wAARCAEKAMgDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD5JspVKRHodo4NNbgbMR3YxzW4FqLgHPFADJWUNyRQBVn+fGG6c4oArtM5ypHHSnHcCNnKDIHNdC1JSEE277xAxRYLEU/zA7eeKxnuNGRqEZKEp94cVAzEIKt81Yx0lqB6D4c8caZY2P2S8+UoBsOMiunnj3A8r8YrBq/iK61GI5jlfetRNp7AZnl+WMAcVAEbDYcjvXHUT5mzoj0K9420FlI4HepjudL+E5a4R7m6KZ4zxXRtucctVoOawaHseaOZGfKx0UbRnODzSvfY1grIsAjjms5blE4I45FSUhH6fjQDIn6CmhIakpjcDjFDH5l2ORZQBkUAe12p3rG46ECuiO5ym1ZzLu281uBohCRmgCCaB2fI9KAIWhYEg0AQvEMHHWgCs/HysORWinYCsxIJxT5wsJub1qJO4FK6/iBPNSBiXSEHPtUNICpI2xCc1LSQGdckHBFCaQFV+afMgIZELd6iSUi4ysUbxTsYd6z5EndGjq3TRzm8W9zvb1onHmRlF2ZqO6TIrAg8ZrGUXHc2i1IrSJ83FOErMZGRg4q3qND1cAjNTYViRmDDikDYwjNAhjICeaB3EDGFgy0DWp7rp8yeXHHnkLXQcyV3Y1rVgp3g59q1iy+Q04bveCNuMVZFiZZ48fMcUBYtLHE8YYEHNaKFyblV7IAE5/SpcbDM25turDrSsBBd6RqVla299d2FzDbXm77PNJEypNjrsYjDY74pAZFzIUk289KAKcshc4yRQBRu6lgZ04ypHpUy2AoXC8delZgVGbnpQA2gCvcRAgmgDFvbFXyw7UAZkVx9nlKMDgEVMo8xUZcpokrKodD2rNwsaxlzELx45J60rlbDKZQ5W7YpNWJasOBzSEBGaAGOu7vQNOx7LC3lMsnT5R/Kug51ozUtL3p0NWnobKVzTjuBtyK0QmOM4PJNMRctL1gQPwrWMjOUeprRt5i8gVTsTZo7T4TfCe5+JniM20qtFpFmA99Mpw2D0jU4PLYPPbFVTipOzJqScVdH19q/gXw1rfhxfCN9oNm2kRxCGO2xwijoVOPlOecjnPNaujFmPtZHx/8AGX9l7xP4JE/iHwwsus6JGDJKFANxajPdR99QMfMOeuQAM1lOilsXGpfc8DnAQcdc4Nc2xsUJnLg5x1qWBSnAwTUtXAz7jpUWApN1pANJNAEEznBFAFOQDmgDFvo03E7RwaAK1vdtEwBPy0mOO5oRkXIyp6c1i1qdC1Q1oSoye1Fw1GgYpXFcUHFACg5oAMCgD2HB2Lx/Av8AKug5xYmZSMEiqRpHY17RyyfM1WhlyNQVyRTAkX5SNvHNaQEzs/h/4Z1nx3r0Hh3R4S8sg3yyH7sUQI3OfYZH4kVtBXkjObtFn3P4M8K6X4J8NWvh3SIFjigGXbq0rnqzHuT/APW6V18qWxwyk2jZyfU0Gd2BJIwSeaQXZ4V8aP2W/DnxBM+v+EvJ0bxBIQzfw2lyc8mRVUkOR/EvU9Qeo56tPqjopVOjPi3xn4N8ReBdWuPD/inSJrC+hG7Y4yrqc4dGHDqcHkEjg9xXJJNHTdHIS5OfrWN2MqzKCOlNAUJ12k4FAFYk561IFaZ9uSTQBRmu0TJxQBiX16HPy8c0AU0ffkmgC5aztCQR0pWRSkzU85ZegxxzWLRuncWOGSZ1ggt3lklIREQZZmPAAHc0h2DUtI1bQ7k2Gs6beWFyo3GG7t3hkAPQ7XAOKaDcqbiO9OwWJFPAyakk9nUBgg/2Rn8q6DnJWiCrkCqRpHYaspjYYPerQzVtbpHTBYZoA0dPsL7V7630zSrSW7u7qRYoYYlLM7E4AAq1CXREucV1Puz4OfCqw+Fvhj7ETFcateESX10q8se0YPXavOPUknvXZCEk1oedKW53fPeutmKEqRkidPxpMB1TdAYHjbwF4V+ImiP4f8XaRHfWjHeoJKvG+OHRhgqee30ORUVFeDSLg7SVz4Z+Nn7KvjT4aPNrnh+KfX/DoLuZoIy1xaIBn9+ij7oGfnXjgkhcgV5bpzS2PQhOLe54IRICeOM1CdtDdq5WuDzg4qzPlM24JHPoahkvRmJqF/sJDOfSgRiT3pYH5jQBSaRmOcmgBA5B60AWYDLI6RRIzu7BUVRksT0AHc0Ae9fBz9lv4ifEm5SbUbWfQtNxuaa5t2MjL/spwB/wIg9wDUOce5cYyufWvhf9mHwh8NsDSPsV5qc2EM88UrtGufuGUOuWJBBCqoI4Ycisro3szD/aE/Zi1Xx34Bk1/RtLP/CR+H4mltooVCLc2wJZ4I413EnksoyPmyMfNwJoEj4BkVkYqwwRwRRe4xuT60Ae5RxMEjkzwVFdByExUsuB61SNI7FaWMpyaq4xsMzI425prUiVRRdmfbf7M/wVk8GWCeNfFVmp1u+izbRsQ32OFh0x2kYdT2B28fNn0acG4pnDOouZnu5bJ6V0JGDdwIzTZKEIxStYq9x6dPxqWA6sXuA8daoBwGeKmVralKTjsfNfx1/Y50Lxst14j+HMtvoetOzTS2jAi1u3JyemTEx5+6NpPUDJauKdG7ujshiklaR8JeNPB/izwBrc2geL9Du9KvYefLuFxvXJAdG6OpIOGUkHBwaylFxdmbwmqiujmZ5SSTnNZsT3OX1dwX+poEZrDIwKAGpFJI6xxoWZiFVQMkk9AKAPSdC+AnjW6+zz+JrGbw/BcKJIlvIis8ieoiOGA9C2B6Zq1TbjzgfeXwT/AGU/hj4A0211gQLqetOiOJrgGQruHIH8Kjn07Vm2WoNnto0rVLcfYtDS2tOBvkdSVUdsKuN2PQkVxs6kbVhZzWsKCWQ3dww+dxGIwT34ycfmaAF1TUrbSNNudR1+5htrGJP3rMCQing59c5A6VdKnKtNU4bsUnyq7Pz1/bX+CWn+EPEFv8V/BcaN4b8VSk3HkyeYkF82WYgjgJKMsME/MJBwNoqYy1cGrNOzMo1VPY+YsGtbGh75bxK9nET1C1ucgCE9mqkUiG5t2Kg5pjPoD9l/4Frrt0nxB8WWKTafCxXT7SZcrO4x+9YdCgPAB6nPpz1UaPtI3ucdepyysfYsKCGNYlAAUYAHQV6MFyxSORu7uOqhC7vagBCc0mNCPPBbR+bczJEm5V3OwUZYgAZPckgD1JFQ9xnnHinx14k8Nao+qXNpeWmlBJEld4Y7qG1eIyFpJVhIkCFVRi2WCqsu4R/Kwye4HXeH/iB4R8UarJo2h6/YXd6kbTi2iuEeV4AFPnBVJPlkOuGOM0XA6VetTPYB6ru71kVGNzkfiV8JPAvxZ0RtE8aaNHcgA+RdINlxbt6xv1HrtOVOBkGs50+Z3OqlP2cbH54ftA/so+Pvg1Jca5bxnXfCwYbdUto8NBnos8eSU5438oeOQSFrnnTcTVTUj5n1VWaQbQTg9qzK3PZfhF+x58WvigbfU73Tj4b0KXa/27UExLIhGQYoCQz8Eckqp5+btXPWxEaUbrU2p0ZTdnofb/wl/Zb+Fvwgt4NR0nQv7R12E7m1XUdsswb1iXlIv+AjOOpPWvOq41zaSVjtpUFT31OA+Pduw+I+n3jk7ZljHPTG7mvawjbwzv3OTEpKeh9SeG7GxXRrBok4MK4weOlZORmp20NFJEE5iyBxyc1zHSJIHEsbCWMQAEuxY7t2eAB0xjvn8KAKeu7NU0u4soJCrOu6KYD/AFcqncjDPcMFP4UKo4SStuNNJps+dPFXhEfFK51HwL4ptEtL22MiRwTY8mQyFGLJjbtYsmVbkZYccZr1JZlTyzC0/rMOdSvHm81r+T/A6IZcsyq1K8Jcuq0/r0Phb4pfDPxH8JvGV74O8S2kkU9sVeKQoQs8LDKSL6gj075HauCFSNRKUNmc04ezk4X2PUbIZtIh/s10HES7FqkUj0T4I/CG++KPigRXW2PRNPkSTUJd2CVJyIlwQdzAfgDn0z1YelGpfmM6knHY+4bOxs9OtINP062jtbW1jWGCGJdqRoowFUdgBXoU6apq0TgrycpXZS8W+M9J8D6Outazb381sJkikNnbNO0KHl5nVeRGihmZucAHg9K0Mkamk6xo+v6dBq+h6pbX9jcrvhuLeQSRyD2Yce3saBlugApMaIdU0jTta0ubS9Wsbe8s7obJYLiJZInXOcMrAhh061IzyCLwD47+H1xfaVp2oap4i8EeRIYrGGRY9TtBKW80JORuuCvDpl0kGThmYYfKW4Hf/DfwNYeBtBNpY+dvu3SadHICrMECuyRqAsW8je6rwXZiOtSwOyXrWbk2BLGCSQBk1JpAwfEvjrw34WGNUv0ExBKwp8zn8O341lObi7Guh5rqfjbxx4+imsNFs4dL0qcPbzSTg5kjZcEf7WQSCBxzjNcc8UldM9Clh4OKZyfw9/Zl+DfgTxI3iC18LW1/q0jidJrseZHbuCGzBEfkjIYZBA3Dsa8ieLqSujvjhqcXdHtagINuABj5QD+lcspNrU3aFKxq7QhACw3fhWE3bUR4R+0n4TubzR4PEdnAu7T5AJcD5thzz9Aa+mydvE4acPtJq3p1PNxf8Q7n4N+OItf8C2XlACe0AgkGfukDj9KhrWxzF3U/iv4MsdetvD/9r+bdzzCGSSBd0MDE4HmSfdGTxwSfUAc1pPBVYR5mtDphNM7G1Mqhw+1425UjnIrkNCrPcaWjM4s5lm6ZIx/WgDzHXtI8QXnjuz8UfZ0NrbEQs4Kxt5S4Zc5I3AMO2TzWladOrhPYVO90a0q06Lbg7XOT/aw+GP8AwujwLHqOjWlpPrugxNcWd0h/ezxYJa1Y+55UHow7BmNY0ZKKUexhY+Y7MD7JH/u13nIdL4D8Eax8QvEkHhvRI18x1Ms0rnCQQqQGkb2G4DA5JIHet6Ku9SKrajofdngbwZofgfw7Z6FokQ8u2Ta0pUCSVu7uR1Yn8ug4FejRilfQ5ZSbNfVNT03RNOudX1i+t7Kxs4mnuLm4kCRxRqMszMeAAOprfREPU8ytPim0esxW/iHTLbTL/XcJ4a1R5vP0m8t3BaLy58JiQ7FZom2u7FApYbdo2Z9TA0DxFcfDrULLSvGvh+fwxpunXE817q+h20kuj6xdyIimWZlQvbkYJIcKm8t8zACudSfMM9G8OfGP4ceMvEieE/Cfiuw1i+lt2uk/s+T7RGI1OG3umVjIOOHIzuGM8gdJJ3R/cxAyJ82cGpY0Zt9pdrrt3anULKCe2024W7g8yMSD7Qv3WXPA2HBBHIdR0K0hmqOB1xWT3Af16Um1YZjeIfGGg+GLdbjVL1AzZCRowLsR7Zrkqu0dDSjG8tTznUPiH4u8aXUmjeE7ZbG3dMm5ZsELkDIbHXtgZ6/jXDVxHs7XPQpU12Oen+Emp30TNqGsyvdZJdkTjrxjNcVXG+8d1KlFx1R13g6LzNJmtLpSLrT5DBOuMYYfdI9ipU/jXM6ym9jVwSWhfkRoJLe6UnEcoBP14/rXPJGsWdIYi/zr0J4rNlMHhbbuzUNJiK2raTZ61ptxbXdvHNFOjRvE44IIrfCYieFnzRehz4iKcLnyD438KeJ/hprV3o1hf3i6JdHO0HCzoR91sdcbsGvqKKjyqo1e55hn2Uf20x6bpsCyO7iKONcZJOQML15wa9qUVOHL3KhofRHwl8b6hqunz+BteEkOs6RboMyg+ZJEr7SW7hlwAc88j3r53F4f2Tujpi7nbrbfZnMMYM0mcs7tgKD7d+lcRZQ1qyZbU4mEucn5QMAenFS0nubU0mtS58OYbzUrEW7CKN7QC2LOm5cADBIyM5BHeoiveOCrJqTSPgbwxomp+Ir2w0PR7V7i8vXWGGNR1Zj1PoB1J6AAk168KcnJaGLdtWfePwq+Feh/Czw3/Z9oy3OpXYV9QvCOZXGcKo7IuSAPqTya9OhTcZXaOevNSjZM7MFAdowD6V1HGcx4/wBE8V6xYW0vhDVrOG6spvOew1CDfZ6iuOIpmUeZHg4IZDweSrgbayqRbeg0eJWulF5b3w7oPh+007Vr+aSbWPhxrsSDSLqAZLT2Uu1tgLAHzosqzvl40PCZNNDF0PxT478KaTNo3wtlv7mya6h0ebw9rUTvqPhK5udwiljmQOk9ohDN8xICx4EuOAovUZ7vr2v6X4C8KXWv6t532DR7YzzeTGzvsQckBQT06nHHJNb80SbGfY+NjbQ6Np2n22u+MFuxCJtZtYIFtwJMETuzNGhQht2IQ+AMYzgUnJAtDsoUSKMIgCqvA56Cspu70LUXLVGLrvjHRfD+5tSvFQKuSqjcx+grllJJs0WHqPoee6j8SPF3i5haeDtPe3t8lZpmONg9dxAx+GTXFUxdNRdpanoQw021dEmk+BbFbkXfiOf+1Z5OTvZzEPwOM/jXlVMVNo7aeHjTd0dddQQWt1bvDHglgjnJOF/ziuWpUnPc3SsaUvlxsAvcZrHmYehm6laP5i6laKzSxALJEhx5seeRx1IySo9cjjcaFILmXrTgrALaQtFOQVKnhhwQfpyK1kyonUW5LWsSZ+dlB+pxXNNprQ0YnnBSIt3LHbistSbE0cbRyqc8MQGz6U02mZ1Y3gZHjnwNo/jLRZrC+TBYfu5l+8h/qPavXwmO+rNM4XRT0R8maz4Ov/BXiCW6sriKf7C2RuYq0bg4DA8chsFf5V9NCusW74eWnbqRPD1cI+WvuzRvPH4uPEFn4xitJLTVrfa0iwnCSSjI3c5yGBw2RkgkE0VIxnC09BKaXU9lg8fWepaNa6omrWizzQpJcxJKMwuRkqRnIwcjmvHqYdweh0Qqw6so3HxH022iLHVYnzxtyGz+FSqM5OyRp7aHcyp/i5qtzo0+i+H4fsIuSwa4yGYZGOMjr6V6tHA+6nJHmzqxnNqLOh/Z1+D0Xw88NjX9dto28QalCm/kMbSLr5YPTJ4LEdwB2rqhScZJmMqqcWj11ZVZguSPeupySRyPU8r8b+NZNT1O78FarJrnhSS5fz9C8QWCx3NtdeQom+dtrLEQY5GaOVVUxxk7yCQJ9qibHSeD/GV0LPTdL8V3dpc3sthazvrFoqw6bcyzuUhih3uXaVwu/aFxgjkFlBPaoLGx4v8ABfhvxzpqab4isPOEEouLWeNzHPaTr92WGVcNG49VPTIOQSKJWkCLHhXSZvDXhy30fUtYbVHsy4F5cQRxyPFuJTzNgClgpALYGcZPJJqeVDHwJo3irSmuI7i01TSNXgeFZInWW3mhb5WAIyrA5IPUdqXKgPKPCngKb4XeGvDEvhfX10WeK0sRr2kTo09jeuIwtxKkZw1vOTuYNHtV2A8xCTuA0ioxcja1r4i63r0h0rwtaIhPBcyc4zjJOOBXFicRDDvU78PhpShdFfTPhoszpeeKtQfUmPzPBuIjz6E5yw/Ie1eHUxjlJuOx6MaTikmdVdJZWk8MdsjRqxCBFOFUdMADivObOrYuGIKzoP4SaLsLXCPy7yJgQSwB6jvSeowhknmt4J7hcOwZSQOMq5U4/FTUWsFkWVYKQp6tjNRzJMLIoanpyxRiWBAIy4bGB8rE/MR9eDVt3iwSs9DXtYyVR+ojUqP8/hXOWVbuDZdpcDJwwbApAXpbyBYBdTusUfIJY4xj/wDXTJkrosRzQ+Vh2yjYwRyKDLkRnvpGnZlEVhbbLnPm5jX589c8c9a2o1p03e+po5c2ktUefeJfg14f1C5MmlWsFgQCzrHCH3nrxngfhxXsLiCu1y1/eX4nJWwlKatC687/AKW/U5iX4CwyO5h1/YGIxutRjn6OP6Vaz6i/ipoxjlzf22Vbb4GpHG002uJuUnpZjIxx3Y4+tZVM9hf9zBIp5Y1Hmc2Ur658L+BcC1tPt1+pA8ydy34hei/lmvThGvWipYuXKui2Zyy9lQ/hxvLrc+h9NIawijP/ADyH8sV7aR5XtbnK/FG28Yt4RkufBCxzX1nOl1PZOCDqNoobzrRHHzRO6n5XXkEAcZJE1NilZnimnazq3hXwlb/ED4T+Krnxn4PtJ1gk8NXcIuNQsIpFeKS2jcsZCEleFzFJhikZUSbducAsXNL+3WtvHrHwanfxfotlLJG/hbU3SC90m8SEwm4iDqrQNGrFVhmITayiMgFcAWPZvAh1m7s7bWJtR1mLSZ9NtY7PTdVCtdDCZNxcSHMhmYEAhnYDaSMbsCoiPP8A4sePL6z1WVF0yNb/AMKXq3Ma2GsBrqazljQIzWTKDcRyMZUkAO5NqGPzHGA2NK7scNq/jjxJaHVfiB8HbXTk067uYpH0nTpZHXVlJxMZY2Gy0u15JlTG4krIpKq1FzX2Xmb2va1evFIRK0j55DNnJ75IJ/rQ5GtKl5ieD7/+z/Ju1kYecxSUMc7QT/LIFeVmNNzi5I9LDNQXKepWmrCBxb3RKZOBkda+fd1oz0o07q9xdRkjneORJV+Rhj3qLFOFkdDDtcCVuOeaRkVyFhmIOR5g7f3vSgAt9sdw9rJJgyHzV9MDgj+VSxj5C0ZRsZ25yf5Vzy3GWbYrPGI5ZN3y/maaelgIG1Gw0y4gsbzULeGW7cpbxSSqrSsBkhATliBycdqkdzKvvEN9qP2mw8M6Y0l3bXAhea8jZIADsYlW/i+STIwe35gXN2NIlUJcosmIyhBIYc9SPTOKBN3LKkbflGB2oIHKFZcPnA64FAGV4j1LTtGtBNqF15MMjbVY9cjntUVNioR5nYz4tStryGNrDdIvl7xxjKD+L8z9eaxNlDkON+KfiNfB+j7YjILq5KmNzJwYwMYIA68e1e1lOGjJ/WKmy6dzysxxEqbUIrc8I8Pf8VF4gWXV5gLQsZZ9zY3jOSoPqa6sdjJS1buc+Hw0672sfYdjIy20IB4MQr7BHhos7mK47d6LcyszSOx5PrvwH0c6hq3iDwbqreHNd1Kd53uraAGC6RwN8F5BwLmMsZGyxDqX+Rl2gUvZxHcg07wrf+MtbkuvGnhO/wDBvinRTbi41bQrnFjrNnuz5YYjE0LBGUwzoWjBHqCT2cQubfjf4i3EPiK18K+DfEmj2utwtHNFaanG32bWC8e42cc6j5JgHQgLufJU+WyZNY2s9BmR4t0/wf8AFrw5pl54t0ybwl4qt7h4NLivZorfUYrobd4tJQ2JlPUFCyuOqnlaGVB+8cLpuhv4Ys5lv5IJ9QuZd1/ex2iW8l3KMgM6p1YKAD9DgKMKEdJTlExdnd8huRjoKDSDsQ21xNp9yIJd2ydhkkZ2/X0qJQUlZmylbU9e8DavHrMQ0e6m3T28Y8l3IO6Mfw/h29vpXzeNw0oScoLqenh8QmuVs6ldDjlV2hyMH7vbNcL0N3NvQsqbyO4CYUwbQDxyr5PJ9sDH1I7ZIggtywo6sD94DcDQBj6+14NNS405W+0W9wsnHJKBWz/PFFhhe69o1jo0muazq1rYWQjjMjzShVjJ6Ak9ySBipdNBc4bQfi/pHjTVdW8E+FZrix1uCCf7Dd3kIFvM6hNpjJzvOJA4UjJUZIxS9nEDO034K+JPFFzY654/1C2TWNLmSa21CwYm7yY8lGZ1KgRy5KcHAOPcns4hcv8AxB+P8Hw68W2vgiTwBr3iW6j07+1786RGkjWtlvdPMWMkbiHT5gSgCsDk9K0p4f2mxnUm47GVpH7T3h3x3p2or4G8AeN0vzpV7d6fNf6Mi2kksMLsoLpOd3zJjapyTxV/U32MvayOJtfir4v+JPia5trTV/EWn2/9g2txqNr4QvrS/eFxsMN0iOTIq5uHE0UKmT9zGG3hgWtYaCWqMJV5pn0P8PvFU/iTSWj1aJbPXdIl/s/WrUKy+XdKqkuoYA+XIrLKn+xIvJINcdak4ao6KdVTNzU7O2v1EF3aR3ESno65Brjcm9zdNxd0ZdxYWdvYv9khCohEiBBgBB/Dj0rCcuQ3pvn3PA/jBdS3niWG3vJmO2IbVPPUnHH419dKn9XwcOXZ6/keDWm6lV83Q07vQPD1naQ6la22nuojS3YWZbCt1aQqf4sZzz27V5KvVm0z6XCTpYeiqsldbbnvNn/x7w/9chX6Aj8/RaHShGsdhCAeop3HYbLLalRaXM8QM4ZUicj94McgA9eOtCEzwm++DL+Fb/W7rUtXh1LwDFbz3/8AZOqyzR21kxt5Buj8p8ERGOHaJI22IV8plaL5ud/ExnTfDHTPF+sSWuteJba8gsdJs/saR6wllc3V9chwwuBNAuwRRLlInXDybmd+iGga0Yz4g+FZC39tWke6B8CeMDhWJ4b8T1Prikbxlc8l8W6qbG3+zrJ5COj+ZccYhABJPJHAAOeeOOmRQaLch0bR7q3sXS4uWl3sGiD5yi46Hgc5yelYzbTNkanh/wAQXWn38V1bb1mtJcqXBAYg8j3B6VxVfevc66elrH0F4R8QnxDo8OpMqRs4IkRTkK4OCP8APbFfPyWrO57Gu3lkYXkk5rNGV2IG2sFIPzDFNhdlaSX7NMRsyJDge1SaQ1R4le/BXxh4i8Va7p3iXx5dP4bnmSWxijdkmiG8s/l8mNAqbotpVlZZGyBnFUjGTlc2Nd8WfDT4IW154W0AWFr4nTRJ7+0t7+VoPtkMbNhZbyRdrZMbqibycoowq4IcY87sT7Rx1MDwL+0t4l+K0ukWPw2+Gl7eXK/Zn8R3t5OsFlZEkedHE5P7xsBiucHkfK2CK6fq/s9WL6x7TRI8p+NngTxVpXxOvdX8S6Td6zr/AI0uJV0Wz0/UxaaVcafbRKxtriV/Lklk+SPMSGPcQpDFnUDXDtNtEV+ZJO5zmn6ne3N9b6v4Tv8AWY9Tt411TwBp+mJGtlFIkh+22EkAVQ9wqsdxGTMhDsG80A1Ulruc6k2fUng74d23hHXI/iZr8l5pNlp1ncaumgxFfJ0e7uYt2pZeMF54yVBCElVZNyj7oXglibSasdEYpoku/i/8CvAOi/8ACVaf4nF9c+LJ2vRbW9xJfajeS7jEB5bsXjCmPywjbFXYVABBFZVoSlFsuFkz1O2kF3AiEN5cuCwZSrgdcEHBB7EHkV5x1FHxFp97dWMkFtqLWkzgKJlXO3/gPQ1zV1dHVh60aSaavc+bvjNYajp/i62e4dneG3jzNjbvYAZb25FfeVLSwdBeR8zd+0lfuzQ8FeEG1rWLe2NwrNcshikk/wBXvYgLnGSMkjnHFeXJRUmelTw85QVnofRVn/x7w/8AXIV9mj5hFkEYoSNIswvHXiK48K+FNQ8Q2+n3F59iVHlW3wZIoS6rJMAQd3loWk24OdmO9OxVzxseJ/FmpTeDtZl1HSfEuqxfabW2hhsRCL+SKAyG9069IMSTTW8gcwyHy3CyR/L5cm7CrowR6R8NdVi8beGdUfU/Eg8SWc1zNYXFnqGipZ3Fm2zE1ndxAlGYbhn5QCH7jBqAO2IUx+XEVCr/AAjp9MU7oCtcWiXMJgkVWjIwUxxik2jSL0PA/FXw6fwv4gnuJJXltb5mnhLLlWAOdpDMwypK8qF7etF09jWG5nSrsYAHtWNTc6jKvrMeal6iqJYiQDjnB6j8f6Vxz3Z1Q2R1Xw58avoOqCK5k/0G8Kxz5GfLPZx9M8+30FefiMPpzI3jPQ90tp/MZTxg/wAq8u+tgLEhG8qpzis5rsCGSriPzMZI9amL6GkXYoOxli+1r/rI2HB/ug8/pWly7nlfxy+D978U/E/gvxRbaRpWp2fhl7qTVdPu53hk1CJhG0MKsqkHDK/DMq/N6E1thZKOkjlnCVmfO/jrwT4w8H+IYfHvj3S/+Ff+BPGN/DYaz4e8M6qI5IoUiKAtHGDGw5LMFXuw2IWAr0201c49Ys9e0Gzsv2gfCdv8NdF+F97ovwt0yALZa9qtwUvI5VXdFNarIWLLu3o3zEFCw3r9yuKyV+U62+aNjc8R+P8A4SaDbaH4J+GHgJPGut6PcE6TZaRYRmG0uo9m+eS4CCOJgWV2dBwcE7RyOf2LnrIIRSVmPTxf8V/jd4f0628BatZeC0CS2Xiue4t2fUNNvU2h4IYycEMH3K52sAD8ysNpUsPGGrGqzbcYnkvwl8EfEHwx4t8R/C3wBpPhnTPEWiXHmal4yvyZL5LOZQYvskLb9hZd2WQDO5Q+xgCepVafLZsw9nO97H0T8DvH+p+JvDdzoni8sni3wndvo+uRu25mljZlWUno28KfmHBZXI4xXmYmEE+aLOyk5Wsz0PUGa6hkjXkOuOa5Ywc9jU8k+PPh2XUrW112DJEIMMgx0BOQf1r67JKMq+HdPqnc8TMWoVU31Oe8Aw6dfw2enjz2uSh8zfMEVT229O3HevNxlCpTm5SWlz3MsxNKUVG+tj3q05t4AB/yxAr7U+NRYKlVLHgKOT6dqHLlV2WtTh9Q+Lei6D4jGmeJdNuNK0O9EK6b4hmdX067kcDMbyDiAlj8hkwrjG1icAx7VFJGA/wNi8LPFdfCbUItGi+3R39zo90pk0y5kRwyuqD5oJRjAkiI3AYcODUy9/VDPU7a0tbGMx2dpDAJJDLJ5cYXe56scdScDJNZ7aAES+Uhj3Fh2J60hpXHAYqZbFqLRl+J9Ch8RaRLYSACQAvC542P25x0PQ1Cdi07HgWtWN1ZSTWs5aC4gfa3AJBGQR6Ef5BpTd2dMHzIwZp9QiGXCzAn5dvy/of8a5Jbs7Y7IzYbz7Lc+ZHHIkcrEShm+6x6Y7YzWMpKSaKR7p8LfGf9sWh0a9kJurSPdG2OXjBA5b1GQPy968qvQUPfRadz0G2kWWMSfNuOc5PNczWhViysbPEG3YXnI71nZIcdzNuJI7KTc5JiJG7AyevpTNieKQ29yQXIicg59z1pp2egpbanimpfCzwPpXiTxF4/v47/AOLXizTrmOb+zJ7uC5k06GWQmJFt+FG1Mld/Xy8qFOTXZGU5QsjhnKHNsYXxF8WL8aoNa8BXWkeMNC1LSfD76xFo9tcxQzatuBXymiVWLCKQIvl7iGbdlchcEIOO4e0R4/8ACb4ufFLwJ4ZWHSdQt7bwhKr2TSwaY08WjXN2N0V3I4U5CSNHlGZsgsih3R1TaNNy1D2qOu+Gnj3wz8LfCvib4t67rep6l45nu/sOvaHfarDCt1KbjKT2yrETJhH3DqNvm7SFwTlXjzxsiKclGbk+p674T8BeJ774z+NviJepdaTo2vaPbadp8sdwqXEwKQ7pgoJaFl8gMFcZHmDuGrynUSZ3QXMrm14e0D4cfA7SdRtdLfUdR1rVG+2X9zdTvcXt86B2DTPwiYDSkEhd3zH5jSf71WRy4rGUsGk5a37HZ+E9cl8Q2C3Utm9qz7iEfpgMRweCR7kA+wrSjTcL3KoYyFdXijX1Xw7DrVk1lNFuglBSQDrz3r2MBjKmEl7j33M8VRjiN+h4lc+HL7wTrTNcaf58YZ0x8uDg9Rmtc7nzU1KlLS5w4aM6FR2PabKciCA7c/uhX1J5nkcD8WPDvizVb7Q/Gfg8WlzqfhYXb22k3dr5kWpGeMRvGZdwEBEYfa5yMkAggkFSXNE0jseOfCi+1LUbHUdI8EadZ26f2ewvPhx4qvGU6mwdlneKFreOG2DSCTKxMYCzFXWAqa57WLPpHwV4W0zwX4ettA0cXy2kI3RxXd29w0IP/LNWYnai9FUfKoGBgVpBaCub45GazluBF05qRrcUHNKWxte6Hqu449qzEcN8VfBU+raS2v6bG0lxZxESIqE+ZGDk4x3XLH3H0FZTnyuxvTlZWPDLpZmt18h40YgENIhZcfQEfzrCTvqehDZGLdR3+14XEMuPmBTIB+g5/nXDKpY6PZeY7w74h1PQdSjuo5FiuLZ9yBjnevuPQ9DXPVqe1jYapJH054Q1y217Q7bVLaQOJV+cZyUcfeU9OQf8e9cklylqmdBGTJGVzjPFZEOPK7Ga17pNy19FBqVrK9iWS6VJlYwOq52yYPyds55A5watU5Mh1rO1j5xH7W/hjXdLu/DWt+GNds5DdNpuralpF0sttpcEshhW6jukGSQSCpCjJ+6TxnqWFXch17q1jhNL+JGs/BzxdD4f8M/Duz0HTra6ZbuHzIL++1z5Ayx3NzncoljzJCsZAZ8bQQSw2jS5Va5ztXdzynwlDDq/xH0p9X8Wx+FdOnbUv7G1W0laC30vyzPNbi3MzKwtzO/y5ZcmSQblbcQ2rEtWPabT4J3nxXuND8YeCZYZPDPi2C4udRutTsxt0zU4SYZ7hbFZfIY3BXKgeZt3NyoUYz9v7PSxUafMrnrvhf4UfDP4avY3+pW0Ov6zosQtbC+1WGOS7WJWY20SAAKzqoEcbkFgFCgqoVRzyrzk37o6qjRjzXNux8Ya7491OW20fT7mHTJJZ7a5ljKq8asshWfc3PzI0LRjC8l+W2nHmtKLuzjhi62aRcacLLY6Hwh8OrDRorG61fzb2+skYQuqhVjV1UMnB/eKDvK7v+ejcZ5rSk1OVkbUMpqUdarvY6m91PSYbu0spLnyrq78z7PCFLSSlFDMFVckkBhwOTkY612U6XmdtS1NJJHdaXpglG5gUCgblZTWOKqrDxfcmnLndjM8beAdO8SWC25kVJ1IeN8dwOh9jXyCzaUdLfid/wBTUle5ytp8kUOOyCv3E+MLOdzFz1qkWjOfw5oDXdvqB0ayN1aTS3FvN5C74ZZc+Y6NjKltx3EdcnNTJFI0UO0cVAyXc2Bz2rGW4DT0qQFSs22zSOxNEOSaiTsUiBtH0h93maVZvuLk7oFOd+S/UdyTn1yazfvblJWPD/it8OrLSNRbVbbSYZLG54j3qNsb906HjuOPbtUSjpodtGstmeSXtpDEGlk0vSURM5JhGPzwK8+tTcUz0YVYyON1jxV4d0a6jnS+09LhWIxa24zj0JGa4jU9h+CvxHhsbqMPdIdM1QKGY5xG+eG9vQ//AFqiauNH0nazNz2wMiuZqxnP4j5G/aJ+H2q+CNe1L4p6/wCIbWDwr4p8RWFnqOiaTHND9vtUV5GNzhwGkwsgwDhyzPlCcV6uF95WZxT3Z4Dc+B9Wuhda74f8LXviLStGgn1KG4ubMRQSaOHdRJIqBXaRZN+47zjyzgsi5GjIPpnw1+ztZ+O/hx4RuYvHtnrFvBp80EGpJYlHfT3TfapneWWW3m+ZCNp274Wwpriq1pRk0jWnFSep2fgz4E+ANB0bQtV+JPh7Q7zVtP0xtLkQJ51jI5lM7GOGQYMpJdyVUHLyYG3AGcY4vEySopvvoVNUofEeg6X4q0q5trSz8K6ZG9lA7WBt4VSJraJYiY5UXO0RjaAFOMhhjkBW6q2FqYdXroUZQkvc2M3R/B10l7/aGvXDX00JlSCR2BfypARhjjKkZ4wxwSxGPlCefXxcacVyszhhZV5vmWh0d1r+geDdJjfU5YtPs1RzFEifeCLltiKMnCrzgcAe1cUPekrncoRpfCrHLal4t17xDps81rcPo3h6e2lk/tsSOuIPLSSO4iO0FvlL5RRnjl0616EKMIu6Jq1Zcpe8O6fqU+sRWngDw3bTJC7w3/ijUXMjLMXDSTQqd0eWJYZBMmCOMKrNcqkaUGzlk3Pc940ixfTLAPJfNcyXDCSdjjCyMAXCAdE3biBk4zjOAK+NzDHyqO99TuwlGD1ZU1+/RI3RZtp2nBHUGvlsRVqQ2PWUYbHEWZR7aEqVP7ociv6Vsz85RM3C8UdDRDMk1N7lWCkBIOlYPc2ilYD0pMbSsGenNYy0RKWhJETzgms73GE/21oiLSONn4x5jlB+YB/lQM8b+KvxFudUjvPB3h66huFZSk1xHFxHL2UZzuKkAkjAyCMEUnRbV7mtK9z4u8X2fjnTLyXSfGet3JIzhlfYlxEfutgYBBHUdjkdq82q3ezO+jojhLy90+xAW3AWJWwX4+Y+gz1NYOKOhTaO6+GHjia3vTpNwxaxu4hJCzH7jbsY9s9x6+xyc3A15j7e+C3jddc0tdAvZP8ATbCMeWT/AMtYBgD8V6H22+9c1WNpEt3Z0/jX4eeC/iNZ2mneNdBg1W3sLkXVukrMPLkxgn5SCQRwVPB4yOBjNTlHZi5UY3wi8BeJPhz4Vu/B2v65b6pp1neyJoMygrNHp7cpFPkAFlLFRjPAx0AAtSqTdo7g+WOrK9jrXh3wZosen+DdGto9PtZTGtvZxiGNVO4l1+XEmWGOMlmJ54bHs4LK+etbFStZX9bHNiMSlH3I6lJfAevazPc3vibWFndJ2KpbP8rx5UgDkhQGUFSrE8H+9x14rMsNhY8mETu9GYUqFWfvVduh2ek6Vp+lwY0u3SCNSWk2/wAXPBP0HH4V8tiMbUrS5JNno0aaUTm77x1rmv65ceFPA+kTmaE3Fre6nLEqx6fMEYI+ybAcCQEEckhGwDlSedwT3N0uXYl0v4bWkerXmr67dz6pc3T7zH5zG3jJRUYKucsjBEyjll+RTjOSdIQtJCdjotB+Dttret/8JH4w1i51m5tpbr+z0lRYhBb3CeWYW2ffATHHA3Fmxlia7HNU9WY2uewaBYW+n2o08QRRfY4xFBFHGFjWIDgKAAAB0wOlfK5vjZOyizqoUoyvdEl9eCyjZpSNsnOOy18tUrOT1OmnT5djynx/4qWxhaUP94YHNckU6smj0YwXKtDzrw34z+xWcN5FOs8TKBtVsqfoa/qXldSLcT8tPSNG8R6XrkHmWc+HAy0b8MtcsqckjWLRpAg9CD+NYt23LEKselZTd3oNRbAZHWoNI3Q89DWTKuyMkYqZNNDu2Is+w4UE59KgTPNPiD8UJpzN4a8I3JIkQR3Oowt80efvLEQeuMjeOmfl5wQhqLa0OEjjg0W3xBAC4G7cVqlI6ab5Twr9oW4h1jSRqk1uTd2h2wnJwVPVWAPTof8A9dctampO50QqLY+bhZPe6gv9oHy5rgjAWMMIlz/cGOf9njg1ySUUvdNU+52sHw18TW0Ed3oV5b6rBeyYWeKRcyODkLhiMcj1PQ/SsWjZSTPbfg/4+1mwuraXUhJaeINGuFSeKXAaRQB8xA4wwyCOn4YrGpFSVyj7K0fXrbWtIh1nTm3Jc7SAeqjOGB9xzXE1ZjK3jXw7e+JV02TTtffTvsMxkchWfqMBlUEfOOcH3yc4Ar2MpzaGX80akbpryv8Aezkr0ZVJqwv/AAiui6XJNeafbiFp0VQS5wiKSQqoPlRRuwABnAGScZrz8XmNbFyXNsjejQhSlc4vWfigbe5fQvBVi2tasJpLMlY2aGK4XblW5BYAMCSpCg/Kzqc44KcnrzHVUipL3DqF8H6hd3Oj+K/EV2Bd2MLO1rbgJDBJIqhl2733HGVY7iD1GAF2smEXFWZ2myOe0S5Zic/LjO4CtY0puzSBzSJLC1VyFH0runF01eRzKSbsjpdIX7LIUYkDaMZ7c9a+azXMLLkgdNKDvc15JPLjMgb5wMA5618fiK0ZN3Z6NKDscb4o8TxW1rMHmVdi5YmvLmnOVkelhqclA+ZviB4xl1C8mtEuCYIzwSfpXv5bgGvfl1R0OrFaNnz/AOEvHmu+H5VktLp5bVjue2lJKNwB0zwfcfr0r9yw+YuCtJn51PBxa0R6x4J+IM2ra8k2nahDgjfLZTzeXPbgcF4z0kUdTjsO1ehRxkMRLlRw1cLKjHmZ7j4K+LOk6xbiHULmNWDiNZVzgnvuHbtz7069BpXRmmejIQyhlOQeQR3FcBvDYXA9KlzSKsgPQ/Ss2xWIJNoQs7hVHJJOAKzGzyL4l/E2K9U+GPC1xwwK3l2p4bn7iH0x1PfoPdDjG5yukCx06EK5G48n5Sc0maxVkRajqcly7FMBccDZigo5vSrO3Hjex17WtCGq6VbMzz2JYIXkCERurHoVfYcd9tTJXVhxdnc89/aW8MaFqVyfGnhLwRa6C1y+2/lhlPyMSMMEQKi7uQxweTnPzVyOg1qdCqJngtvqDeHI3tbLWbiKR2VmFu7DJGccjHqfzrBqxpF9j1D4dx+Ibt3n1eC7EkMXmWlxdqyyPk/MpLfMV4B57nvXLWmo6HXCDmrn0T8K/Hw0W7a3vJJXsbrajqpyInBPzAfjzj9cYribuNwaPoNpikZeFC2Fzt9fasnB7iOe1zwxdeK7efR9Y1Jf7NuIJo7iNEwz7nVonVhgxvGVyCMjk5B4IzGlzDtK8PaVocNxPo1pHbz3JL3EqDEtzJuLbpG/iJJPXpnjAoNoLl3N7T7oskunXpBlADHI42scD+RrenSc1dBJ6lq1aTT7g2jRObWVtqNjIDEcZ/Gu+C5YpHFOa5mjs7PSISqSxnsOcda8nMcxUYuN9bDpUnzIlu44gGVzgr0Ir4ytW59WerSpu5y+oa4bMuhueMHALV4OIrJSsenh8PKSdjwP4oePVuC0VhLIs0T8MDwydxweea9LAYP2/vHWpew92R5Beap5zSTXGSz/ADMK+rpUnTionBUmnJs8Ytrh02Kp4Civvo7Hy55t441m6bxLFe2t1JDNZsvlPE5VonVshgRyCDzkelbU5+zd0Y14KcbHqnw1/aCtra6WDxpBHFeSIYE1aNNqYYg/vo0HqBl1GeBkdTXo08Y56SPPnh+VaM+p/hv8ZNR02xgkv5IJtPlKomLxJYpMnhoXU4II6DJznsenQqcamtzFOUdLHvPhvxNpXiizF1ptwpZRmSEsN8f1Hp79K4Zq0mkao1yuRjNQwOG+J95d/YINBsJzFJelmldSQRGuBt+hJ/SoY4Lndjx1tN0zTbho5po1ZeuTilc3jDlJlk02V/3dwpAHO00irCTX2l268uCRQFipp02peJtSXRvCemSXd1wXwNqRL/edjwo4P1xxmk3ZCsd5F+zgPEGmyWfjzxLIY7obZ7XTlAXGegkkBz9dgrL2oj5s+Kv7K+j+E/Elva6HfXFgqSvsmlVpRcoR8jZJGGXnOOCeOOtc9XU6KTubiaa9rJGZrs3DxwrFvZMMQO5OTmvLxO56tH4RlhN/Zkkk3VJpWBGfunJwf5VyGrVz6J+FPjiHWtKGlahcE39oCF39Zo+xB7kdD36HnmqeqsZNHe/fO1VxGyfN7nP/ANf9KzcAjGzI5IXWVGiX93jD8fkaqlR9pccpcpfi01LwiTPO3gjqfb6V206fs1Y551mmdDp9tHuaO6QFABtyMjP+f5VxYjHxo3Rl7OU3c2rWePTpVgJ3rPkRjPQDGf518bi8R7ZuR6NKj7yuZOu6nFDC8xbau0tn1H+RXg4nGSgrRVz1KVFX3Pnb4rfEFoJzYW24EblYk9cjt9OPzrTB4V4t80tDvpNUkzwnWNfuBdhpMuHXGfbNfWYXBxorRnJWr80rmLrWp7R5kb4BTBI+nNeoqSaucrldnmUFyPsqSk7nKA9MfhX2ED5xuyPItVuXur+4nkADGVun1qzFyb3KZlcd6a0EdR4K+JOv+CpfJt3F3pjvum0+Zj5Tn+8uOUb/AGh+ORxWqrzWzI5EfTHw1+NljfG0u/Cd28VzCga6tGcLcxkAZKjpIoORkdeMgZrrglOPMzmmrM+pPAnx00nW0Wx8RgWd3wEmHEcvuR/Aentz2pygkmSyr8R/Eif23PFHtzBboEkzwM5Pb6iuVl0tz5m8b6nrLzS3sl0QxOUZTn8h+FSdBX+ENz4i8deObbwgdY+xpcRyyG4ERkaMIhbONwzkgDr3oA+j9H/ZxZrqO517xxLd2w5aCC08pn9AXLHHvx+NYObTA9d8P6Ho/hizXTNC06GztwclUHLH1Zjyx9ySaXO2ZuTNdWJODUCucp8R/Av/AAnWlpbo0YurRHe03DBMpxgFs4CkBhj1IOeKmSujWnPlZ8wahZXFvdSW08LRyxMUdHGCrA8gjsa4a9JtXPTpVG9EZUkSqZoyM+bwwPHUYNea1Z2OxbFrwrreoaNqSkzf6RaOJI27Mh6A4x7g/wD16dwaR9Q+HvENvrukwX9sNnmICUJyVbHKn3BrSCTZmdVosCzqGdgS3UY4HtXVSilexhWk1Y3NM0lrGUWpgPlynMRAJAPcE/yrgx+Mlh3aLOf4tzQ1W3giVVVtrHJGK+JxWJnVqSbZ61Fe6jldV11IrSWGVs7QRuHb/OK8udRrVnoqC5keSeMfiglqlxoxbE3+sXOfmVlBDDPtRhcM8XPm6HWoqOx4Frury6g6yGVmkBOdxycY4/lX1OEw0KSskZVZNI5i4lMgZzyM5HNepCCsec3c53W5XIMe7Kj9RXdGCsQcAlyViZM8bT36V9HA8SWx5heEm6lPYux/WtDArtQA09aAJLW8u7CdLqxu5beaNgySROUdT6gjkVSnJdSeVHr3gf41+dqduvjC7NrIoCHUIQwEi8cSIvc4+8Bj2710wrXWplKnqfQOl+Llv4po7a4M0Mio6yM+9XQjgowODx1xVuUXpYmMOUoeIbkGEQWxjaOYfvVZFYH25HB64IwR2NYNamyNP9mtdDsvjbbpDNh7vT7mGOCbG9ZMbzsOPmXanX72SeMc1hUumB9nZ28DgViZtu4AnPWgRIrt60ATRMxBOaAPHfjp4KAx410+BFXCxXyouMHoJT9eFJ9dvqawrbHoYSStqzw67CnnFeZUh1PTUkzJvVufL82yKieM7k3HAbHO0+x6e2a5yj0f4XeO0t57ZRL5dreTKs28YMbjj5h2weCP8K0puz1Mq1+XQ+pvDMMcjefGCF6kHoTWeLxPsYXizks3udorQtbfZ1k2vjAYdVPY/WvjsRjZVXaTO2hSThqjjb/XULPDckrc2pKy8cNjOGHPQgZr5+tUlzvU9OnBWWh4z8SPGcdrPLaiVSsg6Acc56/pRQhOpUSadj1uSKWqPn/xHdT6jK0kz5ZOjjj+VfZYDCxpK6R5+Im1LRnHTTXNnKWkunlAbcAev3SMcfWvTUEuhyube7JY5IZbOJ3bJYhTj1J4FaJMzZz2thwz7c46V1x2RB5pdt5dnLJnA2HBr6GGx4snocHc9vWtDnKzHFADCcmgBh60AJQB1Hgz4ka94KmK2kn2qyfh7SZ22DnJZOflbrz055B4qoPldyWro910L4neGPEelG5tmcyKVFzbOCJYc5+bj7yjBOR264PFac6FZnV/CqdtN+KfhfxPp1yk9iuqwwyyIcGOORhHIG9Plds+gqZJSQH3ysSsM55rmejM3uNMEg/h4qboQgRs9Kd0wJYlIBGKpRctgHSWkN7FJaXMCTRTKUeNwCrKeoIPUe1aLC8+rIckj5U+J3gW/wDA2vPYTLutLjM1nKP4o8kYPow6EfQ9683E4acG9ND18PNOKscLcRuh5XNeVJOO53qSexVtp20jUxdlgLW5wkinokpI2v8AjnB+inj5icajTRR9RfBv4jtqdkNK1Kc/a7dchmPDp0/McZ+o6814uZcyimhxipM9Qm8Q28MfmrLnkZO4fnXyFacZyvE9GGGc1dHjPxT+IDWJXVbK52SeYsEscbAnYTgtg9h3x7/Ss6VGeJny9EdsaUoRVzw/xH4p/tyZ5VcyK5JB6Zr7LB4SUY7GGIxMb2Ryt3qGF2BmwDlc8E+1exQpvZHDOXVnP+aJGLuxDA9D3rocJLclSTIbO4jt9SXz3K28sqs5J4jwetCi3sUPZPtMrJdN+8JyQBjke3atUZs8f8QzrBpcgAOGAXge9fQQR4DmmrHCu/y4PXNWZkTnOKAGE4oAaaAEPQ/SgCKgCW1u7qxnS6srmWCaM5SSJyrKfUEcigD2P4cfG+KyRNK8VhIgGyl5HGfmJ6lwO+edwHPf1NKSSsSz6++GHx+1Lw9Nb6frbpqmjSKux05liXbhSrDhl6Zz25B9eWtUVJczN6WCnWfun0Hp3xL8Cauqix8R2zM6glWDLsz2YkYH51w/XqDdlIv+y8St4nQxFJxugkjkGM5Rgw/SuinWjLVHPPDTpuzJoInckBT+VenQg7XOOU0nY1bHTJJCH2j8a6eZU1qZSfM9Cj8RfhQPiH4Qn0N0iW9jzcafO52+VOBwCf7rfdPXg5xkDHgY7MKd+XzOrDTknufEusaRd6dcy2OoW0tvd27NFNDKpV43U4KkHoQa82rOMloe3Q1Wpy2tyBbc2WQXuVZMYzgY64rilsdJo+C9f1DRbu3RryQ6hakujvj94h4yPXglTwDkZwMiuTERjODi1uaQi3senap8UZjZCRLiQDnIbqK+SrZbNVOSJ7WFklDU821nxjDeF74zCXdlWHXnJr1cFhFS+JainUlNuKZx9pqEEUm0yN5W5iBjpk5r2KcpJpHNUoaczJdRRJ4nOSGcbkYcEH1r0qLszimro5GPW4oZfs+pJ5cg4YDnB/qK7FD2iOdy5GXLt4rqAfZGVlYEZFEadkX7VE1mwnhjuY5B5oQqw9wMdfqKzlGzKTueJeJLwSoqITjbkiveifPHLMc1YDGoAY3WgBKAEPQ/SgCKgAoAKAPXvA1xf+FbGBZNTmKS4lWMSMEQHnGPfPPvXBiffXKe9gqShFSR6d4W+I10moI8hMVuXXLFs49T9K8bEYVRi7I92lNSkrn0h8OviZeWVw93Y6orRuoBA2ukg/Hj8RzXLhKs6MtTmx2DhXlbY+i/BnjXRfEcccdxIlrclMt5hCoT32n+hr6TC5ndWkkfLY/Kvq9nBt3PTLDTxCo8xcA8gj0rHHZlZ8sTy44eV7SRfdkiGAeK+SxOLkpOR1QoKLufNP7U3w6huGT4gaLFIbnIh1KPqGUKAko+mNre209jSweb3/dStdnrU1ynylNo8pvZL652u3ITC42qe3vXptXOgx9SlkFwslmP9KsgXQ8jr/AT6HH0zg9hWFWGmhrTdjN8Yz3+r+Hzf6PdTLPbjdJDGx+dP4wcc5XH6GqwsE5ao0nVcXZHm/h+5uBpM14ry/PLtLbj2H/167pxUtLHRhIc0m2zptJV5baR5r5o3CllBySx9K5rI6ZK6aNqy1Ge5hihlQEoNo49KuCu7HBOPKc34p01pne6jG11r0aXu6HLVinqYWj6sjBoZLgxyRtgoSRXX7JHOprqdTo0jyWTLbxbmll2eYfuZPb3PsOSeOpqXQTLVSK6nheuzSC4KA8Diu+J4xksTVgNzmgBrdaAEoAi3N60AJQAUAFAHaeGtdW8tItHuXxLHxG7H7w54/CuWtC+p6uExKtyvodVHLc2g2QtgenWuWor6M9WlUa1R2vgjxfeaROq43RhwSMD8a4MTSjGPMjqpVJTlZn1N4B+KOiTLB+8XDcc9j6EV5lWsqSuwrwU7XPozwJ8S5lhSM/6ZYt2Z/mQf7J/pXz+JzJ897nJLARqapHoM+v2V1b+fZzKUIz15H1FcNTHKromccsvlGW2h53438U2wt7m2nKypMjxuhxggjBGKjA0nOtGpLdM65UYxjex8f8AiZVge6j05N6rKyxA+meK+9pRUo3ZyHnevXE2j28l/Oz7Y1yybs5YmtPZxYGJpmpNBJ9vZiYL2QHYUxtYnAzj17muaa9lP3TeCU1dlSfTNO09JbewXbbyzNNsz90nGQD6cce1L2sjtpfu17pT+12tqwBB4pJts0Um2TW+swxzb0OATzmtqe5hXNS5CXkTBcMW4NehDocU1dM84u7Gw0/xDdR6oLhoiGZBAQpLbSVGTkYyADwa9BO55NVOMtTp9C1pNRvlt5Xjs7aXarHPyggDAyf9rOB7qP4RgMjw2+cvMxZ92STya6ImJVPSrAY1ACUAFAENABQAUAFADkkeJ1kjYqykEEdQaTVxptbHonhvxDb600dnKfLuThcH+L3FceIpvdHsYPFJvlkdbFPJakWz4KD7pxyK8yWujPbjbeJq6Tr8+lzrIJ2QKeGHUVyYnDqrBmsbP4j3T4IfFvUNP1SW3uJ45oJV2nzG+bqDke9fG47CuktjWPkfRL+NYjbPfadeEHuoJ6e9fLynKM2dipJxvY4fU/GSazPKrzMJEycf1r7jJpQrxvy9Tw8ZCUXojzLUp1lad1Iz5jEfnX1SjZbHm8y2OR1iJZmQu7AoSw2sRk4xz68E9azqNo1ppM5/UIYjC0exdrAg81yzd3qbx0Ryn251nktJ1wyEAMDw644P19aSTextGRBNHuUknJrayNSAovkFSACa0huc+I+E0NM1t3hex8sieA/eHR17H+hrtWx5zbJtY0W01IJcPGH2qcnnmr5n0ZLimYRtX02VZLWIeU4wVIzx+NbU6jehhUpHjUjBiSDXfE84izirAQnNACUAN3L60AR0AFABQAUAFAE1ndTWN3DeW7bZYHEiH3BzSaurDi+Vpo9U0PxBZ69bJcF1SccSRA5Kn/CvOxGH6xPdweP05WWndt2f4Qa4WraHoyquZq6RdNCd8UhxkdD0rjxeEjiI6m9CuoKzPX/D3xSvLSyNk7hgQP4zmvj8TkC9o5RvuexTxC5UWJ/Fb3MhuYJfLlbuD0rtwVGeD0h3OXETVZNMbHrdpOzCWQJIeoPQmvqqGKjUjab1PnKuCcZcyM+/mjkyVdfzorRvqgprl0Od1M4UtngVxyi2zphFtHnfijxLZaTfWVq+GllcFyf+WcZOM124XDzd5GMq8IvlbNgdKxe53LYikUMSD0pwdmY103HQrrEYmeeF2SZR8jA9RnJU57HofrxzXfBOS0PMk+V6mjD4lhe1ktJWS2xG+S5wFJJ4yav2cjN1YLdnDa78SYY4obXSk3vFGFaR0GN3qPWtadGS1ZjOvB6XPPh92vQicAxulUAlABQBEep+tACUAFABQAUAFABQBb0rUbnSrxLu2bkH5lPRh6GpcU9wi3F3R6lpV1Fqdot0g4kGcZzivLxEUnofQYSTlHVkrSSWMgYsBGeCK5TrNm1vkkVXR8jsRUuEXui1UktLmzZa3hgpf2rhnhHujshNdTZW+ikXceTXM4umzSXK1qVLi8mj+6wKk5AI6V1xquSszhlSV7o5/wAUeKBpOlS3MxbgEIAMlmxwPpW9Kn7WXKjir1XRVzwq81Oe+u5Lqdy7SNuJbk17sKShFRR4cq3PUcmeueFdRGoaDa3DvuZV8ts9crxXi16ThNo+ko1o1I3Rol1Yms+Ro15lIgut7Qv5X3sHGa78PKyszysWknoeQavrF7qFwTdMykfLsU4FehFdTyak02ZLYycVqjB7lwfdqolDG6VQCUAFAER6n60AJQAUAFABQAUAFACjg5oA6Hwj4jfSL9IJmH2WdwJM/wAJ7H/GuSvRU1c7cNi3Sdu56hdWkFxGrZDK3zAg8V5kk46M9qnU51cqW4kt5wqj92eMntUmmxoxqFYY9aDRVC/DeSRjAOa5pr3jdyvEnW73qfMIGPepsZs5jxxc2iaFN5pUuVIj/wB6uzCQUpJs8zHbHjjr8xPvXtJWPnndSOt8D6u0Eh055Cqk7k54z3/pWNWkqmp6GGqypyS6HfTXttbKGnlVQfevNnScXax6jrpGXd+KtMgRs3CZzgDNaUqLbObEVk0eZazJbzajNNan9253CvRguVWPHqPmdzPPWtUZlwfdpxLGN0qgEoAKAIj1P1oASgAoAKACgAoAKACgANJ7Evc9Z8EySSeGLUyOzEM6jJzgAnAryMT8Z9Dgv4ZrS/6tfrXP1OzqWk6igRMvWsahvH4Qb7prIbPPPiE7m+hjLtsEGQueM7jzivSwK0v5nl47Y4p/616x4MtyWzYrcxlSQc9qg64dCzqd1dNL5bXMpUdFLnArOybZdR6mVIxJ5JP1rWKscU229RBTZmIetNAf/9k=\",\"url\":\"https://audio.fulou.life/2022127/8510640575.mp4\",\"original\":\"111.mp4\",\"size\":9471705,\"duration\":126}]', '{\"id\":47,\"title\":\"2.html\"}', '[{\"id\":47,\"title\":\"2.html\"}]', '<p>111111</p>');

-- --------------------------------------------------------

--
-- 表的结构 `trades_order`
--

CREATE TABLE `trades_order` (
  `order_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单id',
  `trade_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '合并支付订单ID',
  `user_id` int NOT NULL COMMENT '用户id',
  `amount` decimal(20,3) NOT NULL COMMENT '订单金额',
  `goods_amount` decimal(20,3) NOT NULL COMMENT '商品金额',
  `goods_privilege` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '商品优惠金额',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态',
  `ship_status` tinyint(1) DEFAULT '0' COMMENT '发货状态',
  `coupon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '优惠券',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '订单备注',
  `payment_time` int DEFAULT NULL COMMENT '支付时间',
  `payment_platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付方式',
  `create_time` int NOT NULL COMMENT '下单时间',
  `update_time` int NOT NULL COMMENT '更新时间',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='交易订单表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `trades_order`
--

INSERT INTO `trades_order` (`order_id`, `trade_id`, `user_id`, `amount`, `goods_amount`, `goods_privilege`, `pay_status`, `ship_status`, `coupon`, `status`, `remark`, `payment_time`, `payment_platform`, `create_time`, `update_time`, `delete_time`) VALUES
('2000000883752793', NULL, 1, '73.000', '73.000', '0.000', 1, 0, '', 1, NULL, 1646287361, 'appapplepay', 1646287357, 1646287357, 0),
('2000000919785962', NULL, 1, '198.000', '298.000', '0.000', 1, 0, '', 1, NULL, 1640746415, 'appapplepay', 1640746413, 1640746413, 0);

-- --------------------------------------------------------

--
-- 表的结构 `trades_order_detail`
--

CREATE TABLE `trades_order_detail` (
  `order_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单id',
  `payment` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式',
  `received_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '收货状态',
  `tax` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '发票信息',
  `ship_amount` decimal(20,3) DEFAULT NULL COMMENT '邮费',
  `shipping_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货地址',
  `consignee` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货人',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收货电话',
  `shipping_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配送方式',
  `delivery_waybill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配送运单号',
  `delete_time` int NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='订单详情' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `trades_order_log`
--

CREATE TABLE `trades_order_log` (
  `log_id` int NOT NULL COMMENT '日志id',
  `order_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单id',
  `behavior` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '行为',
  `log_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '日志内容',
  `admin_id` int NOT NULL DEFAULT '0' COMMENT '后台操作员id',
  `create_time` int NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `trades_order_sku`
--

CREATE TABLE `trades_order_sku` (
  `osku_id` int NOT NULL COMMENT 'id',
  `order_id` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单id',
  `sku_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '货品id',
  `user_id` int NOT NULL COMMENT '用户id',
  `suku_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '货品标题',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `price` decimal(20,3) NOT NULL COMMENT '单价',
  `amount` decimal(20,3) NOT NULL COMMENT '货品金额',
  `buy_num` mediumint NOT NULL COMMENT '购买数量',
  `sku_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '货品类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='交易订单货品' ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `user_id` bigint UNSIGNED NOT NULL COMMENT '用户id',
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '头像',
  `nick` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '昵称',
  `birthday` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '生日',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别',
  `regip` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '注册ip',
  `reg_channel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown' COMMENT '注册渠道',
  `vip_endtime` int UNSIGNED NOT NULL DEFAULT '0' COMMENT 'vip截止时间',
  `create_time` int UNSIGNED NOT NULL COMMENT '注册时间',
  `update_time` int UNSIGNED NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='用户信息' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`user_id`, `avatar`, `nick`, `birthday`, `sex`, `regip`, `reg_channel`, `vip_endtime`, `create_time`, `update_time`) VALUES
(1, 'http://test-cdn.zhanshop.cn/202332/16777342879151243758.jpg', 'uya', '1988-12-15', 2, '0.0.0.0', 'IOS', 1991117871, 1632379485, 0),
(2, 'http://test-cdn.zhanshop.cn/202332/1677734032920279523.jpg', 'h43', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1625839334, 1604556411, 0),
(3, 'http://test-cdn.zhanshop.cn/202332/1677734281390235298.jpg', 'dfw', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1604558142, 0),
(5, 'http://test-cdn.zhanshop.cn/202334/1677918593343907900.jpg', 'gfu', '1988-12-15', 2, '0.0.0.0', 'iOS', 1652016858, 1604893163, 0),
(6, 'http://test-cdn.zhanshop.cn/202332/1677734282474408175.jpg', '3sg', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1657072902, 1604903180, 0),
(7, 'http://test-cdn.zhanshop.cn/202332/16777342875061185592.jpg', 'd3b', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 1692325123, 1604906934, 0),
(8, 'http://test-cdn.zhanshop.cn/202332/1677733947860451524.jpg', 'ugs', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1605233930, 0),
(10, 'http://test-cdn.zhanshop.cn/202332/167773428043994966.jpg', 'qba', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605238022, 0),
(12, 'http://test-cdn.zhanshop.cn/202332/1677734282772445560.jpg', 'y24', '1988-12-15', 1, '0.0.0.0', 'wechatMiniapp', 1617948889, 1605245339, 0),
(14, 'http://test-cdn.zhanshop.cn/202334/1677918591182561997.jpg', '3ib', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605497126, 0),
(16, 'http://test-cdn.zhanshop.cn/202332/16777342906971671200.jpg', 'guu', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1605519865, 0),
(17, 'http://test-cdn.zhanshop.cn/202332/1677734284666748463.jpg', '0bu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605543449, 0),
(18, 'http://test-cdn.zhanshop.cn/202332/1677733947364386323.jpg', 'uhb', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605577810, 0),
(19, 'http://test-cdn.zhanshop.cn/202332/167773403126359038.jpg', 'uqu', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1605582995, 0),
(20, 'http://test-cdn.zhanshop.cn/202332/167773394504268088.jpg', 'gsi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605588182, 0),
(21, 'http://test-cdn.zhanshop.cn/202332/167773394505972776.jpg', 'b2h', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605594847, 0),
(22, 'http://test-cdn.zhanshop.cn/202332/1677734285245836101.jpg', 'qn4', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605613287, 0),
(23, 'http://test-cdn.zhanshop.cn/202332/167773374062648682.jpg', '8ua', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1622857746, 1605619794, 0),
(24, 'http://test-cdn.zhanshop.cn/202332/1677734312035115199.jpg', 'ajj', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605685557, 0),
(25, 'http://test-cdn.zhanshop.cn/202334/1677918588769167139.jpg', 'bya', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1605709548, 0),
(26, 'http://test-cdn.zhanshop.cn/202332/1677734032405203587.jpg', 'jha', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1630115964, 1605754008, 0),
(27, 'http://test-cdn.zhanshop.cn/202332/1677733947247376357.jpg', 'b31', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606106197, 0),
(28, 'http://test-cdn.zhanshop.cn/202332/167773403102813894.jpg', 'wyq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606148245, 0),
(29, 'http://test-cdn.zhanshop.cn/202332/167773374008418593.jpg', '0bb', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606190293, 0),
(30, 'http://test-cdn.zhanshop.cn/202332/1677734290326160601.jpg', 'aus', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207319, 0),
(31, 'http://test-cdn.zhanshop.cn/202332/1677734281390235298.jpg', '3f2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207324, 0),
(32, 'http://test-cdn.zhanshop.cn/202332/1677734283738592570.jpg', 'ab3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207334, 0),
(33, 'http://test-cdn.zhanshop.cn/202332/1677734035015591070.jpg', 'abi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207497, 0),
(34, 'http://test-cdn.zhanshop.cn/202332/167773374013023620.jpg', '0ih', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207503, 0),
(35, 'http://test-cdn.zhanshop.cn/202332/1677734285818928436.jpg', 'jyw', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207506, 0),
(36, 'http://test-cdn.zhanshop.cn/202332/1677733947189364155.jpg', '27h', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207508, 0),
(37, 'http://test-cdn.zhanshop.cn/202332/167773428009454213.jpg', 'ys3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207512, 0),
(38, 'http://test-cdn.zhanshop.cn/202332/167773403126359038.jpg', 'jy8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207521, 0),
(39, 'http://test-cdn.zhanshop.cn/202332/167773428039387745.jpg', 'ib8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207529, 0),
(40, 'http://test-cdn.zhanshop.cn/202332/167773403102813894.jpg', 'jiy', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207552, 0),
(41, 'http://test-cdn.zhanshop.cn/202334/1677918588510121400.jpg', 'jaq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606207567, 0),
(42, 'http://test-cdn.zhanshop.cn/202332/1677734284538724885.jpg', 'jiq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606220038, 0),
(43, 'http://test-cdn.zhanshop.cn/202332/1677734285946944293.jpg', 'bfh', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606220532, 0),
(44, 'http://test-cdn.zhanshop.cn/202332/16777342894591475512.jpg', 'b8a', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606224531, 0),
(45, 'http://test-cdn.zhanshop.cn/202332/1677734281390235298.jpg', 's3j', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606224538, 0),
(46, 'http://test-cdn.zhanshop.cn/202332/16777342894591475512.jpg', '2ag', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606224743, 0),
(47, 'http://test-cdn.zhanshop.cn/202332/16777342902491592510.jpg', 'ujq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606228251, 0),
(48, 'http://test-cdn.zhanshop.cn/202332/1677734035686695897.jpg', 'bai', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606228656, 0),
(49, 'http://test-cdn.zhanshop.cn/202332/16777342870541124726.jpg', 'wba', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606229217, 0),
(50, 'http://test-cdn.zhanshop.cn/202332/1677734284387697884.jpg', 'f2q', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606231126, 0),
(51, 'http://test-cdn.zhanshop.cn/202332/1677734289763152855.jpg', '2w3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606242972, 0),
(52, 'http://test-cdn.zhanshop.cn/202332/16777342886381352495.jpg', 'bb3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606244255, 0),
(53, 'http://test-cdn.zhanshop.cn/202334/1677918593515933911.jpg', '2ia', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606249387, 0),
(54, 'http://test-cdn.zhanshop.cn/202332/1677733741536161856.jpg', 'uua', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606250082, 0),
(55, 'http://test-cdn.zhanshop.cn/202334/1677918591074545558.jpg', '4j2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606250864, 0),
(56, 'http://test-cdn.zhanshop.cn/202332/1677734280506103309.jpg', 'wa2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606251521, 0),
(57, 'http://test-cdn.zhanshop.cn/202332/167773431193110983.jpg', 'bd0', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606306417, 0),
(58, 'http://test-cdn.zhanshop.cn/202334/1677918588631155598.jpg', '27w', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606315042, 0),
(59, 'http://test-cdn.zhanshop.cn/202332/1677734283715588734.jpg', 'b2y', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606317367, 0),
(60, 'http://test-cdn.zhanshop.cn/202332/1677734284946788945.jpg', 'j10', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606331332, 0),
(61, 'http://test-cdn.zhanshop.cn/202332/16777342906971671200.jpg', 'ajd', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606495692, 0),
(62, 'http://test-cdn.zhanshop.cn/202332/1677733947657426626.jpg', '4ha', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606523816, 0),
(63, 'http://test-cdn.zhanshop.cn/202332/1677733945772188101.jpg', 'ssu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606530404, 0),
(64, 'http://test-cdn.zhanshop.cn/202332/16777342899511543667.jpg', '8if', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606530431, 0),
(65, 'http://test-cdn.zhanshop.cn/202332/1677733948393502943.jpg', '0eu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606576796, 0),
(66, 'http://test-cdn.zhanshop.cn/202332/1677734032748255570.jpg', 'buh', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1633924240, 1606713321, 0),
(67, 'http://test-cdn.zhanshop.cn/202332/1677734032621236172.jpg', 'aqj', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1606823866, 0),
(68, 'http://test-cdn.zhanshop.cn/202332/1677734281988326727.jpg', 'ybi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606856050, 0),
(69, 'http://test-cdn.zhanshop.cn/202334/1677918589502277437.jpg', 'suh', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606880162, 0),
(70, 'http://test-cdn.zhanshop.cn/202332/16777342876931219206.jpg', 'j43', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606880168, 0),
(71, 'http://test-cdn.zhanshop.cn/202332/1677734286018955205.jpg', '2b0', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606880190, 0),
(72, 'http://test-cdn.zhanshop.cn/202332/167773374338643470.jpg', 'jui', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894061, 0),
(73, 'http://test-cdn.zhanshop.cn/202334/1677918588962204801.jpg', 'ha4', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894120, 0),
(74, 'http://test-cdn.zhanshop.cn/202332/1677734282134341723.jpg', '3yi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894221, 0),
(75, 'http://test-cdn.zhanshop.cn/202332/1677734281328227440.jpg', 'suq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894238, 0),
(76, 'http://test-cdn.zhanshop.cn/202332/167773428441570211.jpg', 'jf8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894256, 0),
(77, 'http://test-cdn.zhanshop.cn/202332/1677734280858178504.jpg', '4bg', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894342, 0),
(78, 'http://test-cdn.zhanshop.cn/202332/1677734283645576887.jpg', 'abu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606894854, 0),
(79, 'http://test-cdn.zhanshop.cn/202332/1677733948156489067.jpg', '1yu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606895843, 0),
(80, 'http://test-cdn.zhanshop.cn/202332/1677734289763152855.jpg', 'aby', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606895852, 0),
(81, 'http://test-cdn.zhanshop.cn/202332/1677734035640684104.jpg', '7nu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606957806, 0),
(82, 'http://test-cdn.zhanshop.cn/202332/1677734284946788945.jpg', 'hig', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1606960390, 0),
(83, 'http://test-cdn.zhanshop.cn/202332/1677734281154207722.jpg', 'urn', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1606969993, 0),
(84, 'http://test-cdn.zhanshop.cn/202332/167773428458473791.jpg', 'b3a', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607005230, 0),
(85, 'http://test-cdn.zhanshop.cn/202334/1677918591587636706.jpg', 'fuq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607005760, 0),
(86, 'http://test-cdn.zhanshop.cn/202334/1677918588555137926.jpg', 'wb8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607006758, 0),
(87, 'http://test-cdn.zhanshop.cn/202332/1677733947059344238.jpg', 'jus', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607007012, 0),
(88, 'http://test-cdn.zhanshop.cn/202332/16777342894591475512.jpg', 'u2a', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607007339, 0),
(89, 'http://test-cdn.zhanshop.cn/202334/1677918588398118608.jpg', 'ajj', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607008353, 0),
(90, 'http://test-cdn.zhanshop.cn/202334/1677918593614949103.jpg', 'f04', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607008527, 0),
(91, 'http://test-cdn.zhanshop.cn/202334/1677918592571786063.jpg', 'jbi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607009157, 0),
(92, 'http://test-cdn.zhanshop.cn/202334/1677918591921681065.jpg', 'yaq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607012313, 0),
(93, 'http://test-cdn.zhanshop.cn/202332/16777342866591067941.jpg', 'ha7', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607014710, 0),
(94, 'http://test-cdn.zhanshop.cn/202332/16777342900131553570.jpg', 'f1d', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1622296210, 1607034224, 0),
(95, 'http://test-cdn.zhanshop.cn/202332/1677734283085485650.jpg', 'hse', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607038884, 0),
(96, 'http://test-cdn.zhanshop.cn/202332/1677733946963327355.jpg', 'uua', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607043523, 0),
(97, 'http://test-cdn.zhanshop.cn/202334/1677918588769167139.jpg', '3sh', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607044575, 0),
(98, 'http://test-cdn.zhanshop.cn/202332/167773403145379680.jpg', 'b2j', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607044874, 0),
(99, 'http://test-cdn.zhanshop.cn/202332/1677734032355199586.jpg', 'ffs', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607045082, 0),
(100, 'http://test-cdn.zhanshop.cn/202332/1677733945676165427.jpg', 'hau', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607045487, 0),
(101, 'http://test-cdn.zhanshop.cn/202332/167773403126359038.jpg', 'q4b', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607046281, 0),
(102, 'http://test-cdn.zhanshop.cn/202332/1677734031967142866.jpg', 'hww', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607046540, 0),
(103, 'http://test-cdn.zhanshop.cn/202332/1677734032464216514.jpg', 'a8d', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607046992, 0),
(104, 'http://test-cdn.zhanshop.cn/202332/1677734035640684104.jpg', 'uis', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607047249, 0),
(105, 'http://test-cdn.zhanshop.cn/202332/1677733741319137676.jpg', 'u2i', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607048786, 0),
(106, 'http://test-cdn.zhanshop.cn/202334/167791859329689128.jpg', 'iuu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607049225, 0),
(107, 'http://test-cdn.zhanshop.cn/202332/167773431143548266.jpg', '2yg', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1628138485, 1607050021, 0),
(108, 'http://test-cdn.zhanshop.cn/202332/167773428458473791.jpg', '8an', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607050293, 0),
(109, 'http://test-cdn.zhanshop.cn/202332/1677734282455394998.jpg', 'nj8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607051077, 0),
(110, 'http://test-cdn.zhanshop.cn/202334/1677918593142879692.jpg', 'nbb', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607053827, 0),
(111, 'http://test-cdn.zhanshop.cn/202332/1677733947189364155.jpg', 'r8g', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607054012, 0),
(112, 'http://test-cdn.zhanshop.cn/202332/16777342900131553570.jpg', 'u28', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1607055235, 0),
(113, 'http://test-cdn.zhanshop.cn/202332/1677734034577534665.jpg', 'a8u', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607057631, 0),
(114, 'http://test-cdn.zhanshop.cn/202332/1677734033523369668.jpg', 'bus', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607058318, 0),
(115, 'http://test-cdn.zhanshop.cn/202332/16777342864881035681.jpg', 'qay', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607062565, 0),
(116, 'http://test-cdn.zhanshop.cn/202332/167773428039387745.jpg', 'bi8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607063602, 0),
(117, 'http://test-cdn.zhanshop.cn/202332/1677734281561259295.jpg', 'ayd', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064014, 0),
(118, 'http://test-cdn.zhanshop.cn/202332/167773374081268931.jpg', 'saw', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064021, 0),
(119, 'http://test-cdn.zhanshop.cn/202334/1677918592990844778.jpg', 'q8a', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064151, 0),
(120, 'http://test-cdn.zhanshop.cn/202332/1677733741950227794.jpg', 'iuu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064220, 0),
(121, 'http://test-cdn.zhanshop.cn/202332/1677733742292274377.jpg', '0fn', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064494, 0),
(122, 'http://test-cdn.zhanshop.cn/202334/1677918591261582036.jpg', 'uau', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064594, 0),
(123, 'http://test-cdn.zhanshop.cn/202332/1677734284005648537.jpg', '3iw', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607064692, 0),
(124, 'http://test-cdn.zhanshop.cn/202334/1677918593188884382.jpg', 'suh', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607065297, 0),
(125, 'http://test-cdn.zhanshop.cn/202334/1677918590949524384.jpg', 'bd3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607065438, 0),
(126, 'http://test-cdn.zhanshop.cn/202334/1677918588510121400.jpg', 'j88', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607065607, 0),
(127, 'http://test-cdn.zhanshop.cn/202332/1677734312118131222.jpg', 'j08', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607065892, 0),
(128, 'http://test-cdn.zhanshop.cn/202332/1677734285599893679.jpg', 'ua2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607067721, 0),
(129, 'http://test-cdn.zhanshop.cn/202332/1677734280858178504.jpg', 'nuu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607070582, 0),
(130, 'http://test-cdn.zhanshop.cn/202334/1677918592504769445.jpg', '8sr', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1607071130, 0),
(131, 'http://test-cdn.zhanshop.cn/202332/16777337409849415.jpg', '1ha', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1607072073, 0),
(132, 'http://test-cdn.zhanshop.cn/202332/1677734283004472436.jpg', 'bd2', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1607075021, 0),
(133, 'http://test-cdn.zhanshop.cn/202332/1677734033307337220.jpg', 'hq3', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1607075417, 0),
(134, 'http://test-cdn.zhanshop.cn/202332/1677733947037332269.jpg', 'daf', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1633926690, 1607075642, 0),
(135, 'http://test-cdn.zhanshop.cn/202334/167791859329689128.jpg', 'hia', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607080379, 0),
(136, 'http://test-cdn.zhanshop.cn/202332/16777342873161163380.jpg', 'yys', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607080727, 0),
(137, 'http://test-cdn.zhanshop.cn/202332/1677734283715588734.jpg', 'abs', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607087925, 0),
(138, 'http://test-cdn.zhanshop.cn/202334/167791859219772837.jpg', 'uju', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607140781, 0),
(139, 'http://test-cdn.zhanshop.cn/202332/167773374338643470.jpg', 'ud2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607141285, 0),
(140, 'http://test-cdn.zhanshop.cn/202332/16777337409849415.jpg', '1a8', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607142123, 0),
(141, 'http://test-cdn.zhanshop.cn/202332/16777342909001695891.jpg', 'ia2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1633997316, 1607142591, 0),
(142, 'http://test-cdn.zhanshop.cn/202334/1677918593188884382.jpg', 'gsi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607164586, 0),
(143, 'http://test-cdn.zhanshop.cn/202334/167791858922324503.jpg', 'fbu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1627445270, 1607241569, 0),
(144, 'http://test-cdn.zhanshop.cn/202332/167773394496457872.jpg', 'ijb', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607271935, 0),
(145, 'http://test-cdn.zhanshop.cn/202334/167791858985632415.jpg', 'abr', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 1620919601, 1607311309, 0),
(146, 'http://test-cdn.zhanshop.cn/202332/1677733743634481566.jpg', 'fqs', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607337984, 0),
(147, 'http://test-cdn.zhanshop.cn/202332/167773374067359641.jpg', 'sah', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607425526, 0),
(148, 'http://test-cdn.zhanshop.cn/202332/1677734283321519485.jpg', 'u74', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607429850, 0),
(149, 'http://test-cdn.zhanshop.cn/202332/1677734284538724885.jpg', '2fq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607465365, 0),
(150, 'http://test-cdn.zhanshop.cn/202332/167773403123943985.jpg', 'j28', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607482949, 0),
(151, 'http://test-cdn.zhanshop.cn/202332/1677734284443719980.jpg', 'us7', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607503864, 0),
(152, 'http://test-cdn.zhanshop.cn/202332/16777342894591475512.jpg', 'ii2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607546690, 0),
(153, 'http://test-cdn.zhanshop.cn/202332/1677734033404342918.jpg', 'fw0', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607548067, 0),
(154, 'http://test-cdn.zhanshop.cn/202334/1677918592370746366.jpg', 'whq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607561778, 0),
(155, 'http://test-cdn.zhanshop.cn/202332/1677734031967142866.jpg', 'waq', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607583117, 0),
(156, 'http://test-cdn.zhanshop.cn/202332/1677734285103815945.jpg', 'uaf', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607593196, 0),
(157, 'http://test-cdn.zhanshop.cn/202334/1677918593515933911.jpg', 'hiu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607649103, 0),
(158, 'http://test-cdn.zhanshop.cn/202332/167773428336652744.jpg', 'i8u', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607677102, 0),
(159, 'http://test-cdn.zhanshop.cn/202332/1677733741892215035.jpg', 'f22', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607677107, 0),
(160, 'http://test-cdn.zhanshop.cn/202332/1677734033556376065.jpg', 'ufi', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607677122, 0),
(161, 'http://test-cdn.zhanshop.cn/202332/1677734033854419825.jpg', 'dub', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607678913, 0),
(162, 'http://test-cdn.zhanshop.cn/202332/16777342802977619.jpg', 'aaa', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607679398, 0),
(163, 'http://test-cdn.zhanshop.cn/202332/1677734033731392814.jpg', '8jw', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607680239, 0),
(164, 'http://test-cdn.zhanshop.cn/202334/1677918588398118608.jpg', 'h2h', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607680243, 0),
(165, 'http://test-cdn.zhanshop.cn/202332/1677734032968285183.jpg', 'awa', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607680790, 0),
(166, 'http://test-cdn.zhanshop.cn/202332/16777342867571073956.jpg', 'sjr', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607680869, 0),
(167, 'http://test-cdn.zhanshop.cn/202332/1677733742018234589.jpg', 'iju', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607681834, 0),
(168, 'http://test-cdn.zhanshop.cn/202332/1677734286288995434.jpg', 'us2', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607682024, 0),
(169, 'http://test-cdn.zhanshop.cn/202332/1677734035191614756.jpg', 'a8b', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607682942, 0),
(170, 'http://test-cdn.zhanshop.cn/202332/16777342879641252716.jpg', 'bub', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607689800, 0),
(171, 'http://test-cdn.zhanshop.cn/202332/1677733947037332269.jpg', 'f7a', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607695689, 0),
(172, 'http://test-cdn.zhanshop.cn/202332/167773427984414383.jpg', 'y3u', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607724620, 0),
(173, 'http://test-cdn.zhanshop.cn/202332/1677733946246248113.jpg', 'agu', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607733307, 0),
(174, 'http://test-cdn.zhanshop.cn/202332/167773403102813894.jpg', 'ss3', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607735611, 0),
(175, 'http://test-cdn.zhanshop.cn/202332/1677734285310845967.jpg', 'qwg', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607768827, 0),
(176, 'http://test-cdn.zhanshop.cn/202332/1677734282190353605.jpg', 'bns', '1988-12-15', NULL, '0.0.0.0', 'wechatMiniapp', 0, 1607836651, 0),
(177, 'http://test-cdn.zhanshop.cn/202332/1677734281761281154.jpg', 'sia', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608006873, 0),
(178, 'http://test-cdn.zhanshop.cn/202332/1677733742528301658.jpg', '788', '1988-12-15', 0, '0.0.0.0', 'wechatMiniapp', 0, 1608009084, 0),
(179, 'http://test-cdn.zhanshop.cn/202332/16777337409849415.jpg', '77h', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608087222, 0),
(180, 'http://test-cdn.zhanshop.cn/202334/1677918592566779725.jpg', 'nb2', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608196936, 0),
(181, 'http://test-cdn.zhanshop.cn/202334/167791859271679331.jpg', 'dus', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608199083, 0),
(182, 'http://test-cdn.zhanshop.cn/202332/1677734033781401761.jpg', 'y8f', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608200968, 0),
(183, 'http://test-cdn.zhanshop.cn/202332/1677734035686695897.jpg', 'qah', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608234649, 0),
(184, 'http://test-cdn.zhanshop.cn/202334/1677918589643294933.jpg', '2au', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608236223, 0),
(185, 'http://test-cdn.zhanshop.cn/202332/1677733742573311647.jpg', 'uf8', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608236263, 0),
(186, 'http://test-cdn.zhanshop.cn/202334/167791858806845554.jpg', 'yh0', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608239426, 0),
(187, 'http://test-cdn.zhanshop.cn/202332/1677734283938628012.jpg', '1ws', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608239444, 0),
(188, 'http://test-cdn.zhanshop.cn/202334/167791858819679941.jpg', 'jhu', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608239587, 0),
(189, 'http://test-cdn.zhanshop.cn/202334/1677918592419759109.jpg', 'adf', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608239727, 0),
(190, 'http://test-cdn.zhanshop.cn/202332/1677734281988326727.jpg', 'asu', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608245546, 0),
(191, 'http://test-cdn.zhanshop.cn/202334/1677918589502277437.jpg', 'jqa', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608245635, 0),
(192, 'http://test-cdn.zhanshop.cn/202334/167791859329689128.jpg', 'ssf', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608254869, 0),
(193, 'http://test-cdn.zhanshop.cn/202334/1677918590482431427.jpg', 'uyn', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608278360, 0),
(194, 'http://test-cdn.zhanshop.cn/202332/1677733743103394019.jpg', 'w1g', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608329110, 0),
(195, 'http://test-cdn.zhanshop.cn/202334/1677918593648958761.jpg', 'hus', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608456632, 0),
(196, 'http://test-cdn.zhanshop.cn/202334/1677918589684305957.jpg', 'bii', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608522919, 0),
(197, 'http://test-cdn.zhanshop.cn/202332/16777342871911144883.jpg', 'djs', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608524171, 0),
(198, 'http://test-cdn.zhanshop.cn/202332/1677733946823292293.jpg', 'uhf', '1988-12-15', 2, '0.0.0.0', 'IOS', 1991117871, 1632379485, 0),
(199, 'http://test-cdn.zhanshop.cn/202332/1677734290326160601.jpg', '83h', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608617326, 0),
(200, 'http://test-cdn.zhanshop.cn/202332/1677733946527262624.jpg', 'ufu', '1988-12-15', 2, '0.0.0.0', 'wechatMiniapp', 0, 1608618185, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_payment_card`
--

CREATE TABLE `user_payment_card` (
  `id` int UNSIGNED NOT NULL COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '批次名称',
  `vip_day` int UNSIGNED NOT NULL COMMENT '体验天数',
  `card_number` int NOT NULL COMMENT '发卡总数量',
  `status` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否激活',
  `create_time` int UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int UNSIGNED NOT NULL COMMENT '更新时间',
  `delete_time` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='会员付费兑换卡';

--
-- 转存表中的数据 `user_payment_card`
--

INSERT INTO `user_payment_card` (`id`, `title`, `vip_day`, `card_number`, `status`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '测试123', 31, 10, 1, 1678068636, 1678068636, 0),
(2, '5555', 123, 23, 1, 1678336144, 1678336144, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_payment_type`
--

CREATE TABLE `user_payment_type` (
  `id` smallint NOT NULL COMMENT 'ID',
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `vip_day` int UNSIGNED NOT NULL COMMENT '限期天',
  `price` decimal(20,2) UNSIGNED NOT NULL COMMENT '价格',
  `market_price` decimal(20,2) UNSIGNED NOT NULL COMMENT '市场价',
  `pre_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '优惠时间',
  `pre_price` decimal(20,2) UNSIGNED NOT NULL COMMENT '优惠价',
  `create_time` int UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int UNSIGNED NOT NULL COMMENT '更新时间',
  `delete_time` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='会员付费类型';

--
-- 转存表中的数据 `user_payment_type`
--

INSERT INTO `user_payment_type` (`id`, `title`, `vip_day`, `price`, `market_price`, `pre_time`, `pre_price`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '月度会员', 31, '30.01', '45.00', '1678032000,1680796799', '20.00', 1678068586, 1678068586, 0),
(2, '2222aaa', 222, '2222.00', '2222.00', '1677772800,1681142400', '22.00', 1678072044, 1678072044, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `app_push`
--
ALTER TABLE `app_push`
  ADD PRIMARY KEY (`push_id`) USING BTREE;

--
-- 表的索引 `app_version`
--
ALTER TABLE `app_version`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `latest_version` (`latest_version`) USING BTREE;

--
-- 表的索引 `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`cat_id`) USING BTREE;

--
-- 表的索引 `article_category_body`
--
ALTER TABLE `article_category_body`
  ADD PRIMARY KEY (`cat_id`) USING BTREE;

--
-- 表的索引 `article_category_param`
--
ALTER TABLE `article_category_param`
  ADD PRIMARY KEY (`cat_id`) USING BTREE;

--
-- 表的索引 `article_content`
--
ALTER TABLE `article_content`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `article_indexslide`
--
ALTER TABLE `article_indexslide`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `goods_category`
--
ALTER TABLE `goods_category`
  ADD PRIMARY KEY (`cat_id`) USING BTREE;

--
-- 表的索引 `goods_item`
--
ALTER TABLE `goods_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `price` (`price`),
  ADD KEY `cate_id` (`cat_id`),
  ADD KEY `sort` (`sortrank`);

--
-- 表的索引 `goods_item_count`
--
ALTER TABLE `goods_item_count`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- 表的索引 `goods_item_detail`
--
ALTER TABLE `goods_item_detail`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- 表的索引 `goods_item_point`
--
ALTER TABLE `goods_item_point`
  ADD PRIMARY KEY (`item_id`);

--
-- 表的索引 `goods_item_sku`
--
ALTER TABLE `goods_item_sku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`item_id`);

--
-- 表的索引 `goods_item_spec`
--
ALTER TABLE `goods_item_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_category_id_name_index` (`title`);

--
-- 表的索引 `goods_item_spec_value`
--
ALTER TABLE `goods_item_spec_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_option_name_attr_id_index` (`title`,`spec_id`);

--
-- 表的索引 `goods_item_type`
--
ALTER TABLE `goods_item_type`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_audios`
--
ALTER TABLE `system_audios`
  ADD PRIMARY KEY (`audio_id`) USING BTREE,
  ADD KEY `delete_time` (`delete_time`) USING BTREE;

--
-- 表的索引 `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`varname`) USING BTREE;

--
-- 表的索引 `system_errorlog`
--
ALTER TABLE `system_errorlog`
  ADD PRIMARY KEY (`error_id`) USING BTREE;

--
-- 表的索引 `system_files`
--
ALTER TABLE `system_files`
  ADD PRIMARY KEY (`file_id`) USING BTREE,
  ADD KEY `delete_time` (`delete_time`) USING BTREE;

--
-- 表的索引 `system_images`
--
ALTER TABLE `system_images`
  ADD PRIMARY KEY (`image_id`) USING BTREE,
  ADD KEY `delete_time` (`delete_time`) USING BTREE;

--
-- 表的索引 `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_menu`
--
ALTER TABLE `system_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_payment_tools`
--
ALTER TABLE `system_payment_tools`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_role`
--
ALTER TABLE `system_role`
  ADD PRIMARY KEY (`role_id`) USING BTREE;

--
-- 表的索引 `system_sms`
--
ALTER TABLE `system_sms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_name` (`user_name`) USING BTREE;

--
-- 表的索引 `system_videos`
--
ALTER TABLE `system_videos`
  ADD PRIMARY KEY (`video_id`) USING BTREE,
  ADD KEY `delete_time` (`delete_time`) USING BTREE;

--
-- 表的索引 `test_table`
--
ALTER TABLE `test_table`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `trades_order`
--
ALTER TABLE `trades_order`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- 表的索引 `trades_order_detail`
--
ALTER TABLE `trades_order_detail`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- 表的索引 `trades_order_log`
--
ALTER TABLE `trades_order_log`
  ADD PRIMARY KEY (`log_id`) USING BTREE;

--
-- 表的索引 `trades_order_sku`
--
ALTER TABLE `trades_order_sku`
  ADD PRIMARY KEY (`osku_id`) USING BTREE;

--
-- 表的索引 `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- 表的索引 `user_payment_card`
--
ALTER TABLE `user_payment_card`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user_payment_type`
--
ALTER TABLE `user_payment_type`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `app_push`
--
ALTER TABLE `app_push`
  MODIFY `push_id` int NOT NULL AUTO_INCREMENT COMMENT '推送id';

--
-- 使用表AUTO_INCREMENT `app_version`
--
ALTER TABLE `app_version`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `article_category`
--
ALTER TABLE `article_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT COMMENT '类目id';

--
-- 使用表AUTO_INCREMENT `article_content`
--
ALTER TABLE `article_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT '文档id';

--
-- 使用表AUTO_INCREMENT `article_indexslide`
--
ALTER TABLE `article_indexslide`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `goods_category`
--
ALTER TABLE `goods_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT COMMENT '类目id', AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `goods_item`
--
ALTER TABLE `goods_item`
  MODIFY `item_id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品ID', AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `goods_item_sku`
--
ALTER TABLE `goods_item_sku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '货品id', AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `goods_item_spec`
--
ALTER TABLE `goods_item_spec`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `goods_item_spec_value`
--
ALTER TABLE `goods_item_spec_value`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `goods_item_type`
--
ALTER TABLE `goods_item_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `system_audios`
--
ALTER TABLE `system_audios`
  MODIFY `audio_id` int NOT NULL AUTO_INCREMENT COMMENT '文件id';

--
-- 使用表AUTO_INCREMENT `system_errorlog`
--
ALTER TABLE `system_errorlog`
  MODIFY `error_id` int NOT NULL AUTO_INCREMENT COMMENT '错误id';

--
-- 使用表AUTO_INCREMENT `system_files`
--
ALTER TABLE `system_files`
  MODIFY `file_id` int NOT NULL AUTO_INCREMENT COMMENT '文件id';

--
-- 使用表AUTO_INCREMENT `system_images`
--
ALTER TABLE `system_images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT COMMENT '文件id';

--
-- 使用表AUTO_INCREMENT `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- 使用表AUTO_INCREMENT `system_role`
--
ALTER TABLE `system_role`
  MODIFY `role_id` smallint NOT NULL AUTO_INCREMENT COMMENT '角色id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `system_sms`
--
ALTER TABLE `system_sms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `system_user`
--
ALTER TABLE `system_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT COMMENT '会员id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `system_videos`
--
ALTER TABLE `system_videos`
  MODIFY `video_id` int NOT NULL AUTO_INCREMENT COMMENT '文件id';

--
-- 使用表AUTO_INCREMENT `test_table`
--
ALTER TABLE `test_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `trades_order_log`
--
ALTER TABLE `trades_order_log`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT COMMENT '日志id';

--
-- 使用表AUTO_INCREMENT `trades_order_sku`
--
ALTER TABLE `trades_order_sku`
  MODIFY `osku_id` int NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- 使用表AUTO_INCREMENT `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id', AUTO_INCREMENT=201;

--
-- 使用表AUTO_INCREMENT `user_payment_card`
--
ALTER TABLE `user_payment_card`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `user_payment_type`
--
ALTER TABLE `user_payment_type`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
