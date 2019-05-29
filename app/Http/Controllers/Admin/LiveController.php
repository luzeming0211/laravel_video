<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Live;
use App\Model\User_doc;
use App\Model\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LiveController extends Controller
{
    public function getIndex()
    {
        $Live = Live::getLiveAll();
        $today_date = date('Y-m-d h:i:s');
        return view('admin.live',compact('Live','today_date'));
    }
    public function getCreate()
    {
        $now_time = date('Y-m-d H:i',time());
        $user_doc = User_doc::getUserDoc();
        return view('admin.live_add',compact('now_time','user_doc'));
    }
    public function postStore(Request $request)
    {
        $data = $request->except(['_token','upload_file','photo_add','appname','streamname']);
        $live['thu'] = $request->input('photo_add');
        if (empty($live['thu'])){
            return view('errors.503',['error' =>'图片不能为空']);
        }
        $oValidate = Live::liveValidate($data);
        if ($oValidate->fails()) {
            return view('errors.503',['error' =>$oValidate->messages()->first()]);
        }
        $res = Live::insertLive($data , $live['thu']);
        if($res){
            return redirect('/admin/live/list');
        }
    }
    public function getEdit($id)
    {
        $live = Live::getLiveById($id);
        $user_doc = User_doc::getUserDoc();
        return view('admin.live_edit',compact('live','user_doc'));
    }
    public function postEditDo(Request $request)
    {
        $data = $request->except(['_token','upload_file','photo_edit','appname','streamname']);
        $data['thu'] = $request->input('photo_edit');
        $live['id'] = $request->input('id');
        if (empty($data['thu'])){
            return view('errors.503',['error' =>'图片不能为空']);
        }
        $oValidate = Live::liveValidate($data);
        if ($oValidate->fails()) {
            return view('errors.503',['error' =>$oValidate->messages()->first()]);
        }
        $tmp_live = Live::getLiveById($live['id']);
        $del_thu = substr($tmp_live->thu,9);
        if($tmp_live->thu != $data['thu'] ){
            Storage::disk('uploads')->delete($del_thu);
        }
        $ret  = Live::editLiveById($live['id'] , $data);
        if($ret){
            return redirect('/admin/live/list');
        }
    }
    public function postDestroy(Request $request)
    {
        if($request->ajax()) {
            $id = $request->input('id');
            $data = Live::find($id);
            $thu = substr($data->thu,9);
            Storage::disk('uploads')->delete($thu);
            $data->delete();
            return response()->json('删除成功 :)');
        }else{
            return response()->json('删除失败 :(');
        }
    }
}