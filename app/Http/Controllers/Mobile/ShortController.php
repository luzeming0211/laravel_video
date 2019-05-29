<?php


namespace App\Http\Controllers\Mobile;


use App\Model\Ad;
use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Model\Live;
use App\Model\Short;
use App\Model\Video;
use App\Model\Video_comment;
use App\Model\Wechat_user;
use App\Services\ComService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ShortController extends Controller
{
    public function index(Request $request)
    {
        if(!ComService::is_weixin()){
            return view('errors.wechat',['error' =>'请在pc网站或微信公众号内观看直播']);
        }
        $user = Wechat_user::get_wechat_user();
        $userid = $user['userid'];
        if(empty($userid)){
            if(Session()->exists('wechat_user')) {
                redirect('/mobile/bind')->send();
            }else{
                return view('errors.503',['error' =>'您暂未绑定']);
            }
        }
        $short_top = Short::getShortTop();
        foreach ($short_top as $key1=>$value1){
            if(empty($value1->pic)){
                $value1->pic = '/uploads/'.$value1->video.'_short.jpg';
            }
        }
        $short = Short::getShortNoTop();
        foreach ($short as $key=>$value){
            if(empty($value->pic)){
                $value->pic = '/uploads/'.$value->video.'_short.jpg';
            }
        }
        return view('short.index',compact('short_top','short'));
    }
    public function play($id){
        if(ComService::is_weixin())
        {
            $user = Wechat_user::get_wechat_user();
            $userid = $user['userid'];
        }else{
            $user = self::get_user();
            $userid = $user['userid'];
        }
        $video = Short::getShortById($id);
        if (empty($video)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        if(empty($userid)){
            return view('errors.503',['error' =>'非法访问','url'=>'/']);
        }
        $filename = $video->video;
        $temp_path  = tempnam(sys_get_temp_dir(), $filename);
        file_put_contents($temp_path, Storage::disk('video')->get($filename));
        $downResponse = new BinaryFileResponse($temp_path);
        return $downResponse;
    }
}