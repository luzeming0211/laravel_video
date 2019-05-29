<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Pay_log extends Model
{
    protected $table = 'pay_log';


    protected $fillable = ['out_trade_no', 'method','total_amount','sign','trade_no','auth_app_id','version','app_id','sign_type','seller_id','timestamp'];
    public static function addPayLog($data){
        return self::insert($data);
    }
    //获取支付成功log
    public static function getPaySuccessLog(){
        return self::join('pay_init_log', 'pay_log.out_trade_no', '=', 'pay_init_log.out_trade_no')
            ->paginate(12);
    }
}
