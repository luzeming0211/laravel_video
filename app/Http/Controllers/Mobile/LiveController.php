<?php

namespace App\Http\Controllers\Mobile;


use App\Http\Controllers\Controller;
use App\Model\Live;
use App\Model\Wechat_user;
use App\Services\ComService;

class LiveController extends Controller
{
    private $userid;
    private $username;

    public function __construct()
    {
        if(ComService::is_weixin())
        {
            $user = Wechat_user::get_wechat_user();
            $this->userid = $user['userid'];
            $this->username = $user['username'];
            if(empty($this->userid)){
                if(Session()->exists('wechat_user')) {
                    redirect('/mobile/bind')->send();
                }else{
                    return view('errors.503',['error' =>'您暂未绑定']);
                }
            }
        }else{
            $user = self::get_user();
            $this->userid = $user['userid'];
            $this->username = $user['username'];
            if(empty($this->userid)){
                redirect('mobile/login')->send();
            }
        }
    }

    public function getLive(){
        $live = Live::getLive();
        return view('mobile.live',compact('live'));
    }

    public function getLiveId($live_id){
        if(!ComService::isMobile()){
            return redirect('mobile/live/'.$live_id);
        }
//        if(!ComService::is_weixin()){
//            return view('errors.wechat',['error' =>'请在pc网站或微信公众号内观看直播']);
//        }
        $live = Live::getLiveById($live_id);
        if (empty($live)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        if (($live->start_time)>date('Y-m-d H:i:s')){
            return view('errors.503',['error' =>'还未到播放时间']);
        }
        if (($live->end_time)<date('Y-m-d H:i:s')){
            return view('errors.503',['error' =>'该直播已结束']);
        }
        //视频添加点击量
        Live::addLivePv($live_id);
        $userid = $this->userid;
        $username = $this->username;
        $user_agent = ComService::user_agent();
        return view('mobile.live_play',compact('user_agent','live','userid','live_id','username'));
    }

}