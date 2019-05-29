<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Model\Ad;
use App\Model\Black_user;
use App\Model\Category;
use App\Model\Collect_log;
use App\Model\Com_sens;
use App\Model\Danmu_sens;
use App\Model\Like_log;
use App\Model\User_doc;
use App\Model\User_vip;
use App\Model\Video;
use App\Model\Video_comment;
use App\Model\Video_time;
use App\Model\Wechat_user;
use App\Services\ComService;
use App\Services\DesService;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PlayController extends Controller
{
    public function show($id)
    {
        if(ComService::isMobile()){
            return redirect('mobile/video/'.$id);
        }
        $user = self::get_user();
        $userid = $user['userid'];
        $username = $user['username'];
        $video = Video::getVideoById($id);
        if (empty($video)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        if(empty($userid)){
            return  redirect('login');
        }
//        $video->video = DesService::des_ecb_encrypt($video->video,'ckplayerDesKey');
        //是会员视频时去登录
        if($video->is_admin){
            if(empty($userid)){
                return  redirect('login');
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
        $catid = $video->catid;
        $other_video = Video::getVideoAbout($catid , $id);
        $video_comment = Video_comment::getComById($id);
        if(!empty($userid)){
            $is_like = Like_log::getUseridIsLike($id, $userid);
            $is_collect = Collect_log::getUseridIsCollect($id, $userid);
        }
        if(empty(Auth::guard('admin')->user()->account_number)){
            if(($video->is_show == 0)||($video->status == 'READY')){
                return view('errors.503',['error' =>'没有该视频的权限']);
            }
        }
        $video_time = Video_time::getVideoTimeByUserid($userid ,$id);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        $category_name = Category::getCatNameById($catid);
        $ad_pause = Ad::getAdByPosition('pause');
        $ad_preview = Ad::getAdByPosition('preview');
        return view('front.play',compact('ad_pause','ad_preview','video_time','user_doc','vipOrNO','video_comment','video','category','category_name','video','is_like','is_collect','other_video','userid','username'));
    }
    public function intercept(Request $request,$id){
        if(ComService::is_weixin())
        {
            $user = Wechat_user::get_wechat_user();
            $userid = $user['userid'];
        }else{
            $user = self::get_user();
            $userid = $user['userid'];
        }
        $video = Video::getVideoById($id);
        if (empty($video)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        if(empty($userid)){
            return view('errors.503',['error' =>'非法访问','url'=>'/']);
        }
        $vipOrNO = User_vip::getVipNowByUserId($userid);
        if($video->is_admin == '1'){
            if($vipOrNO == '1'){
                $filename = $video->video;
            }else{
                $filename = $video->video.'_short.mp4';
            }
        }else{
            $filename = $video->video;
        }
        $temp_path  = tempnam(sys_get_temp_dir(), $filename);
        file_put_contents($temp_path, Storage::disk('video')->get($filename));
        $downResponse = new BinaryFileResponse($temp_path);
        return   $downResponse;
    }
    public function addVideoTime(Request $request){
        $userid = $request->input('userid');
        $video_id = $request->input('video_id');
        $video_time= $request->input('video_time');
        Video_time::addVideoTime($userid, $video_id, $video_time);
        return array('result' => 'success');
    }
    public function getCat($catid)
    {
        if($catid != 0){
            $video = Video::getCatVideo($catid);
        }else{
            $video = Video::getShowVideo();
        }
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.search',compact('user_doc','video','category'));
    }
    public function getDocVideo($doc_id)
    {
        $video = Video::getUserDocVideo($doc_id);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('front.search',compact('user_doc','video','category'));
    }
    //视频评论的添加
    public  function  postAddComment(Request $request){
        $video_comment = $request->except(['_token']);
        $Validate = Video_comment::addComVal($video_comment);
        if ($Validate->fails()) {
            return array('error' => $Validate->messages()->first());
        }
        //是否在封禁表中
        $data = Black_user::isBlackUser($video_comment['userid']);
        if(empty($data)){
            $val = ComService::hasDenyWord($video_comment['comment'], 10);
            if ($val) {
                Black_user::addBlackTmpUser($video_comment['userid'],$video_comment['comment']);
                return array('error' => '您的评论内容存在'.$val.'等违规信息，再次发送会被封禁');
            }
        }else{
            if($data->num == 2){
                return array('error' => '您已经被封禁暂时不能发言，如有异议请联系管理员');
            }else{
                $val = ComService::hasDenyWord($video_comment['comment'], 10);
                if ($val) {
                    Black_user::editBlackUser($video_comment['userid'],$video_comment['comment']);
                    return array('error' => '您的评论内容存在'.$val.'等违规信息，再次发送会被封禁');
                }
            }
        }
        if(empty($video_comment['video_id'])){
            return array('error' => 'fail');
        }else{
            $ret = Video_comment::addVideoCommment($video_comment);
            if($ret){
                return array('result' => 'OK');
            }
        }
    }
    //收藏或者点赞记录log
    public function postLikeOrCollect(Request $request){
        $userid = $request->input('userid');
        if(empty($userid)){
            $array = array('fail'=>true,'msg' => '未登录');
            return json_encode($array);
        }
        $type = $request->input('type');
        $del_flg = $request->input('del_flg');
        $Log = $request->except(['_token','type','del_flg']);
        if($type  == 'like'){
            if($del_flg != 'Y'){
                $re = Like_log::addLikeLog($Log);
                if($re > 0){
                    $array = array('msg' => 'OK');
                    return json_encode($array);
                }
            }else{
                $ret = Like_log::delUserIdLike($userid, $Log['vid']);
                if($ret > 0){
                    $array = array('msg' => 'OK');
                    return json_encode($array);
                }
            }
        }else{
            if($del_flg != 'Y'){
                $re = Collect_log::addCollectLog($Log);
                if($re > 0){
                    $array = array('msg' => 'OK');
                    return json_encode($array);
                }
            }else{
                $ret = Collect_log::delUserIdCollect($userid, $Log['vid']);
                if($ret > 0){
                    $array = array('msg' => 'OK');
                    return json_encode($array);
                }
            }

        }
    }
}