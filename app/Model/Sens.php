<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sens extends Model
{
    protected $table = 'sens';


    protected $fillable = ['deny_word', 'deny_word_ext','created_at','updated_at'];

    public static function  getSens(){
        return  self::orderBy('created_at','desc')
                 ->paginate(10);
    }

    //前台评论添加检测敏感词用
    public static function  getSensAll()
    {
        return self::orderBy('created_at', 'desc')
                ->get()
                ->toArray();
    }
}
