<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Short;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FFMpeg;
class ShortController extends  Controller
{
    public function index()
    {
        $short = Short::getShortAll();
        return view('admin.short',['short' => $short]);
    }
    public function edit($id)
    {
        $short_info = Short::getShortById($id);
        return view('admin.short_edit',compact('short_info'));
    }
    public  function create()
    {
        return view('admin.short_add',compact(''));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $ret = Short::addShort($input);
        if($ret){
            return redirect('/admin/short');
        }
    }
    public function update(Request $request,$id)
    {
        $input = $request->except(['_token','upload_file','upload_video','video']);
        $ret = Short::editShort($input);
        if($ret){
            return redirect('/admin/short');
        }
    }
    public function del(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $res = DB::table('short')->whereIn('id', $id_array)->delete();
            if($res){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }
    public function top(Request $request){
        $id = $request->input('id');
        $act = $request->input('act');
        $ret = Short::editTopShort($id,$act);
        if($ret){
            return response()->json(['success' => true, 'msg' => '修改成功']);
        }
    }
    public function postUploadVideo(Request $request)
    {
        if ($request->isMethod('POST')) {
            $fileCharater = $request->file('upload_video');
            if ($fileCharater->isValid()) {
                $path = $fileCharater->store('video');
                $path = substr($path,6);
                $ffmpeg = FFMpeg\FFMpeg::create(array(
                    'ffmpeg.binaries'  => '/monchickey/ffmpeg/bin/ffmpeg',
                    'ffprobe.binaries' => '/monchickey/ffmpeg/bin/ffprobe',
                    'timeout' => 3600,
                    'ffmpeg.threads' => 15,
                ));
                $video_path = config('hydrogen.video_path');
                $video_photo_path = config('hydrogen.short_photo_path');
                $video = $ffmpeg->open($video_path.$path);
                $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(3));
                $frame->save($video_photo_path.$path.'_short.jpg');
                $json = array('success'=>true,'video'=>$path);
                echo json_encode($json);
                die;
            }
        }
    }
}