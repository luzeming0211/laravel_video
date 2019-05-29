<?php


namespace App\Http\Controllers\Mobile;


use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Model\Collect_log;
use App\Model\Like_log;
use App\Model\Mail;
use App\Model\Signin;
use App\Model\User_vip;
use App\Model\Video;
use App\Model\Video_comment;
use App\Model\Wechat_user;
use App\Services\ComService;
use App\Services\DesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class PlayController extends Controller
{
    private $userid;
    private $username;

    public function __construct(Request $request)
    {
        if(ComService::is_weixin())
        {
            $user = Wechat_user::get_wechat_user();
            $this->userid = $user['userid'];
            $this->username = $user['username'];
            if(is_null($this->userid) || empty($this->userid)){
                if(Session()->exists('wechat_user')) {
                    redirect('/mobile/bind')->send();die();
                }else{
                    return view('errors.503',['error' =>'您暂未绑定']);
                }
            }
        }else{
            $user = self::get_user();
            $this->userid = $user['userid'];
            $this->username = $user['username'];
            if(empty($this->userid)){
                 redirect('mobile/login')->send();die();
            }
        }

    }

    public function sign(){
        $userid = $this->userid;
        $today_signin = Signin::getUseridIsSigin($userid);
        $signin = Signin::getMonthSignin($userid);
        if(!$today_signin){
            Signin::addUserSigninToday($userid);
            //送积分
            $today_reward_num = ComService::todayReward(count($signin));
            User_vip::addUserScore($userid,$today_reward_num);
            Mail::addMailByUserId($userid ,'签到领取积分'.$today_reward_num.'积分');
            $flag = 1;
        }else{
            $flag = 0;
        }
        $signin = Signin::getMonthSignin($userid);
        return view('mobile.sign',compact('signin','flag'));
    }
    public function collect(Request $request)
    {
       $aVideo = Collect_log::getCollectRecent($this->userid);
       $recent_count = count($aVideo);
       $video = Video::getCollectByVideoId($aVideo);
       $category = Category::getCatName();
        return view('mobile.collect',compact('category','video','recent_count'));
    }
    public function me(Request $request)
    {
        $userid = $this->userid;
        $username = $this->username;
        $user_vip = User_vip::getUserVipByUserId($userid);
        $today = date('Y-m-d H:i:s',time());
        if($user_vip->e_time > $today){
            $vip_msg = '已开通会员到期时间：';
            $e_time = $user_vip->e_time;
            $score = $user_vip->score;
        }else{
            $vip_msg = '您未开通会员';
            $e_time = '';
            $score = $user_vip->score;
        }
        $collect_num = Collect_log::getUseridCollectNum($userid);
        $like_num = Like_log::getUseridLikeNum($userid);
        $category = Category::getCatName();
        return view('mobile.me',compact('category','userid','username','vip_msg','e_time','score','collect_num','like_num','userid','username'));

    }

    public function cat(Request $request){
        $weixin_flag = ComService::is_weixin();
        $userid = $this->userid;
        $username = $this->username;
        $category2 = Category::getCatName();
        $category = Category::getCatNameFour();
        $catid = $request->input('cat');
        $catinfo = Category::getCatNameById($catid);
        $video = Video::getCatVideo($catid);
        return view('mobile.cat', compact('userid','username','video','category','catid','category2','catinfo','weixin_flag'));
    }

    public function show($id)
    {

        $userid = $this->userid;
        $username = $this->username;
        $video = Video::getVideoById($id);
        if (empty($video)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        //是会员视频时去登录
        if($video->is_admin){
            if(empty($userid)){
                redirect('login')->send(); die();
            }else{
                $vipOrNO = User_vip::getVipNowByUserId($userid);
            }
        }else{
            if(!empty($userid)){
                $vipOrNO = User_vip::getVipNowByUserId($userid);
            }else{
                $vipOrNO = '0';
            }
        }
        //视频添加点击量
        Video::addVideoPv($id);
        $video_comment = Video_comment::getComById($id);
        $is_like = Like_log::getUseridIsLike($id, $userid);
        $is_collect = Collect_log::getUseridIsCollect($id, $userid);
        if(empty(Auth::guard('admin')->user()->account_number)){
            if(($video->is_show == 0)||($video->status == 'READY')){
                return view('errors.503',['error' =>'没有该视频的权限']);
            }
        }
        $category = Category::getCatName();
        $category_name = Category::getCatNameById($video->catid);
        return view('mobile.play',compact('vipOrNO','video_comment','video','category','category_name','video','is_like','is_collect','other_video','userid','username'));
    }

}