<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplyController extends Controller
{
    public function getApply()
    {
        $apply_list = User_info::getApplyAll();
        return view('admin.apply',compact('apply_list'));
    }
    public function action(Request $request)
    {
        $userid = $request->input('userid');
        $type  = $request->input('type');
        $ret = DB::table("user_info")->where('userid',$userid)->update([
            'status'=> $type,
        ]);
        if($ret){
            $json = array('success'=>true,'msg'=> 'OK');
            echo json_encode($json);
            die;
        }

    }

}