<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Ad;
use App\Model\Login_log;
use App\Model\Pay_log;
use App\Model\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function PHPSTORM_META\type;

class AdController extends Controller
{
    public function index()
    {
        $ad = Ad::getAdAll();
        return view('admin.ad',compact('ad'));
    }
    public function edit($id){
        $ad_info = Ad::getAdById($id);
        return view('admin.ad_edit',compact('ad_info'));
    }
    public function update(Request $request,$id) {
        $ret = Ad::editAdById($request->all());
        if($ret){
            session()->flash('success', '修改成功');
            return redirect('/admin/ad');
        }else{
            return view('errors.503',['error' =>'修改失败']);
        }
    }

    public function getVideoAd(Request $request) {
        $video_ad = file('assets/ckplayer/ad.json');
        $video_ad = mb_convert_encoding($video_ad, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
        $video_ad = implode("\r\n", $video_ad);
        $video_ad = json_decode($video_ad,true);
        $video_ad = $video_ad['front'][0];
        return view('admin.video_ad',compact('video_ad'));
    }
    public function VideoAdDo(Request $request) {
        $data['front'][]  = $request->except(['_token']);
        $ret = Storage::disk('ckplayer')->put('ad.json', json_encode($data,320), 'public');
        session()->flash('success', '修改成功');
        if($ret){
            return redirect('/admin/vad');
        }
    }


}