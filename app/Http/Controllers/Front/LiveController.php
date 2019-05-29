<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Live;
use App\Model\User_doc;
use App\Model\Video;
use App\Services\ComService;
use App\Services\DesService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveController extends  Controller
{

    //全部直播
    public function getLive()
    {
        //正在直播
        $live = Live::getLiveIng();
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.live',compact('user_doc','live','category'));
    }

    //直播详细
    public function getLiveId($live_id)
    {
        $user = self::get_user();
        $userid = $user['userid'];
        $username = $user['username'];
        if(empty($userid)){
            return redirect('login');
        }
        $live = DB::table('live')->where('id', $live_id)->first();
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
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        $user_agent = ComService::user_agent();
        return view('front.live_play',compact('user_agent','user_doc','live','category','userid','live_id','username'));
    }

}