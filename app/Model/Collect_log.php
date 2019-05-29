<?php

namespace App\Model;

use function EasyWeChat\Kernel\Support\get_client_ip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Collect_log extends Model
{
    protected $table = 'collect_log';


    protected $fillable = ['resource', 'vid', 'userid','del_flg','ip_address','user_agent','create_date'];
    public static function  getUseridCollect($userid){
        return  self::join('video', 'video.id', '=', 'collect_log.vid')
            ->join('user_doc', 'video.userid', '=', 'user_doc.doc_id')
            ->where('is_show', 1)
            ->where('status', 'FINISH')
            ->where('collect_log.userid', '=',$userid)
            ->limit(12)
            ->select('video.id', 'video.description', 'video.catid','video.thumb','video.video','video.userid','video.pv','video.created_at','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->get();
    }
    public static function  getUseridCollectNum($userid){
        return  self::select(DB::raw("count(*) as num"))
            ->where('userid','=',$userid)
            ->first();
    }
    public static function  getUseridIsCollect($vid,$userid)
    {
        return self::where('vid', $vid)
            ->where('userid', $userid)
            ->orderBy('create_date', 'desc')
            ->first();
    }

    //查询本周收藏
    public static function  getCollectRecent($userid)
    {
        $start = Carbon::now()->startOfWeek();
        $end =   Carbon::now()->endOfWeek();
        return self::where('create_date','>', $start)
            ->where('create_date','<', $end)
            ->where('userid', $userid)
            ->orderBy('create_date', 'desc')
            ->pluck('vid')
            ->toArray();
    }
    public static function  addCollectLog($data)
    {
        $data['ip_address'] = get_client_ip();
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['create_date'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }
    public static function  delUserIdCollect($userid, $video_id)
    {
        return self::where('vid', $video_id)
            ->where('userid',$userid)
            ->delete();
    }
}
