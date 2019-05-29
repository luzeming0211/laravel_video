<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pay_init_log extends Model
{
    protected $table = 'pay_init_log';


    protected $fillable = ['out_trade_no', 'userid','created_at'];

    public static function getInitLogByNO($out_trade_no){
        return  self::where('out_trade_no', $out_trade_no)->first();
    }
}
