<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Login_log;
use App\Model\Pay_log;
use App\Model\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index()
    {
        $login_log = Login_log::getAll();
        return view('admin.log',compact('login_log'));
    }
    public function clear()
    {
        Login_log::clear();
        echo json_encode(array('success'=>true));
    }
    public function delLoginLog(Request $request)
    {
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $res = Login_log::delByIdArray($id_array);
            if($res){
                echo json_encode(array('success'=>true));
            }
        }
    }
    public function getPayLog(Request $request)
    {
        $pay_log = Pay_log::getPaySuccessLog();
        return view('admin.pay_log',compact('pay_log'));
    }

}