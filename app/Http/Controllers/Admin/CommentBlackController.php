<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\Black_user;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentBlackController extends Controller
{
    public function index()
    {
        $black_user = Black_user::getBlackUserAll();
        return view('admin.com_black_user',compact('black_user'));
    }
    public function del(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $ret = Black_user::delBlackUserByIdArray($id_array);
            if($ret){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }

}