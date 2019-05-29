<?php


namespace App\Http\Controllers\Mobile;


use App\Model\Ad;
use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Model\Live;
use App\Model\Video;
use App\Model\Video_comment;
use App\Services\ComService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $ad_index1 = Ad::getAdByPosition('index1');
        $ad_index2 = Ad::getAdByPosition('index2');
        $weixin_flag = ComService::is_weixin();
        $live = Live::getLiveTwo();
        $liveIng = Live::getLive();
        $video = Video::getShowVideo();
        $category2 = Category::getCatName();
        return view('mobile.index',compact('ad_index1','ad_index2','video','userid','username','category2','weixin_flag','live','liveIng'));
    }
    public function search(Request $request){
        $category = Category::getCatName();
        $search_content = $request->input('search');
        //热门搜索
//        if (empty($search_content)){
//            $search_content = '大';
//        }
        if(!empty($search_content)){
            $video = Video::getVideoSearch($search_content);
        }
        return view('mobile.search' ,compact('video','category'));
    }
    public function detail($id){
        $video = Video::getVideoById($id);
        if (empty($video)){
            return view('errors.503',['error' =>'找不到该视频']);
        }
        $other_video = Video::getVideoAbout( $video->catid, $id, 10);
        $video_comment = Video_comment::getComById($id);
        $category = Category::getCatName();
        $category_name = Category::getCatNameById($video->catid);
        return view('mobile.detail',compact('video_comment','video','category','category_name','video','other_video'));
    }
}