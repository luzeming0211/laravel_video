<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login_log extends Model
{
    protected $table = 'login_log';


    protected $fillable = [
        'ticket',
        'openid',
        'userid',
        'username',
        'created_at',
        'updated_at',
    ];

    public static function addLoginLog($ticket){
        $data['ticket'] = $ticket;
        return self::insert($data);
    }
    public static function getOpenIdByTicket($ticket){
        return  self::where('ticket', $ticket)
                ->whereNotNull('openid')
                ->value('openid');
    }
    //后台用
    public static function getAll(){
        return  self::orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public static function clear(){
        return  self::whereNull('openid')->delete();
    }
    public static function delByIdArray($id_array){
        return  self::whereIn('id', $id_array)->delete();
    }
    public static function editLoginLog($ticket, $openid, $userid, $username){
        return  self::where('ticket',$ticket)->update([
            'openid'=>$openid,
            'userid'=>$userid,
            'username'=>$username,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
