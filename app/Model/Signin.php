<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Signin extends Model
{
    protected $table = 'signin';


    protected $fillable = ['userid', 'count','signin_date','continue_signin_count'];

    public static function  getUseridIsSigin($userid){
        return  self::select(DB::raw("count(*) as num"))
            ->where('userid',$userid)
            ->whereDate('signin_date','=',date('Y-m-d'))
            ->value('num');
    }
    //给今天签到
    public static function  addUserSigninToday($userid)
    {
        $signin['userid'] = $userid;
        $signin['signin_date'] = date('Y-m-d H:i:s');
        return  self::insert($signin);
    }
    //查询本月签到
    public static function  getMonthSignin($userid)
    {
        return  self::select(DB::raw("date_format(signin_date,'%d') as count"))
            ->where('userid',$userid)
            ->whereMonth('signin_date','=',date('m'))
            ->pluck('count');
    }

}
