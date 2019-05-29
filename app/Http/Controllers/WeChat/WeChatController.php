<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\IndexController;
use App\Model\Login_log;
use App\Model\Signin;
use App\Model\User_vip;
use App\Model\Wechat_user;
use App\Services\ComService;
use BssOpenApi\Request\V20171214\SetEnduserStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class WeChatController extends Controller

{
    public $oWechat;
    public $oServer;
//    public function checkSignature()
//    {
//        $signature = $_GET["signature"];
//        $timestamp = $_GET["timestamp"];
//        $nonce = $_GET["nonce"];
//        $token = 'Lu903101767';
//        $tmpArr = array($token, $timestamp, $nonce);
//        sort($tmpArr, SORT_STRING);
//        $tmpStr = implode($tmpArr);
//        $tmpStr = sha1($tmpStr);
//        if ($tmpStr == $signature) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//    public  function get_access(Request $request){
//        $data = $request->all();
//        Log::info($data);
//        $echoStr = $_GET["echostr"];
//        if (self::checkSignature()) {
//            echo $echoStr;
//            exit;
//        }
//    }
    public function oauth_callback(Request $request){
        $app = app('wechat.official_account');

        if (!$request->session()->exists('wechat_user')) {
            $user = $app->oauth->user();
            $openid = $user->id;
            $wechat_user_info = Wechat_user::getWechatUser($openid);
            if(empty($wechat_user_info)){
                Wechat_user::addDefaultWeChatUser($openid);
            }
            $request->session()->put('wechat_user', $user);
            $target_url = Session::get('target_url');
            if(empty($target_url)){
                $target_url = '/';
            }
            return redirect($target_url);
        }
    }
    public function serve()
    {
        $app = app('wechat.official_account');
        $buttons = [
            [
                "name" => "签到",
                "type" => "view",
                "url"  => "http://boser1u.top/mobile/sign"
            ],
            [
                "name" => "快看快学",
                "type" => "view",
                "url"  => "http://boser1u.top/mobile/short"
            ],
            [
                "name" => "观看视频",
                "type" => "view",
                "url"  => "http://boser1u.top/mobile/index"
            ],
        ];

        $app->menu->create($buttons);
        $app->server->push(function ($oMessage) {
//            Log::info($oMessage);
            switch ($oMessage['MsgType']) {
                case 'event':
                    if ($oMessage['Event'] == 'subscribe'){
                        return '【HYDROGEN】感谢关注';
                    }
                    if($oMessage['Event'] == 'SCAN'){
                        $user_openid = $oMessage['FromUserName'];
                        $ticket = $oMessage['Ticket'];
                        $wechat_user_info = Wechat_user::getBindWechatUser($user_openid);
                        if(empty($wechat_user_info)){
                            Wechat_user::addDefaultWeChatUser($user_openid);
                            return"您暂未绑定<a href='http://boser1u.top/mobile/bind'>点我去绑定</a>";
                        }else{
                            $userid = $wechat_user_info->userid;
                            $username = $wechat_user_info->nickname;
                            Login_log::editLoginLog($ticket, $user_openid, $userid, $username);
                            return '【HYDROGEN】网页登录成功'.date('Y-m-d H:i:s');
                        }
                    }
                    break;
                case 'text':
                    if ($oMessage['Content'] == '客服'){
                        return '客服系统正在升级';
                    }else{
                        return '文本消息';
                    }
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                default:
                    return '收到其它消息';
                    break;
            }
        });
        return $app->server->serve();
    }
}
