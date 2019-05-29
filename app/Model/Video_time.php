<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video_time extends Model
{
    protected $table = 'video_time';


    protected $fillable = ['id', 'userid','video_id','time','created_at','updated_at'];

    public static function  getVideoTimeByUserid($userid, $video_id){
        return  self::where('userid',$userid)
                 ->where('video_id',$video_id)
                 ->orderBy('created_at','desc')
                 ->first();
    }
    public static function  addVideoTime($userid, $video_id, $video_time){
        $data['userid'] = $userid;
        $data['video_id'] = $video_id;
        $data['time'] = $video_time;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return  self::insert($data);
    }

}
