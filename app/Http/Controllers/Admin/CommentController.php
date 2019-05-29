<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Sens;
use App\Model\Video_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function getIndex()
    {
        $comment = Video_comment::getCom();
        return view('admin.comment',['comment' => $comment]);
    }

    //敏感词列表
    public function getSens()
    {
        $sens = Sens::getSens();
        return view('admin.sens',['sens' => $sens]);
    }

    //删除敏感词
    public function del(Request $request)
    {
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $res = DB::table('video_comment')->whereIn('id', $id_array)->delete();
            if($res){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }
    public function destroy(Request $request)
    {
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $res = DB::table('video_comment')->whereIn('id', $id_array)->delete();
            if($res){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }
    public function search(Request $request)
    {
        $video_id = $request->input('form_id');
        if(empty($video_id)){
            return view('errors.503',['error' =>'视频id不能为空']);
        }
        $comment = Video_comment::getComByVideoId($video_id);
        if(empty($comment)){
            return view('errors.503',['error' =>'该视频还没有人评论']);
        }
        return view('admin.comment',compact('comment','video_id'));
    }

}