<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Live_time;
use App\Model\User_vip;

class AdminController extends Controller
{
    public function index()
    {
        $android_num = Live_time::getAndroid();
        $ios_num = Live_time::getIOS();
        $pc_num = Live_time::getPC();
        $last_time_info = Live_time::getLastInfo();
        $vip_info = User_vip::getUserVipAllNow();
        return view('admin.index',compact('android_num','ios_num','pc_num','last_time_info','vip_info'));
    }
}