<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BlackController extends Controller
{
    public function index()
    {
        $key = "black_user".":*";
        $black_user = Redis::keys($key);
        return view('admin.black_user',compact('black_user'));
    }

    public function store(Request $request)
    {
        $userid = $request->input('userid');
        Redis::set('black_user:'.$userid,$userid);
        return redirect('/admin/live/black');
    }
    public function del(Request $request)
    {
        $black_user = $request->input('black_user');
        Redis::del($black_user);
        echo json_encode(array('success'=>true,'msg'=> 'OK'));
        die;
    }
}