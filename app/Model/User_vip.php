<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class User_vip extends Model
{
    protected $table = 'user_vip';
    public $timestamps = false;

    protected $fillable = ['userid', 's_time', 'e_time','score'];
    public static function  getUserVipByUserId($userid){
        return  self::where('userid', $userid)
            ->first();
    }
    //查询用户现在是否为vip
    public static function  getVipNowByUserId($userid){
//        dd($userid);
        $user_vip =   self::where('userid', $userid)
                 ->first();
        if($user_vip->e_time > date('Y-m-d H:i:s')){
            return '1';
        }else{
            return '0';
        }
    }
    public static function delUserVipByUserid($userid)
    {
        return  self::where('userid', $userid)->delete();
    }
    public static function delUserVipByIdArray($id_array){
        return  self::whereIn('userid', $id_array)->delete();
    }
    //初始化vip表
    public static function  addUserVipInit($userid)
    {
        $user_vip['userid'] =  $userid;
        $user_vip['s_time'] =  date('Y-m-d H:i:s');
        $user_vip['e_time'] =  date('Y-m-d H:i:s');
        $user_vip['score']  = 0;
        return self::insert($user_vip);
    }
    //送积分
    public static function  addUserScore($userid , $num)
    {
        return  self::where('userid',$userid)->increment('score',$num);
    }

    public static function delUserVipByid($userid){
        return  self::where('userid', $userid)->delete();
    }
    public static function getUserVipAll(){
        return  self::orderBy('id', 'desc')->paginate(10);
    }
    public static function getUserVipAllNow(){
        return  self::orderBy('id', 'desc')
            ->where('e_time' ,'>',date('Y-m-d H:i:s'))
            ->paginate(10);
    }
    public static function editUserVipByUserId($userid ,$s_time,$e_time ,$score){
        return self::where('userid',$userid)->update([
            's_time'=>$s_time,
            'e_time'=>$e_time,
            'score'=>$score,
        ]);
    }
    //积分兑换
    public static function addVipByUserId($userid , $month_num){
        $flag = self::getVipNowByUserId($userid);
        $user_vip = self::getUserVipByUserId($userid);
        $str  = '+'.$month_num.' '.'months';
        if($flag){
            return   $user_vip->update([
                'e_time'=>date('Y-m-d H:i:s', strtotime($str,strtotime($user_vip->e_time))),
                'score'=> $user_vip->score - $month_num*100,
            ]);
        }else{
            return   $user_vip->update([
                's_time'=> date('Y-m-d H:i:s',time()),
                'e_time'=> date("Y-m-d H:i:s", strtotime($str)),
                'score'=> $user_vip->score - $month_num*100,
            ]);
        }
    }

    public static function updUserVipByUserId($s_time,$e_time,$userid){
        return self::where('userid',$userid)->update([
            's_time'=>$s_time,
            'e_time'=>$e_time,
        ]);

    }
}
