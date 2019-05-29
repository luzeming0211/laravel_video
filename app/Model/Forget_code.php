<?php

namespace App\Model;

use function EasyWeChat\Kernel\Support\get_client_ip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Forget_code extends Model
{
    protected $table = 'forget_code';


    protected $fillable = ['userid', 'ip','code','resource','user_agent','created_at','updated_at'];

    public static function  addForgetCode($email,  $code, $resource){
        $data['email'] = $email;
        $data['ip'] = get_client_ip();
        $data['code'] = $code;
        $data['resource'] = $resource;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        return  self::insert($data);
    }
    public static function  checkForgetCode($email,  $code){
        return self::where('email',$email)
            ->where('code',$code)
            ->whereBetween('created_at', [date("Y-m-d H:i:s",strtotime("-5 minute")),date("Y-m-d H:i:s",strtotime("+5 minute"))])
            ->value('email');
    }

}
