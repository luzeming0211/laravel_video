<?php

namespace App\Http\Controllers\Mobile;


use App\Model\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class CatController
{
    public function  getMore()
    {
        $page = Input::get('page');//第几页
        $size = Input::get('size');//每页数据条数
        $catid = Input::get('catid');//每页数据条数
        $data = Video::loadingMore($page, $size, $catid);
        $num  = $data->count();
        $page = $page+1;
        return json_encode(['page'=>$page,'catid'=>$catid,'num'=> $num, 'data' => (string)view('mobile_inc.more', compact('page','catid','num','data'))]);
    }
    public function  getCat(Request $request)
    {
        $catid = $request->input('catid');
        $video = Video::getCatVideo($catid);
        $num   = $video->total();
        return json_encode(['catid'=>$catid,'num'=> $num,'video' => (string)view('mobile_inc.video', compact('catid','num','video'))]);
    }

}