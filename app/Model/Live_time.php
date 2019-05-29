<?php

namespace App\Model;
use App\Services\ComService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Live_time extends Model
{
    protected $table = 'live_time';


    protected $fillable = ['userid','live_id','created_at','updated_at'];

    public  static  function addSTime($userid, $live_id, $user_agent){
        $data['userid'] = $userid;
        $data['user_agent'] = $user_agent;
        $data['live_id'] = $live_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return  self::insert($data);
    }
    public  static  function editETime($userid, $live_id){
         $id = self::where('userid', $userid)
             ->where('live_id',$live_id)
             ->orderBy('created_at','desc')
             ->value('id');
       return   self::where('id',$id)
            ->update([
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public  static  function getAndroid(){
        return self::where('user_agent','android')
            ->select(DB::raw('count(DISTINCT userid) as android_num'))
            ->value('android_num');

    }
    public  static  function getPC(){
        return self::where('user_agent','pc')
            ->select(DB::raw('count(DISTINCT userid) as pc_num'))
            ->value('pc_num');
    }
    public  static  function getIOS(){
        return self::where('user_agent','ios')
            ->select(DB::raw('count(DISTINCT userid) as ios_num'))
            ->value('ios_num');
    }
    public  static  function getLastInfo(){
        //-1天
        $last_one_start = date('Y-m-d', strtotime('-1 day', time())) . ' '.'00:00:00';
        $last_one_end = date('Y-m-d', strtotime('-1 day', time())) . ' '.'23:59:59';
        $last_one_info =  self::whereBetween('created_at', [$last_one_start, $last_one_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_one_time = 0;
        foreach ($last_one_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_one_time  = $u - $c + $last_one_time;
        }
        $last_time_info['last_one_time'] = $last_one_time;
        //-2天
        $last_two_start = date('Y-m-d', strtotime('-2 day', time())) . ' '.'00:00:00';
        $last_two_end = date('Y-m-d', strtotime('-2 day', time())) . ' '.'23:59:59';
        $last_two_info =  self::whereBetween('created_at', [$last_two_start, $last_two_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_two_time = 0;
        foreach ($last_two_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_two_time  = $u - $c + $last_two_time;
        }
        $last_time_info['last_two_time'] = $last_two_time;
        //-3天
        $last_three_start = date('Y-m-d', strtotime('-3 day', time())) . ' '.'00:00:00';
        $last_three_end = date('Y-m-d', strtotime('-3 day', time())) . ' '.'23:59:59';
        $last_three_info =  self::whereBetween('created_at', [$last_three_start, $last_three_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_three_time = 0;
        foreach ($last_three_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_three_time  = $u - $c + $last_three_time;
        }
        $last_time_info['last_three_time'] = $last_three_time;
        //-4天
        $last_four_start = date('Y-m-d', strtotime('-4 day', time())) . ' '.'00:00:00';
        $last_four_end = date('Y-m-d', strtotime('-4 day', time())) . ' '.'23:59:59';
        $last_four_info =  self::whereBetween('created_at', [$last_four_start, $last_four_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_four_time = 0;
        foreach ($last_four_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_four_time  = $u - $c + $last_four_time;
        }
        $last_time_info['last_four_time'] = $last_four_time;
        //-5天
        $last_five_start = date('Y-m-d', strtotime('-5 day', time())) . ' '.'00:00:00';
        $last_five_end = date('Y-m-d', strtotime('-5 day', time())) . ' '.'23:59:59';
        $last_five_info =  self::whereBetween('created_at', [$last_five_start, $last_five_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_five_time = 0;
        foreach ($last_five_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_five_time  = $u - $c + $last_five_time;
        }
        $last_time_info['last_five_time'] = $last_five_time;
        //-6天
        $last_six_start = date('Y-m-d', strtotime('-6 day', time())) . ' '.'00:00:00';
        $last_six_end = date('Y-m-d', strtotime('-6 day', time())) . ' '.'23:59:59';
        $last_six_info =  self::whereBetween('created_at', [$last_six_start, $last_six_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_six_time = 0;
        foreach ($last_six_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_six_time  = $u - $c + $last_six_time;
        }
        $last_time_info['last_six_time'] = $last_six_time;
        //-7天
        $last_seven_start = date('Y-m-d', strtotime('-7 day', time())) . ' '.'00:00:00';
        $last_seven_end = date('Y-m-d', strtotime('-7 day', time())) . ' '.'23:59:59';
        $last_seven_info =  self::whereBetween('created_at', [$last_seven_start, $last_seven_end])
            ->orderBy('created_at', 'desc')
            ->get();
        $last_seven_time = 0;
        foreach ($last_seven_info as $key=>$value){
            $c = strtotime($value->created_at->format('Y-m-d H:i:s'));
            $u = strtotime($value->updated_at->format('Y-m-d H:i:s'));
            $last_seven_time  = $u - $c + $last_seven_time;
        }
        $last_time_info['last_seven_time'] = $last_seven_time;
        return $last_time_info;
    }
}
