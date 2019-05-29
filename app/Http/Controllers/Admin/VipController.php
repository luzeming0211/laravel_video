<?php

namespace App\Http\Controllers\Admin;


use App\Model\User_vip;
use Illuminate\Http\Request;

class VipController
{

    public function index()
    {
        $user_vip = User_vip ::getUserVipAll();
        return view('admin.vip',compact('user_vip'));
    }

    public function edit($userid)
    {
        $user_vip_info = User_vip::getUserVipByUserId($userid);
        return view('admin.vip_edit',compact('user_vip_info'));
    }
    public function update(Request $request,$userid) {
        $s_time = $request->input('s_time');
        $e_time = $request->input('e_time');
        $score = $request->input('score');
        if (empty($s_time) || empty($e_time) ||empty($score)){
            return view('errors.503',['error' =>'数据不全']);
        }
        if($e_time < $s_time){
            return view('errors.503',['error' =>'结束时间应该大于开始时间']);
        }
        $ret = User_vip::editUserVipByUserId($userid ,$s_time,$e_time ,$score);
        if($ret){
            return redirect('/admin/auth/vip');
        }else{
            return view('errors.503',['error' =>'修改失败']);
        }
    }
    public function del(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
//            dd($id_array);
            $ret = Admin::delAdminByIdArray($id_array);
            if($ret){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }

}