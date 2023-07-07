<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Ueditor.php    [ 2023/6/11 下午9:14 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\plugin;

use app\api\v4_0_0\service\plugin\BaiduUEditor\ActionCrawler;
use app\api\v4_0_0\service\plugin\BaiduUEditor\ActionList;
use zhanshop\App;

class Ueditor
{
    protected $config = array (
        'imageActionName' => 'uploadimage',
        'imageFieldName' => 'file',
        'imageMaxSize' => 2048000,
        'imageAllowFiles' =>
            array (
                0 => '.png',
                1 => '.jpg',
                2 => '.jpeg',
                3 => '.gif',
                4 => '.bmp',
            ),
        'imageCompressEnable' => true,
        'imageCompressBorder' => 1200,
        'imageInsertAlign' => 'none',
        'imageUrlPrefix' => '',
        'imagePathFormat' => '',
        'scrawlActionName' => 'uploadscrawl',
        'scrawlFieldName' => 'file',
        'scrawlPathFormat' => '',
        'scrawlMaxSize' => 2048000,
        'scrawlUrlPrefix' => '',
        'scrawlInsertAlign' => 'none',
        'snapscreenActionName' => 'uploadimage',
        'snapscreenPathFormat' => '',
        'snapscreenUrlPrefix' => '',
        'snapscreenInsertAlign' => 'none',
        'catcherLocalDomain' =>
            array (
                0 => '127.0.0.1',
                1 => 'localhost',
                2 => 'img.baidu.com',
            ),
        'catcherActionName' => 'catchimage',
        'catcherFieldName' => 'source',
        'catcherPathFormat' => '',
        'catcherUrlPrefix' => '',
        'catcherMaxSize' => 2048000,
        'catcherAllowFiles' =>
            array (
                0 => '.png',
                1 => '.jpg',
                2 => '.jpeg',
                3 => '.gif',
                4 => '.bmp',
            ),
        'videoActionName' => 'uploadvideo',
        'videoFieldName' => 'file',
        'videoPathFormat' => '',
        'videoUrlPrefix' => '',
        'videoMaxSize' => 102400000,
        'videoAllowFiles' =>
            array (
                0 => '.flv',
                1 => '.m4a',
                2 => '.swf',
                3 => '.mkv',
                4 => '.avi',
                5 => '.rm',
                6 => '.rmvb',
                7 => '.mpeg',
                8 => '.mpg',
                9 => '.ogg',
                10 => '.ogv',
                11 => '.mov',
                12 => '.wmv',
                13 => '.mp4',
                14 => '.webm',
                15 => '.mp3',
                16 => '.wav',
                17 => '.mid',
            ),
        'audioActionName' => 'uploadaudio',
        'audioFieldName' => 'file',
        'audioPathFormat' => '',
        'audioUrlPrefix' => '',
        'audioMaxSize' => 102400000,
        'audioAllowFiles' =>
            array (
                0 => '.mp3',
                1 => '.wma',
                2 => '.ape',
                3 => '.flac',
                4 => '.dts',
                5 => '.m4a',
                6 => '.aac',
                7 => '.ac3',
                8 => '.mmf',
                9 => '.amr',
                10 => '.m4r',
                11 => '.ogg',
                12 => '.wav',
                13 => '.wv',
                14 => '.mp2',
            ),
        'fileActionName' => 'uploadfile',
        'fileFieldName' => 'file',
        'filePathFormat' => '',
        'fileUrlPrefix' => '',
        'fileMaxSize' => 51200000,
        'fileAllowFiles' =>
            array (
                0 => '.png',
                1 => '.jpg',
                2 => '.jpeg',
                3 => '.gif',
                4 => '.bmp',
                5 => '.apk',
                6 => '.m4a',
                7 => '.flv',
                8 => '.swf',
                9 => '.mkv',
                10 => '.avi',
                11 => '.rm',
                12 => '.rmvb',
                13 => '.mpeg',
                14 => '.mpg',
                15 => '.ogg',
                16 => '.ogv',
                17 => '.mov',
                18 => '.wmv',
                19 => '.mp4',
                20 => '.webm',
                21 => '.mp3',
                22 => '.wav',
                23 => '.mid',
                24 => '.rar',
                25 => '.zip',
                26 => '.tar',
                27 => '.gz',
                28 => '.7z',
                29 => '.bz2',
                30 => '.cab',
                31 => '.iso',
                32 => '.doc',
                33 => '.docx',
                34 => '.xls',
                35 => '.xlsx',
                36 => '.ppt',
                37 => '.pptx',
                38 => '.pdf',
                39 => '.txt',
                40 => '.md',
                41 => '.xml',
                42 => '.otf',
            ),
        'imageManagerActionName' => 'listimage',
        'imageManagerListPath' => '',
        'imageManagerListSize' => 20,
        'imageManagerUrlPrefix' => '',
        'imageManagerInsertAlign' => 'none',
        'imageManagerAllowFiles' =>
            array (
                0 => '.png',
                1 => '.jpg',
                2 => '.jpeg',
                3 => '.gif',
                4 => '.bmp',
            ),
        'fileManagerActionName' => 'listfile',
        'fileManagerListPath' => '',
        'fileManagerUrlPrefix' => '',
        'fileManagerListSize' => 20,
        'fileManagerAllowFiles' =>
            array (
                0 => '.png',
                1 => '.jpg',
                2 => '.jpeg',
                3 => '.gif',
                4 => '.apk',
                5 => '.bmp',
                6 => '.flv',
                7 => '.swf',
                8 => '.mkv',
                9 => '.avi',
                10 => '.rm',
                11 => '.rmvb',
                12 => '.mpeg',
                13 => '.mpg',
                14 => '.ogg',
                15 => '.ogv',
                16 => '.mov',
                17 => '.wmv',
                18 => '.mp4',
                19 => '.webm',
                20 => '.mp3',
                21 => '.wav',
                22 => '.mid',
                23 => '.rar',
                24 => '.zip',
                25 => '.tar',
                26 => '.gz',
                27 => '.7z',
                28 => '.bz2',
                29 => '.cab',
                30 => '.iso',
                31 => '.doc',
                32 => '.docx',
                33 => '.xls',
                34 => '.xlsx',
                35 => '.ppt',
                36 => '.pptx',
                37 => '.pdf',
                38 => '.txt',
                39 => '.md',
                40 => '.xml',
            ),
    );
    public function data(array $input){
        $action = $input['action'] ?? 'config';

        switch ($action) {
            case 'config':
                $result = json_encode($this->config, JSON_UNESCAPED_UNICODE);
                break;
            /* 列出图片 */
            case 'listimage':
                $result = ActionList::call($this->config);
                break;
            /* 列出文件 */
            case 'listfile':
                $result = ActionList::call($this->config);
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = ActionCrawler::call($this->config);
                break;

            default:
                $result = json_encode(array(
                    'state' => '没有action相关的参数'
                ));
                break;
        }
        return $result;
    }
}