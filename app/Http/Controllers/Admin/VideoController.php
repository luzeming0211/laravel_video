<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\User_doc;
use App\Model\Video;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use FFMpeg;

class VideoController extends Controller
{

    public function index()
    {
        $video = Video::getVideoAll();
        $category = Category::getCatName();
        return view('admin.video',['video' => $video],['category' => $category]);
    }
    public function getCatVideo($catid)
    {
        if ($catid == 'all'){
            return redirect('/admin/video');
        }
        $video = Video::getCatVideo($catid);
        $category = Category::getCatName();
        return view('admin.video',compact('video','category','catid'));
    }
    public  function create()
    {
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('admin.video_add',compact('category','user_doc'));
    }

    public function show($id)
    {
        $video = Video::getVideoById($id);
        $category = Category::getCatName();
        $user_doc = User_doc::getUserDoc();
        return view('admin.video_edit',compact('category','video','user_doc'));
    }


    public function store(Request $request)
    {
        $input = $request->except(['_token','upload_file','upload_video','video','video_add']);
        $input['video'] = $request->input('video_add');
        $oValidate = Video::addValidate($input);
        if ($oValidate->fails()) {
            return view('errors.503',['error' =>$oValidate->messages()->first()]);
        }
        $ret = Video::addVideo($input, $input['video']);
        if($ret > 0){
            return redirect('/admin/video');
        }
    }


    public function update(Request $request,$id)
    {
        $input = $request->except(['_token','upload_file','upload_video','video','video_edit']);
        $input['video'] = $request->input('video_edit');
        $oValidate = Video::addValidate($input);
        if ($oValidate->fails()) {
            return view('errors.503',['error' =>$oValidate->messages()->first()]);
        }
        $tmp_video = Video::getVideoById($input['id']);
        $del_thumb = substr($tmp_video->thumb,9);
        $del_video = substr($tmp_video->video,9);
        if($tmp_video->thumb != $input['thumb'] ){
            Storage::disk('uploads')->delete($del_thumb);
        }
//        if($tmp_video->video != $input['video'] ){
//            Storage::disk('uploads')->delete($del_video);
//        }
        $ret = Video::editVideo($input);
        if($ret > 0){
            return redirect('/admin/video');
        }
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $data = Video::find($id);
        $thumb = substr($data->thumb,9);
        $video = substr($data->video,9);
        Storage::disk('uploads')->delete($thumb);
//        Storage::disk('uploads')->delete($video);
        $data->delete();
        $json = array('success'=>true,'msg'=>'删除成功');
        echo json_encode($json);
        die;
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
                $video = $ffmpeg->open($video_path.$path);
                $clip = $video->clip(FFMpeg\Coordinate\TimeCode::fromSeconds(0),
//                    FFMpeg\Coordinate\TimeCode::fromSeconds(10));
                    FFMpeg\Coordinate\TimeCode::fromSeconds(60));
                $clip->save(new FFMpeg\Format\Video\X264('aac','libx264'),
//                    $video_path.$path.'luzeming.mp4');
                    $video_path.$path.'_short.mp4');
                $json = array('success'=>true,'video'=>$path);
                echo json_encode($json);
                die;

            }
        }
    }


    public function postUploadThumb(Request $request)
    {
        if ($request->isMethod('POST')) {
            $fileCharater = $request->file('upload_file');
            if ($fileCharater->isValid()) {
                $ext = $fileCharater->getClientOriginalExtension();
                $iFileSize = $fileCharater->getSize();
                if (!($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg')) {
                    echo json_encode(['fail' => 1, 'msg' => '文件格式错误！']);
                    die;
                }
                if($iFileSize > 2000*1024){
                    $json = array('fail'=>true,'msg'=>'文件过大，请上传小于2m的图片');
                    echo json_encode($json);
                    die;
                }else{
                    $path = $fileCharater->getRealPath();
                    $rand = rand(1,99);
                    $filename = $rand.date('YmdHis') . '.' . $ext;
                    Storage::disk('uploads')->put($filename, file_get_contents($path));
                    $sFileUrl ='/uploads/'.$filename;
                    $url = 'uploads/'.$filename;
                    $img = Image::make($url)->resize(400, 300);
                    $img->save('uploads/'.$filename);
                    $json = array('success'=>true,'photo'=>$sFileUrl);
                    echo json_encode($json);
                    die;
                }
            }
        }
    }
}