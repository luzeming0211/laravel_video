<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class Admin extends Authenticatable
{
    //表名
    protected $table = 'admins';

    //指定主键
    protected $primaryKey = 'id';

    //指定允许批量赋值的字段
    protected $fillable = [
        'name', 'account_number', 'password','created_at','update_at'
    ];


    //自动维护时间戳
   // public $timestamps = false;

    //定制时间戳格式
    //protected $dateFormat = 'U';

    //将默认增加时间转化为时间戳
//    protected function getDateFormat()
//    {
//        return time();
//    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    public static function  getAdminAll(){
        return  self::orderBy('created_at', 'desc') ->paginate(10);
    }
    public static function delAdminByIdArray($id_array){
        return  self::whereIn('account_number', $id_array)->delete();
    }
    public static function getAdminByUserAccount_number($account_number){
        return self::where('account_number', $account_number)->first();
    }
    public static function editAdminInfoById($account_number,$name, $password){
        return self::where('account_number',$account_number)->update([
            'name'=>$name,
            'password'=>bcrypt($password),
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function addAdmin($name, $password){
        $user['account_number'] = self::max('account_number')+1;
        $user['name'] = $name;
        $user['password'] = bcrypt($password);
        $user['created_at'] = date('Y-m-d H:i:s');
        $user['updated_at'] = date('Y-m-d H:i:s');
        $ret = self::insert($user);
        if($ret){
            return  $user['account_number'];
        }else{
            return  null;
        }
    }
    public static function addAdminValidate($input){
        return Validator::make($input, [
            'name' => 'required|alpha_num|max:255',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|'
        ], [
            'required' => ':attribute为必填项',
            'min' => ':attribute长度不符合要求',
            'confirmed' => '两次输入的密码不一致',
            'alpha_num' => ':attribute必须为字母或数字'
        ], [
            'name' => '昵称',
            'password' => '密码',
            'password_confirmation' => '确认密码'
        ]);
    }
}