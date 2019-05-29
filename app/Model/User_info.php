<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class User_info extends Model
{
    protected $table = 'user_info';


    protected $fillable = ['userid', 'name', 'idcard','status','doc_card_id','created_at','updated_at'];

    public static function getApplyInfoByUserid($userid){
        return self::where('userid', $userid)->first();
    }
    public static function getApplyAll(){
        return self::paginate(15);
    }
    public static function checkUserid($userid){
        return self::where('userid', $userid)
            ->where('status', 'ACCESS')
            ->first();
    }
    public static function addApplyInfo($data , $status){
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['status'] = $status;
        return  self::insert($data);
    }
    public static function UserInfoValidate($input = null)
    {
        return Validator::make($input, [
            'userid' => 'required',
            'name' => 'required',
            'doc_card_id' =>  'required|alpha_num|max:255',
            'idcard' => 'required|numeric',

        ], [
            'required' => ':attribute为必填项',
            'alpha_num' => ':attribute必须为字母或数字',
            'numeric' => ':attribute必须为字母或数字',
        ], [
            'name' => '姓名',
            'doc_card_id' => '医生证号',
            'idcard' => '身份证号',
            'userid' => '用户ID',
        ]);
    }
}
