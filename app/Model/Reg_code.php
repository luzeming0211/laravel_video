<?php

namespace App\Model;

use function EasyWeChat\Kernel\Support\get_client_ip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reg_code extends Model
{
    protected $table = 'reg_code';


    protected $fillable = ['userid', 'ip','code','resource','user_agent','created_at','updated_at'];

    public static function  addCode($userid,  $code, $resource){
        $data['userid'] = $userid;
        $data['ip'] = get_client_ip();
        $data['code'] = $code;
        $data['resource'] = $resource;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        return  self::insert($data);
    }
    public static function  check_code($userid,  $code){
        return self::where('userid',$userid)
            ->where('code',$code)
            ->whereBetween('created_at', [date("Y-m-d H:i:s",strtotime("-5 minute")),date("Y-m-d H:i:s",strtotime("+5 minute"))])
            ->value('userid');
    }


}
