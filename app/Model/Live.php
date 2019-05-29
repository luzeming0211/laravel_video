<?php

namespace App\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Live extends Model
{
    protected $table = 'live';


    protected $fillable = ['des', 'thu','userid','pv','push_url','play_url','start_time','end_time','created_at','updated_at'];

    public static function getSaTimeAttribute($value)
    {
        return date('Y/m/d H:i:s',$value);
    }
    //观看视频添加点击量
    public static function addLivePv($id){
        return  self::where('id',$id)->increment('pv',1);
    }
    public static function  getLiveTwo(){
         $live =  self::where('start_time', '>', date('Y-m-d H:i:s' ,time()))
             ->join('user_doc', 'live.userid', '=', 'user_doc.doc_id')
             ->select('live.*','user_doc.doc_name','user_doc.profess','user_doc.summary')
             ->take(2)
             ->get();
         foreach ($live as $ke=>$va){
             $va->start_time =   Carbon::parse($va->start_time)->format('Y/m/d H:i:s');
             $va->date =   Carbon::parse($va->start_time)->format('m月d日');
         }
        return $live;
    }

    public static function  getLiveAll(){
        $live =  self::orderBy('created_at', 'desc')
            ->paginate(12);
        return $live;
    }
    public static function  getLiveIng(){
        return   self::where('start_time', '<',date('Y-m-d H:i:s',time()))
            ->where('end_time', '>',date('Y-m-d H:i:s',time()))
            ->paginate(12);
    }

    public static function getLive(){
        $live =  self::where('start_time', '<', date('Y-m-d H:i:s' ,time()))
            ->where('end_time', '>', date('Y-m-d H:i:s' ,time()))
            ->join('user_doc', 'live.userid', '=', 'user_doc.doc_id')
            ->select('live.*','user_doc.doc_name','user_doc.profess','user_doc.summary')
            ->get();
        foreach ($live as $ke=>$va){
            $va->start_time =   Carbon::parse($va->start_time)->format('Y/m/d H:i:s');
            $va->date =   Carbon::parse($va->start_time)->format('m月d日');
        }
        return $live;
    }

    public static function  getLiveById($id){
        $live =  self::where('id', '=', $id)
            ->first();
        return $live;
    }
    public static function  insertLive($data , $thu){
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['thu'] = $thu;
        return self::insert($data);
    }
    public static function  editLiveById($id , $live){
        return self::where('id',$id)->update([
            'des'=>$live['des'],
            'thu'=>$live['thu'],
            'userid'=>$live['userid'],
            'pv'=>$live['pv'],
            'push_url'=>$live['push_url'],
            'play_url'=>$live['play_url'],
            'start_time'=>$live['start_time'],
            'end_time'=>$live['end_time'],
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
    public static function liveValidate($input = null)
    {
        return Validator::make($input, [
            'des' => 'required',
            'userid' => 'required',
            'pv' => 'required',
            'push_url' => 'required',
            'play_url' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ], [
            'required' => ':attribute为必填项',
        ], [
            'des' => '视频描述',
            'userid' => '医生',
            'pv' => '视频pv',
            'push_url' => '推流地址',
            'play_url' => '播放地址',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
        ]);
    }
}
