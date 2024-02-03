<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace zhanshop\route;

use zhanshop\App;
use zhanshop\Error;
use zhanshop\Request;
use zhanshop\Response;

/**
 * 路由调度基础类
 */
class Dispatch
{
    protected $app;
    protected $version;

    // 已注册的路由
    protected $routes = [];

    public function regRoute(Rule &$rule){
        $rule->middleware = array_reverse(array_merge($rule->middleware, App::config()->get('middleware.'.$this->app, [])));
        $middlewares = [];
        foreach($rule->middleware as $middleware){
            $middlewares[] = function (Request &$request, \Closure &$next) use ($middleware){
                return App::make($middleware)->handle($request, $next);
            };
        }
        $rule->middleware = $middlewares;

        $this->routes[$this->app][$this->version][$rule->uri][$rule->method] = [
            'cache' => $rule->cache,
            'extra' => $rule->extra,
            'handler' => $rule->handler,
            'middleware' => $rule->middleware
        ];
    }

    public function setApp(string $app){
        $this->app = $app;
    }

    public function setVersion(string $version){
        $this->version = $version;
    }

    /**
     * 路由检查
     * @return void
     */
    public function check(string &$name, Request &$request){
        // 检查路由是否存在
        $params = explode("/", $request->server('request_uri'));
        $version = $params[1] ? $params[1] : 'v1';
        $uri     = isset($params[2]) ? '/'.$params[2] : '/index.index';
        $method = $request->server('request_method', 'GET');
        $route = $this->routes[$name][$version][$uri][$method] ?? App::error()->setError('您所访问的资源不存在', Error::NOT_FOUND);

        foreach ($route['extra'] as $k => $v){
            $request->setData($v, $params[$k + 3] ?? null);
        }

        $request->setRoure($route); // 设置当前路由

    }

    /**
     * 执行路由调度
     * @param string $name
     * @param Request $request
     * @param Response $servResponse
     * @return mixed
     */
    public function run(string &$name, Request &$request, Response &$servResponse){
        $roure = $request->getRoure();
        $action = $roure['handler'][1];
        $controller = $roure['handler'][0];
        // 在台式机上测试性能strtolower
        return App::make($controller)->$action($request, $servResponse);
    }

    public function routes(){
        return $this->routes;
    }

    protected $grpcs = [];

    /**
     * 挂载grpc路由
     * @param string $uri
     * @param array $handler
     * @param array $param
     * @return void
     */
    public function regGrpc(string $uri, array $handler, array $param){
        $this->grpcs[$uri] = [
            'handler' => $handler,
            'param' => $param
        ];
    }

    /**
     * 获取grpc路由
     * @param string $uri
     * @return mixed
     * @throws \Exception
     */
    public function getGrpc(string $uri){
        return $this->grpcs[$uri] ?? App::error()->setError('您所访问的grpc服务不存在', Error::NOT_FOUND);
    }

    protected $jsonRpcs = [];

    /**
     * 挂载jsonRpc路由
     * @param string $uri
     * @param array $handler
     * @param array $param
     * @return void
     */
    public function regJsonRpc(string $uri, array $handler, array $param){
        $this->jsonRpcs[$uri] = [
            'handler' => $handler,
            'param' => $param
        ];
    }

    /**
     * 获取jsonRpc路由
     * @param string $uri
     * @return mixed
     * @throws \Exception
     */
    public function getJsonRpc(string $uri){
        return $this->jsonRpcs[$uri] ?? App::error()->setError('您所访问的JsonRpc服务不存在', Error::NOT_FOUND);
    }
}
