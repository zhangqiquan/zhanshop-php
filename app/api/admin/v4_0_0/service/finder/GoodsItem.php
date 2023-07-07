<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / goods_item.php    [ 2023/3/2 15:21 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class GoodsItem extends BaseFinder
{
    protected $size = 'lg';
    protected $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '添加',
            'method' => '',
            'page' => './goods/add.html',
        ],
        [
            'event' => 'deletes',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    protected $rowToolbar = [
        [
            'event' => 'edit',
            'ico' => '&#xe642;',
            'title' => '编辑',
            'method' => '',
            'page' => './goods/edit.html',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    protected $tabs = [
        [
            'title' => '全部',
            'where' => [],
        ],
        [
            'title' => '出售中',
            'where' => [
                ['goods_status', '=', '1']
            ],
        ],
        [
            'title' => '已下架',
            'where' => [
                ['goods_status', '=', '0']
            ],
        ]
    ];

    public function posttable(Request &$request, Response &$response)
    {
        $post = $request->post();
        App::database()->transaction(function ($pdo) use ($post){

            $time = time();
            $post['goods_item']['create_time'] = $time;
            $post['goods_item']['update_time'] = $time;

            //spec_data
            if($post['goods_item']['is_attribute']){

                $minPrice = min(array_column($post['goods_item_skus'], 'price'));
                $minMarketPrice = min(array_column($post['goods_item_skus'], 'market_price'));
                $minCostPrice = min(array_column($post['goods_item_skus'], 'cost_price'));
                $post['goods_item']['price'] = $minPrice;
                $post['goods_item']['market_price'] = $minMarketPrice;
                $post['goods_item']['cost_price'] = $minCostPrice;

                $specValIdsStrs = array_keys($post['goods_item_skus']);
                $specValIds = [];
                foreach($specValIdsStrs as $v){
                    $specValIds = array_merge($specValIds, explode('-', $v));
                }
                $specValIds = array_unique($specValIds); // 去重
                if($specValIds == false) App::error()->setError('商品规格不能为空', 403);
                $specValues = App::database()->model("goods_item_spec_value")->whereIn('id', $specValIds)->order('sortrank asc')->order('id desc')->column('id,spec_id,title', 'id', $pdo);
                $specIds = array_column($specValues, 'spec_id');
                $itemSpec = App::database()->model("goods_item_spec")->whereIn('id', $specIds)->order('sortrank asc')->order('id asc')->column('title,show_type', 'id', $pdo);
                foreach($itemSpec as $k => $v){
                    $itemSpec[$k]['value'] = [];
                    foreach($specValues as $kk => $vv){
                        if($vv['spec_id'] == $v['id']){
                            $itemSpec[$k]['value'][] = $vv;
                            unset($specValues[$kk]);
                        }
                    }
                    if($itemSpec[$k]['value'] == false) App::error()->setError('商品规格有错', 403);
                }
                $post['goods_item']['spec_data'] = json_encode($itemSpec, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);

                $itemId = App::database()->model("goods_item")->insertGetId($post['goods_item'], $pdo);

                $saveSkuAll = [];
                foreach($post['goods_item_skus'] as $k => $v){
                    $v['item_id'] = $itemId;
                    $v['spec'] = $k;
                    $saveSkuAll[] = $v;
                }
                App::database()->model("goods_item_sku")->insertAll($saveSkuAll, false, $pdo);

            }else{
                $post['goods_item']['price'] = $post['goods_item_sku']['price'];
                $post['goods_item']['market_price'] = $post['goods_item_sku']['market_price'];
                $post['goods_item']['cost_price'] = $post['goods_item_sku']['cost_price'];

                $itemId = App::database()->model("goods_item")->insertGetId($post['goods_item'], $pdo);

                $post['goods_item_sku']['item_id'] = $itemId;
                App::database()->model("goods_item_sku")->insert($post['goods_item_sku'], $pdo);
            }
            $post['goods_item_detail']['item_id'] = $itemId;
            App::database()->model("goods_item_detail")->insert($post['goods_item_detail'], $pdo);

            $post['goods_item_point']['item_id'] = $itemId;
            App::database()->model("goods_item_point")->insert($post['goods_item_point'], $pdo);

            App::database()->model("goods_item_count")->insert([
                'item_id' => $itemId
            ], $pdo);

        });

        return [];
    }


    public function puttable(Request &$request, Response &$response)
    {
        $input = App::validate()->check($request->get(), [
            'pk' => 'Required',
        ]);

        $post = $request->post();
        $oldAttribute = App::database()->model("goods_item")->where(['item_id' => $input['pk']])->field('is_attribute')->find();
        if($oldAttribute == false) App::error()->setError('item_id='.$input['pk'].'的商品不存在', 404);
        $oldAttribute = $oldAttribute['is_attribute'];
        // 查询当前sku
        $itemSku = App::database()->model("goods_item_sku")->where(['item_id' => $input['pk']])->column('id', 'spec');
        // 如果原先是单规格现在升级多规格

        App::database()->transaction(function ($pdo) use ($post, $input, $itemSku, $oldAttribute){

            $time = time();
            $post['goods_item']['update_time'] = $time;

            //spec_data
            if($post['goods_item']['is_attribute']){
                $minPrice = min(array_column($post['goods_item_skus'], 'price'));
                $minMarketPrice = min(array_column($post['goods_item_skus'], 'market_price'));
                $minCostPrice = min(array_column($post['goods_item_skus'], 'cost_price'));
                $post['goods_item']['price'] = $minPrice;
                $post['goods_item']['market_price'] = $minMarketPrice;
                $post['goods_item']['cost_price'] = $minCostPrice;


                $specValIdsStrs = array_keys($post['goods_item_skus']);
                $specValIds = [];
                foreach($specValIdsStrs as $v){
                    $specValIds = array_merge($specValIds, explode('-', $v));
                }
                $specValIds = array_unique($specValIds); // 去重
                if($specValIds == false) App::error()->setError('商品规格不能为空', 403);
                $specValues = App::database()->model("goods_item_spec_value")->whereIn('id', $specValIds)->order('sortrank asc')->order('id desc')->column('id,spec_id,title', 'id', $pdo);
                $specIds = array_column($specValues, 'spec_id');
                $itemSpec = App::database()->model("goods_item_spec")->whereIn('id', $specIds)->order('sortrank asc')->order('id asc')->column('title,show_type', 'id');
                foreach($itemSpec as $k => $v){
                    $itemSpec[$k]['value'] = [];
                    foreach($specValues as $kk => $vv){
                        if($vv['spec_id'] == $v['id']){
                            $itemSpec[$k]['value'][] = $vv;
                            unset($specValues[$kk]);
                        }
                    }
                    if($itemSpec[$k]['value'] == false) App::error()->setError('商品规格有错', 403);
                }
                $post['goods_item']['spec_data'] = json_encode($itemSpec, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);

                App::database()->model("goods_item")->where(['item_id' => $input['pk']])->update($post['goods_item'], $pdo);

                $saveSkuAll = [];
                foreach($post['goods_item_skus'] as $k => $v){
                    $v['item_id'] = $input['pk'];
                    $v['spec'] = $k;

                    if(isset($itemSku[$k])){
                        // 更新
                        App::database()->model("goods_item_sku")->where(['id' => $itemSku[$k], 'item_id' => $input['pk']])->update($v, $pdo);
                        unset($itemSku[$k]);
                    }else if($oldAttribute == 0 && $itemSku){ // 原先是单规格
                        $kyes = array_keys($itemSku);
                        if(isset($kyes[0])){
                            $itemSkuKey = $kyes[0];
                            App::database()->model("goods_item_sku")->where(['id' => $itemSku[$itemSkuKey], 'item_id' => $input['pk']])->update($v, $pdo);
                            unset($itemSku[$itemSkuKey]);
                        }
                        $oldAttribute = 1;
                    }else{
                        $saveSkuAll[] = $v;
                    }
                }
                if($saveSkuAll){
                    App::database()->model("goods_item_sku")->insertAll($saveSkuAll, false, $pdo);
                }
                // 删除多余
                if($itemSku){
                    App::database()->model("goods_item_sku")->where(['item_id' => $input['pk']])->whereIn('id', $itemSku)->delete($pdo);
                }

            }else{
                $post['goods_item']['price'] = $post['goods_item_sku']['price'];
                $post['goods_item']['market_price'] = $post['goods_item_sku']['market_price'];
                $post['goods_item']['cost_price'] = $post['goods_item_sku']['cost_price'];
                // 单规格
                App::database()->model("goods_item")->where(['item_id' => $input['pk']])->update($post['goods_item'], $pdo);


                foreach($itemSku as $k => $v){
                    $post['goods_item_sku']['item_id'] = $input['pk'];
                    $post['goods_item_sku']['id'] = $v;
                    $post['goods_item_sku']['spec'] = '';
                    App::database()->model("goods_item_sku")->where(['id' => $v, 'item_id' => $input['pk']])->update($post['goods_item_sku'], $pdo);
                    unset($itemSku[$k]);
                    break;
                }
                if($itemSku){
                    App::database()->model("goods_item_sku")->where(['item_id' => $input['pk']])->whereIn('id', $itemSku)->delete($pdo);
                }
            }
            $post['goods_item_detail']['item_id'] = $input['pk'];
            App::database()->model("goods_item_detail")->where(['item_id' => $input['pk']])->update($post['goods_item_detail'], $pdo);

            $post['goods_item_point']['item_id'] = $input['pk'];
            App::database()->model("goods_item_point")->where(['item_id' => $input['pk']])->update($post['goods_item_point'], $pdo);

        });
        return $this->data(1, 1, [[$this->menuData['pk'], '=', $input['pk']]]);
    }

    /**
     * 创建规格的值
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function specvalcreatetable(Request &$request, Response &$response){
        $data = $request->post();
        if(App::database()->model("goods_item_spec")->where(['id' => $data['spec_id']])->find()){
            if(App::database()->model("goods_item_spec_value")->where(['spec_id' => $data['spec_id'], 'title' => $data['title']])->find()){
                App::error()->setError($data['title'].'已存在', 403);
            }
            return [
                'id' => App::database()->model("goods_item_spec_value")->insertGetId($data)
            ];
        }else{
            App::error()->setError('没有规格id:'.$data['spec_id'].'的数据', 403);
        }
        return [];
    }

    /**
     * 删除规格的值
     * @param Request $request
     * @return array
     */
    public function specvaldeletetable(Request &$request, Response &$response){
        // 后面做如果被使用是禁止删除的
        $input = App::validate()->check($request->post(), [
            'id' => 'Required',
        ]);
        App::database()->model("goods_item_spec_value")->where(['id' => $input['id']])->delete();
        return [];
    }

    /**
     * 创建规格
     * @param Request $request
     * @return array
     */
    public function speccreatetable(Request &$request, Response &$response){
        $input = App::validate()->check($request->post(), [
            'type_id' => 'Required',
            'title' => 'Required',
        ]);
        $itemType = App::database()->model("goods_item_type")->where(['id' => $input['type_id']])->find();
        $id = 0;
        if($itemType){
            // 事务
            App::database()->transaction(function($pdo) use ($itemType, $input, $id){
                $id = App::database()->model("goods_item_spec")->insertGetId(['title' => $input['title']], $pdo);
                $specIds = $itemType['spec_ids'] ? $itemType['spec_ids'].','.$id  : $id;
                App::database()->model("goods_item_type")->where(['id' => $input['type_id']])->update(['spec_ids' => $specIds], $pdo);
            });
            // 更新商品类型表
            return ['id' => $id];
        }
        App::error()->setError('商品类型:'.$input['type_id'].'不存在', 404);
        return [];
    }

    public function specdeletetable(Request &$request, Response &$response){
        $input = App::validate()->check($request->post(), [
            'type_id' => 'Required',
            'id' => 'Required',
        ]);
        $itemType = App::database()->model("goods_item_type")->where(['id' => $input['type_id']])->find();
        if($itemType){
            $specIds = explode(',', $itemType['spec_ids']);
            if(!in_array($input['id'], $specIds)) App::error()->setError($input['id'].'不是商品类型'.$input['type_id'].'的规格', 403);
            $key = array_search($input['id'], $specIds);
            unset($specIds[$key]);
            App::database()->transaction(function($pdo) use ($itemType, $input, $specIds){
                App::database()->model("goods_item_spec")->where(['id' => $input['id']])->delete($pdo);

                App::database()->model("goods_item_type")->where(['id' => $input['type_id']])->update([
                    'spec_ids' => implode(',', $specIds),
                ], $pdo);
            });
            return [];
        }
        App::error()->setError('商品类型:'.$input['type_id'].'不存在', 404);
    }


    /**
     * 获取所有商品类型
     * @param Request $request
     * @return mixed
     */
    public function itemtypetable(Request &$request, Response &$response){
        return App::database()->model("goods_item_type")->limit(3000)->select();
    }

    /**
     * 根据商品类型id获取属性和规格
     * @param Request $request
     * @return array
     */
    public function attrspectable(Request &$request, Response &$response){
        $input = App::validate()->check($request->post(), [
            'type_id' => 'Required',
        ]);

        $pk = $request->get('pk');
        $specData = [];
        if($pk){
            // 把所有的sku查询出来
            $item = App::database()->model("goods_item")->where(['item_id' => $pk])->field('is_attribute,spec_data')->find();
            if($item == false) App::error()->setError('item_id='.$pk.'没有相关商品', 404);
            if($item['is_attribute'] && $item['spec_data']){
                $specData = json_decode($item['spec_data'], true);
                if(!$specData) $specData = [];
            }
        }
        $specIds = App::database()->model("goods_item_type")->where(['id' => $input['type_id']])->value('spec_ids');
        if($specIds == false) App::error()->setError('产品属性和规格为空,请先在管理菜单中添加后再选择', 404);
        $specIds = json_decode($specIds, true);
        $specs = App::database()->model("goods_item_spec")->whereIn('id', $specIds)->field('id,title')->select();
        if($specs == false) App::error()->setError('产品属性和规格没有找到', 404);

        foreach ($specs as $k => $v){
            $specs[$k]['value'] = [];
            if(isset($specData[$v['id']]['value'])){
                $specs[$k]['value'] = array_column($specData[$v['id']]['value'], 'id');
            }
            $specs[$k]['options'] = App::database()->model("goods_item_spec_value")->field('id,title')->where(['spec_id' => $v['id']])->limit(2000)->select();
        }
        return [
            'attribute' => [],
            'spec' => $specs,
        ];
    }

    /**
     * 获取某个商品id下的sku
     * @param Request $request
     * @return array
     */
    public function skutable(Request &$request, Response &$response){
        $itemId = $request->get('pk');
        if($itemId){
            $data = App::database()->model("goods_item_sku")->where(['item_id' => $itemId])->select();
            $ret = [];

            foreach($data as $v){
                $ret['goods_item_skus['.$v['spec'].'][picture]'] = $v['picture'];
                $ret['goods_item_skus['.$v['spec'].'][price]'] = $v['price'];
                $ret['goods_item_skus['.$v['spec'].'][market_price]'] = $v['market_price'];
                $ret['goods_item_skus['.$v['spec'].'][cost_price]'] = $v['cost_price'];
                $ret['goods_item_skus['.$v['spec'].'][stock]'] = $v['stock'];
                $ret['goods_item_skus['.$v['spec'].'][status]'] = $v['status'];
            }
            return $ret;
        }
        return [];
    }
}