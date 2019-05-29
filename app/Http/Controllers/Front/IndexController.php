<?php


namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Model\Ad;
use App\Model\Category;
use App\Model\Collect_log;
use App\Model\Doctor_info;
use App\Model\Like_log;
use App\Model\Live;
use App\Model\Mail;
use App\Model\Pay_log;
use App\Model\Signin;
use App\Model\User_doc;
use App\Model\User_info;
use App\Model\User_vip;
use App\Model\Video;
use App\Services\ComService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use FFMpeg;
class IndexController extends Controller
{
    public function ffm(){
        die();
        $ffmpeg = FFMpeg\FFMpeg::create(array(
            'ffmpeg.binaries'  => '/monchickey/ffmpeg/bin/ffmpeg',
            'ffprobe.binaries' => '/monchickey/ffmpeg/bin/ffprobe',
            'timeout' => 3600,
            'ffmpeg.threads' => 15,
        ));
        $video = $ffmpeg->open('/www/wwwroot/laravel/storage/app/video/1.mp4');
//        $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(6));
//        $frame->save('/www/wwwroot/laravel/storage/app/video/7778.jpg');
        $clip = $video->clip(FFMpeg\Coordinate\TimeCode::fromSeconds(0),
            FFMpeg\Coordinate\TimeCode::fromSeconds(60));
        $clip->save(new FFMpeg\Format\Video\X264('aac','libx264'),
            '/www/wwwroot/laravel/storage/app/video/333.mp4');
    }
    public function index()
    {

        if(ComService::isMobile()){
            return redirect('mobile/index');
        }
        $live = Live::getLiveTwo();
        $video = Video::getShowVideo();
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        $ad_index1 = Ad::getAdByPosition('index1');
        $ad_index2 = Ad::getAdByPosition('index2');
        return view('front.index',compact('video','category','live','user_doc','ad_index1','ad_index2'));
    }
    //支付宝付款完成log
    public function pay_finish(Request $request){
        $input = $request->all();
        Pay_log::addPayLog($input);
        return redirect('/me');
    }
    public function me(){
        $user = self::get_user();
        $userid = $user['userid'];
        $username = $user['username'];
        if(empty($userid)){
            return redirect('login');
        }
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
        $user_doc = User_doc::getUserDoc();
        return view('front.me',compact('user_doc','category','userid','username','vip_msg','e_time','score','collect_num','like_num','userid','username'));
    }
    public function addScore(Request $request){
        $userid = $request->input('userid');
        $score = $request->input('score');
        if($score < 100 ){
            echo json_encode(array('fail'=>true,'error'=>'积分不够'));
            die();
        }
        //查询是否认证
        $user_info = User_info::checkUserid($userid);
        if(empty($user_info)){
            echo json_encode(array('fail'=>true,'error'=>'您未认证，暂时不能兑换积分'));
            die();
        }
        $month = intval($score/100);
        $ret = User_vip::addVipByUserId($userid , $month);
        if($ret){
            echo json_encode(array('success'=>true,'msg'=>'ok'));
            die();
        }
    }
    public function collect()
    {
        $user = self::get_user();
        $userid = $user['userid'];
        if(empty($userid)){
            return redirect('login');
        }
        $aVideo = Collect_log::getCollectRecent($userid);
        $recent_count = count($aVideo);
        $video = Video::getCollectByVideoId($aVideo);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.collect',compact('user_doc','category','video','recent_count'));
    }
    public function getSign()
    {
        $user = self::get_user();
        $userid = $user['userid'];
        if(empty($userid)){
            return redirect('login');
        }
        $today_signin = Signin::getUseridIsSigin($userid);
        $signin = Signin::getMonthSignin($userid);
        if(!$today_signin){
            Signin::addUserSigninToday($userid);
            //送积分
            $today_reward_num = ComService::todayReward(count($signin));
            //查询是否为认证用户
            $user_info = User_info::checkUserid($userid);
            if(!empty($user_info)){
                $today_reward_num = intval($today_reward_num) + 2;
            }
            User_vip::addUserScore($userid,$today_reward_num);
            Mail::addMailByUserId($userid ,'签到领取积分'.$today_reward_num.'积分');
        }
        $signin = Signin::getMonthSignin($userid);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.sign',compact('user_doc','category','signin'));
    }

    public function getSearch(Request $request)
    {
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        $video = Video::getVideoSearch(trim($request->input('search')));
        return view('front.search' ,compact('user_doc','video','category'));
    }

    public function getAuth()
    {
        $user = self::get_user();
        $username = $user['username'];
        $userid = $user['userid'];
        if(empty($userid)){
            return view('errors.503', ['error' => '用户未登录']);
        }
        $user_info = User_info::getApplyInfoByUserid($userid);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.auth' ,compact('user_doc','category','user_info','userid','username'));
    }
    public function postAuthDo(Request $request)
    {
        $data = $request->except(['_token']);
        $oValidate = User_info::UserInfoValidate($data);
        if ($oValidate->fails()) {
            return view('errors.503',['error' =>$oValidate->messages()->first()]);
        }

        $doctor_info = Doctor_info::checkDoctorInfo($data['name'] , $data['doc_card_id']);
        $status = (empty($doctor_info)) ?  'REJECT' : 'ACCESS';
        if (!ComService::is_idcard($request->input('idcard'))){
            $status = 'READY';
        }
        $ret = User_info::addApplyInfo($data ,$status);
        if($ret > 0){
            return redirect('auth');
        }
    }
    public  function getMail(){
        $user = self::get_user();
        $userid = $user['userid'];
        $mail = Mail::getMailByUserid($userid);
        $video = Video::getShowVideo();
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.mail',compact('user_doc','category','video','mail','userid'));
    }
    public function postMailDel(Request $request){
        $userid = $request->input('userid');
        $id = $request->input('id');
        if(empty($userid) || empty($id)){
            $json = array('fail'=>true,'msg'=> 'id或用户id为空');
            echo json_encode($json);
            die;
        }else{
            $ret=DB::table("mail")->where('id',$id)->update([
                'is_del'=> 'Y',
            ]);
            if($ret > 0){
                $json = array('success'=>true,'msg'=> 'OK');
                echo json_encode($json);
                die;
            }
        }
    }
    public function postMailIsRead(Request $request){
        $userid= $request->input('userid');
        $id = $request->input('id');
        if(empty($userid) || empty($id)){
            $json = array('fail'=>true,'msg'=> 'id或用户id为空');
            echo json_encode($json);
            die;
        }else{
            $ret=DB::table("mail")->where('id',$id)->update([
                'is_read'=> 'Y',
            ]);
            if($ret > 0){
                $json = array('success'=>true,'msg'=> 'OK');
                echo json_encode($json);
                die;
            }
        }
    }
    public function postMailNoRead(Request $request){
        $userid = $request->input('userid');
        $id = $request->input('id');
        if(empty($userid) || empty($id)){
            $json = array('fail'=>true,'msg'=> 'id或用户id为空');
            echo json_encode($json);
            die;
        }else{
            $ret=DB::table("mail")->where('id',$id)->update([
                'is_read'=> 'N',
            ]);
            if($ret > 0){
                $json = array('success'=>true,'msg'=> 'OK');
                echo json_encode($json);
                die;
            }
        }
    }
}