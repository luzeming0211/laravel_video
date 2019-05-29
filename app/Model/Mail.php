<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mail';


    protected $fillable = ['id','userid', 'send_user','title','is_read','is_del','created_at'];
    public static function getMailByUserid($userid){
        $mail =  self::where('userid','=',$userid)
            ->where('is_del','=','N')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $mail;
    }
    public static function delMailByIdArray($id_array){
        return  self::whereIn('id', $id_array)->delete();
    }
    //后台获取所有邮件
    public static function getMailAll(){
        return self::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public static function addMailByUserId($userid , $title){
        $data['userid'] = $userid;
        $data['title'] = $title;
        $data['created_at'] = date('Y-m-d H:i:s');
        return self::insert($data);
    }
}
