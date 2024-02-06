<?php
// +----------------------------------------------------------------------
// | zhanshop-docker-server / IndexEvnet.php    [ 2023/12/4 21:17 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use zhanshop\App;
use zhanshop\console\command\Server;

class WebsocketEvent extends \zhanshop\servevent\WebsocketEvent {

    /**
     * 工作进程启动
     * @param \Swoole\Http\Server $server
     * @param int $workerId
     * @return void
     */
    public function onWorkerStart($server, $workerId) :void{
        parent::onWorkerStart($server, $workerId);
    }
    /**
     * @param Request $request
     * @param Response $response
     * @param int  $protocol
     * @param string $appName
     * @return void
     */
    public function onRequest($request, $response, $protocol = Server::WEBSOCKET, $appName = 'admin') :void{
        parent::onRequest($request, $response, $protocol, $appName);
    }

    /**
     * 首次请求
     * @param \Swoole\WebSocket\Server $server
     * @param Request $request
     * @param int $protocol
     * @param string $appName
     * @return void
     */
    public function onOpen($server, $request, $protocol = Server::WEBSOCKET, $appName = 'admin') :void{
        parent::onOpen($server, $request, $protocol, $appName);
    }

    /**
     * 消息响应
     * @param \Swoole\WebSocket\Server $server
     * @param Frame $frame
     * @param int $protocol
     * @param string $appName
     * @return void
     */
    public function onMessage($server, $frame, $protocol = Server::WEBSOCKET, $appName = 'admin') :void{
        parent::onMessage($server, $frame, $protocol, $appName);
    }

    /**
     * @param \Swoole\WebSocket\Server $server
     * @param int $fd
     * @param int $reactorId
     * @return void
     */
    public function onClose($server, $fd, $reactorId) :void{
    }

    /**
     * 进程正常终止的话标记还没有执行和来得及执行的task
     * @param $server
     * @return void
     */
    public function shutdown($server)
    {
        parent::onShutdown($server);
        App::database()->model("tasks")->whereIn('status',  [0, 1])->update(['status' => -1]);
    }
}