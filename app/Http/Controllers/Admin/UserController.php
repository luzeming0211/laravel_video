<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Ident\Front\AuthController;
use App\Model\Admin;
use App\Model\User;
use App\Model\User_vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $user = User::getUserAll();
        return view('admin.user',compact('user'));
    }
    public function create()
    {
        return view('admin.user_add');
    }
    public function edit($userid){
        $userInfo = User::getUserByUserId($userid);
        return view('admin.user_edit',compact('userInfo'));
    }
    public function update(Request $request,$id) {
        $validator = User::editUserValidate($request->input());
        if ($validator->fails()) {
            return view('errors.503',['error' =>$validator->messages()->first()]);
        }
        $ret = User::editUserInfoById($request->input('userid'), $request->input('name'),$request->input('email'), $request->input('password') );
        if($ret){
            return redirect('/admin/auth/user');
        }else{
            return view('errors.503',['error' =>'修改失败']);
        }
    }
    public function userDestroy(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $ret = User::delUserByIdArray($id_array);
            User_vip::delUserVipByIdArray($id_array);
            if($ret){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }


    public function store(Request $request)
    {
        $validator = User::addUserValidate($request->input());
        if ($validator->fails()) {
            return view('errors.503',['error' =>$validator->messages()->first()]);
        }
        $userid = User::addUser($request->name, $request->email, $request->password);
        User_vip::addUserVipInit($userid);
        User::editUserFlag($userid);
        if($userid){
            return redirect('/admin/auth/user');
        }else{
            return view('errors.503',['error' =>'用户添加失败']);
        }
    }


//    public function destroy($userid)
//    {
//        $ret = User::delUserById($userid);
//        User_vip::delUserVipByUserid($userid);
//        if($ret){
//            return json_encode(['success' => true, 'msg' => '删除成功']);
//        }
//    }
    public function export()
    {
        $user = User::getUserExport();
        Array_unshift($user,['id','userid','用户名','邮箱','创建时间','修改时间','是否激活','角色']);
        Excel::create(iconv('UTF-8', 'GBK', '用户').date('YmdHis'),function($excel) use ($user){
            $excel->sheet('user', function($sheet) use ($user){
                $sheet->rows($user);
            });
        })->store('xls')->export('xls');
    }
}