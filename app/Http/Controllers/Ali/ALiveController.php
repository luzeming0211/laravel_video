<?php

namespace App\Http\Controllers\Ali;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ALiveController extends  Controller
{
    public $aConfig = array();

    public function __construct()
    {
        $this->aConfig = config('aliyun.aliyun');
    }

    public  function  getUrl(Request $request){
        $app_name = $request->input('appName');
        $stream_name = $request->input('streamName');
        $pushUrl = $this->aConfig['push_domain'].'/'.$app_name.'/'.$stream_name;
        $urlParser = parse_url($pushUrl);
        $authKey = self::generateAuthKey($this->aConfig, $urlParser['path']);
        $push_url = sprintf("%s?auth_key=%s", $pushUrl, $authKey);
        $playTypeInfo = [
            'rtmp' => ['rtmp://', ''],
            'flv' => ['https://', '.flv'],
            'm3u8' => ['http://', '.m3u8'],
        ];
        $play_type = 'm3u8';
        $transcode = "";
        $playUrl = sprintf("%s%s/%s/%s%s%s", $playTypeInfo[$play_type][0], $this->aConfig['vhost'], $app_name, $stream_name,
            $transcode, $playTypeInfo[$play_type][1]);
        $url['push_url'] = $push_url;
        $url['play_url'] = $playUrl;
        return json_encode($url);
    }


    protected static function generateAuthKey($config, $uri)
    {
        $validTime = time() + $config['auth_timestamp'];
        $hashString = sprintf("%s-%d-%d-%d-%s", $uri, $validTime, $config['auth_rand'],
            $config['auth_uid'], $config['auth_key']);
        return sprintf("%d-%d-%d-%s", $validTime, $config['auth_rand'], $config['auth_uid'], md5($hashString));
    }
}