<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Ident\Front\AuthController;
use App\Model\Admin;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
{

    public function index()
    {
        $mannger = config('mannger');
        $admin = isset(Auth::guard('admin')->user()->account_number)?Auth::guard('admin')->user()->account_number:'';
        if (!in_array($admin, $mannger)){
            return view('errors.503',['error' =>'您没有此权限']);
        }
        $admins = Admin::getAdminAll();
        return view('admin.manager',compact('admins'));
    }
    public function del(Request $request){
        if($request->ajax()) {
            $id_array = $request->input('id_array');
            $ret = Admin::delAdminByIdArray($id_array);
            if($ret){
                return response()->json(['success' => true, 'msg' => '删除成功']);
            }
        }
    }

    public function create()
    {
        return view('admin.manager_add');
    }
    public function edit($account_number){

        $admin_info = Admin::getAdminByUserAccount_number($account_number);
        return view('admin.manager_edit',compact('admin_info'));
    }
    public function update(Request $request,$id) {
        $validator = Admin::addAdminValidate($request->input());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $account_number = $request->input('account_number');
        $name = $request->input('name');
        $password =$request->input('password');
        $ret = Admin::editAdminInfoById($account_number, $name, $password );
        if($ret){
            return redirect('/admin/auth/ma');
        }else{
            return view('errors.503',['error' =>'修改失败']);
        }
    }

    public function store(Request $request)
    {
        $validator = Admin::addAdminValidate($request->input());
        if ($validator->fails()) {
            return view('errors.503',['error' =>$validator->messages()->first()]);
        }
        $account_number = Admin::addAdmin($request->input('name'),$request->input('password'));
        if($account_number){
            return redirect('/admin/auth/ma');
        }else{
            return view('errors.503',['error' =>'添加失败']);
        }
    }

}