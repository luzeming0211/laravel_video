<?php

namespace App\Model;

use function EasyWeChat\Kernel\Support\get_client_ip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like_log extends Model
{
    protected $table = 'like_log';


    protected $fillable = ['resource', 'vid', 'userid','del_flg','ip_address','user_agent','create_date'];
    public static function  getUseridLikeNum($userid)
    {
        return self::select(DB::raw("count(*) as num"))
            ->where('userid', '=', $userid)
            ->first();
    }
    public static function  getUseridIsLike($vid,$userid)
    {
        return self::where('vid', $vid)
            ->where('userid', $userid)
            ->orderBy('create_date', 'desc')
            ->first();
    }
    public static function  addLikeLog($data)
    {
        $data['ip_address'] = get_client_ip();
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['create_date'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }
    public static function  delUserIdLike($userid, $video_id)
    {
        return self::where('vid', $video_id)
            ->where('userid',$userid)
            ->delete();
    }

}
