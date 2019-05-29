<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_doc extends Model
{
    protected $table = 'user_doc';


    protected $fillable = ['doc_id', 'doc_name', 'profess','summary','created_at'];

    //查询所有
    public static function getUserDoc(){
        return   self::get();
    }

}
