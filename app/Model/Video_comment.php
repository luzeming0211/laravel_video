<?php

namespace App\Model;

use function EasyWeChat\Kernel\Support\get_client_ip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Video_comment extends Model
{
    protected $table = 'video_comment';


    protected $fillable = ['video_id', 'comment', 'userid','username','created_at','updated_at'];

    public static  function getComById($id){
            return  self::where('video_id', $id)->get();
    }
    public static  function getComByVideoId($id){
        return  self::where('video_id', $id)
            ->orderBy('created_at','desc')
            ->paginate(15);
    }
    public static function  getCom(){
           return  self::orderBy('created_at','desc')->paginate(15);
    }
    public static function  addVideoCommment($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }

    public static function addComVal($input = null)
    {
        return Validator::make($input, [
            'video_id' => 'required',
            'userid' => 'required',
            'username' => 'required',
            'comment' => 'required',

        ], [
            'required' => ':attribute为必填项',
        ], [
            'video_id' => '视频id',
            'userid' => '用户id',
            'username' => '用户名',
            'comment' => '评论内容',
        ]);
    }
}
