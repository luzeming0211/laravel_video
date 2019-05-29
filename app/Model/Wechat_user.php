<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wechat_user extends Model
{
    protected $table = 'wechat_user';


    protected $fillable = [
        'openid',
        'nickname',
        'bind_flag',
        'created_at',
        'updated_at'
    ];
    public static function bindWeChatUser($openid, $user){
        return self::where('openid',$openid)->update([
            'userid'=>$user['userid'],
            'nickname'=>$user['username'],
            'bind_flag'=>1,
        ]);
    }
    public static function addDefaultWeChatUser($openid){
        $data['openid'] = $openid;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return  self::insert($data);
    }
    public static function getBindWechatUser($openid){
        return  self::where('openid', $openid)
                ->where('bind_flag', 1)
                ->first();
    }
    public static function getWechatUser($openid){
        return  self::where('openid', $openid)
                 ->first();
    }
    public static function get_wechat_user(){
        $user['userid'] = '';
        $user['username'] = '';
        if(Session()->exists('wechat_user')) {
            $data = Session()->get('wechat_user');
            $openid = $data->id;
            $wechat_user_info = self::getBindWechatUser($openid);
            if(empty($wechat_user_info)){
                $wechat_user_info2 = self::getWechatUser($openid);
                if (empty($wechat_user_info2)){
                    self::addDefaultWeChatUser($openid);
                    return $user;
                }
            }else{
                $user['userid'] = $wechat_user_info->userid;
                $user['username'] = $wechat_user_info->nickname;
                return $user;
            }
        }
        return $user;
    }
}
