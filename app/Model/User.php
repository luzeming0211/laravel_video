<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class User extends Authenticatable
{

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'userid', 'name', 'email', 'password','flag','role'
    ];

    //指定不允许批量赋值的字段
    protected $guarded = [];

    //自动维护时间戳
    public $timestamps = false;

    //定制时间戳格式
    protected $dateFormat = 'U';


    protected $hidden = [
        'password', 'remember_token', 'app_token',
    ];

    public static function validateIdentify($email = '', $password = '')
    {
        $pwd = self::where('email', $email)->value('password');
        if(empty($pwd)){
            return false;
        }else{
            $res =Hash::check($password, $pwd);
            return ($res);
        }
    }
    public static function check_pwd($email = '', $password = '')
    {
        $pwd = self::where('email', $email)->where('flag','1')->value('password');
        if(empty($pwd)){
            return false;
        }else{
            $res =Hash::check($password, $pwd);
            return ($res);
        }
    }
    public static function getUser($email = ''){
        $data = self::where('email', $email)->first();
        return $data;
    }
    public static function  getUserAll(){
        return  self::orderBy('create_time', 'desc') ->paginate(10);
    }
    public static function  getUserExport(){
        return  self::orderBy('create_time', 'desc')->get()->toArray();
    }
    public static function getUserByUserId($userid){
        $data = self::where('userid', $userid)->first();
        return $data;
    }
    public static function editUserInfoById($userid,$name, $email, $password){
        $res = self::where('userid',$userid)->update([
            'name'=>$name,
            'email'=>$email,
            'password'=>bcrypt($password),
            'update_time'=>date('Y-m-d H:i:s',time()),
        ]);
        return $res;
    }

    public static function editPwd($email, $password){
        return self::where('email',$email)->update([
            'password'=>bcrypt($password),
            'update_time'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function delUserByIdArray($id_array){
        return  self::whereIn('userid', $id_array)->delete();
    }
    public static function delUserById($userid){
        return  self::where('userid', $userid)->delete();
    }
    public static function editUserFlag($userid){
        $res = self::where('userid',$userid)->update([
            'flag' => 1,
        ]);
        return $res;
    }
    public static function getUserByEmail($email){
        return self::where('email',$email)->first();
    }

    public static function addUser($name, $email, $password){
        $user['userid'] = self::max('userid')+1;
        $user['name'] = $name;
        $user['email'] = $email;
        $user['password'] = bcrypt($password);
        $user['create_time'] = date('Y-m-d H:i:s');
        $user['update_time'] = date('Y-m-d H:i:s');
        $ret = self::insert($user);
       if($ret){
           return  $user['userid'];
       }else{
           return  null;
       }
    }

    public static function addUserValidate($input){
        return Validator::make($input, [
            'name' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|'
        ], [
            'required' => ':attribute为必填项',
            'min' => ':attribute长度不符合要求',
            'confirmed' => '两次输入的密码不一致',
            'unique' => '该邮箱已经被人占用',
            'alpha_num' => ':attribute必须为字母或数字'
        ], [
            'name' => '昵称',
            'email' => '邮箱',
            'password' => '密码',
            'password_confirmation' => '确认密码'
        ]);
    }
    public static function editUserValidate($input){
        return Validator::make($input, [
            'name' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|'
        ], [
            'required' => ':attribute为必填项',
            'min' => ':attribute长度不符合要求',
            'confirmed' => '两次输入的密码不一致',
            'alpha_num' => ':attribute必须为字母或数字'
        ], [
            'name' => '昵称',
            'email' => '邮箱',
            'password' => '密码',
            'password_confirmation' => '确认密码'
        ]);
    }
    //登录页面验证
    public static function validateLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ], [
            'required' => ':attribute 为必填项',
        ], [
            'email' => '邮箱',
            'password' => '密码'
        ]);
    }

}